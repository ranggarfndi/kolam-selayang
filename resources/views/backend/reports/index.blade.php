@extends('layouts.main')
@section('title', 'Laporan Pendapatan - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 relative">
    
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-950 tracking-tighter">Laporan & Pendapatan</h1>
            <p class="text-gray-600 mt-1">Filter dan unduh rekap harian pengunjung dan tiket.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm text-center">
            &larr; Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Filter Periode Laporan</h2>
            <form id="formFilterReports" action="{{ route('admin.reports') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="w-full sm:w-1/2">
                    <label class="block text-gray-600 text-xs font-bold mb-2">Dari Tanggal</label>
                    <input type="date" id="inputStartDate" name="start_date" value="{{ $startDate }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm">
                </div>
                <div class="w-full sm:w-1/2">
                    <label class="block text-gray-600 text-xs font-bold mb-2">Sampai Tanggal</label>
                    <input type="date" id="inputEndDate" name="end_date" value="{{ $endDate }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm">
                </div>
                <button type="button" onclick="openReportModal('filter')" class="w-full sm:w-auto bg-primary-950 hover:bg-primary-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-sm transition whitespace-nowrap active:scale-95">
                    Terapkan
                </button>
            </form>
        </div>

        <div class="bg-green-50 border border-green-100 p-6 md:p-8 rounded-3xl shadow-sm flex flex-col justify-center">
            <p class="text-green-700 text-sm font-bold mb-2">Total Periode Terpilih</p>
            <p class="text-3xl font-extrabold text-green-900 mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-sm font-medium text-green-800">{{ number_format($totalVisitors, 0, ',', '.') }} Pengunjung</p>
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 md:p-8 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h3 class="text-lg font-bold text-primary-950">Rekapitulasi Harian</h3>
            
            <a href="javascript:void(0)" data-href="{{ route('admin.reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" onclick="openReportModal('export', this)" class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl text-sm font-bold transition shadow-sm active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Unduh CSV
            </a>
        </div>

        @if($reports->isEmpty())
            <div class="text-center py-16 text-gray-500">Tidak ada data pengunjung pada rentang tanggal ini.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500">
                            <th class="py-4 px-6 font-semibold">Tanggal</th>
                            <th class="py-4 px-6 font-semibold text-right">Pengunjung Masuk</th>
                            <th class="py-4 px-6 font-semibold text-right">Pendapatan Tiket</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @foreach($reports as $row)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium">{{ \Carbon\Carbon::parse($row->date)->translatedFormat('l, d F Y') }}</td>
                            <td class="py-4 px-6 text-right">{{ number_format($row->total_visitors, 0, ',', '.') }} Orang</td>
                            <td class="py-4 px-6 text-right font-bold text-green-700">Rp {{ number_format($row->total_revenue, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-8 px-6 pb-6">
                {{ $reports->links('layouts.partials.pagination') }}
            </div>
        @endif
    </div>

</div>

<div id="reportModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0" id="rmBackdrop" onclick="closeReportModal()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div id="rmPanel" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all w-full max-w-sm sm:my-8 sm:w-full opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 duration-300">
                
                <div class="px-6 py-6 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100 flex items-center gap-4">
                    <div id="rmIconBg" class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <svg id="rmIcon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"></svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-black leading-6 text-gray-900" id="rmTitle">Konfirmasi</h3>
                    </div>
                </div>

                <div class="px-6 py-6 sm:px-6">
                    <p id="rmDesc" class="text-sm text-gray-600 text-center sm:text-left font-medium leading-relaxed"></p>
                    
                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 mt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Dari</span>
                            <span id="rmStartDateDisplay" class="text-sm font-black text-gray-900">-</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sampai</span>
                            <span id="rmEndDateDisplay" class="text-sm font-black text-gray-900">-</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100 gap-3">
                    <button type="button" id="rmBtnConfirm" class="inline-flex w-full justify-center rounded-xl px-4 py-3 text-sm font-bold text-white shadow-sm sm:ml-3 sm:w-auto transition-colors active:scale-95">
                        Ya, Lanjutkan
                    </button>
                    <button type="button" onclick="closeReportModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors active:scale-95">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentReportActionType = null;
    let exportUrl = null;

    function openReportModal(actionType, element = null) {
        currentReportActionType = actionType;
        
        // Ambil nilai tanggal dari input filter
        const startDateVal = document.getElementById('inputStartDate').value;
        const endDateVal = document.getElementById('inputEndDate').value;
        
        // Validasi jika kosong
        if(!startDateVal || !endDateVal) {
            alert('Pilih tanggal awal dan akhir terlebih dahulu.');
            return;
        }

        // Tampilkan tanggal di modal
        document.getElementById('rmStartDateDisplay').textContent = startDateVal;
        document.getElementById('rmEndDateDisplay').textContent = endDateVal;

        const mTitle = document.getElementById('rmTitle');
        const mDesc = document.getElementById('rmDesc');
        const iconBg = document.getElementById('rmIconBg');
        const icon = document.getElementById('rmIcon');
        const btnConfirm = document.getElementById('rmBtnConfirm');

        // Reset class
        iconBg.className = 'mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10';
        btnConfirm.className = 'inline-flex w-full justify-center rounded-xl px-6 py-3 text-sm font-bold text-white shadow-sm sm:ml-3 sm:w-auto transition-colors active:scale-95';

        if (actionType === 'filter') {
            mTitle.textContent = 'Terapkan Filter';
            mDesc.textContent = 'Menampilkan laporan berdasarkan rentang waktu baru:';
            iconBg.classList.add('bg-primary-100');
            icon.className = 'h-6 w-6 text-primary-600';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>';
            btnConfirm.classList.add('bg-primary-950', 'hover:bg-primary-800');
            btnConfirm.textContent = 'Terapkan';
        } else if (actionType === 'export') {
            exportUrl = element.getAttribute('data-href');
            mTitle.textContent = 'Unduh CSV';
            mDesc.textContent = 'Anda akan mengunduh rekapitulasi data pengunjung untuk periode:';
            iconBg.classList.add('bg-green-100');
            icon.className = 'h-6 w-6 text-green-600';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>';
            btnConfirm.classList.add('bg-green-600', 'hover:bg-green-700');
            btnConfirm.textContent = 'Unduh Sekarang';
        }

        // Animasi buka
        const modal = document.getElementById('reportModal');
        const backdrop = document.getElementById('rmBackdrop');
        const panel = document.getElementById('rmPanel');

        modal.classList.remove('hidden');
        void modal.offsetWidth; // Force reflow

        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        panel.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
    }

    function closeReportModal() {
        const backdrop = document.getElementById('rmBackdrop');
        const panel = document.getElementById('rmPanel');

        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
        panel.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');

        setTimeout(() => {
            document.getElementById('reportModal').classList.add('hidden');
            currentReportActionType = null;
            exportUrl = null;
        }, 300);
    }

    document.getElementById('rmBtnConfirm').addEventListener('click', function() {
        if (currentReportActionType === 'filter') {
            this.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
            this.disabled = true;
            document.getElementById('formFilterReports').submit();
        } else if (currentReportActionType === 'export') {
            // Karena ini unduhan file, kita tidak perlu men-disable tombol secara permanen
            // cukup tutup modal dan arahkan ke URL unduhan
            window.location.href = exportUrl;
            closeReportModal();
        }
    });
</script>
@endsection