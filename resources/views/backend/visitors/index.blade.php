@extends('layouts.main')
@section('title', 'Manajemen Pengunjung - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 relative">
    
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-950 tracking-tighter">Data Pengunjung</h1>
            <p class="text-gray-600 mt-1">Catat pengunjung masuk/keluar dan pantau pendapatan hari ini.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm">
            &larr; Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-primary-950 text-white p-6 rounded-3xl shadow-sm flex flex-col justify-center">
            <p class="text-primary-200 text-sm font-medium mb-1">Saat Ini Di Dalam</p>
            <p class="text-4xl font-extrabold">{{ $currentInside }} <span class="text-lg font-normal text-primary-300">Orang</span></p>
        </div>
        <div class="bg-white border border-gray-100 p-6 rounded-3xl shadow-sm">
            <p class="text-gray-500 text-sm font-medium mb-1">Total Masuk Hari Ini</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalIn }}</p>
        </div>
        <div class="bg-white border border-gray-100 p-6 rounded-3xl shadow-sm">
            <p class="text-gray-500 text-sm font-medium mb-1">Total Keluar Hari Ini</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalOut }}</p>
        </div>
        <div class="bg-green-50 border border-green-100 p-6 rounded-3xl shadow-sm">
            <p class="text-green-700 text-sm font-medium mb-1">Pendapatan Tiket (Hari Ini)</p>
            <p class="text-2xl font-bold text-green-800">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-primary-50 rounded-bl-[100px] -z-10"></div>
                <h3 class="text-lg font-bold text-primary-950 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    Catat Masuk
                </h3>
                <form id="formMasuk" action="{{ route('admin.visitors.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="in">
                    <div class="flex gap-3">
                        <input type="number" id="inputMasuk" name="quantity" min="1" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition-all font-bold text-gray-800" placeholder="Jml Orang">
                        <button type="button" onclick="showConfirmModal('in')" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-sm whitespace-nowrap active:scale-95">Simpan</button>
                    </div>
                    <p class="text-[11px] font-medium text-gray-400 mt-3 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Otomatis menambah pendapatan (x Rp 10.000)
                    </p>
                </form>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-50 rounded-bl-[100px] -z-10"></div>
                <h3 class="text-lg font-bold text-primary-950 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Catat Keluar
                </h3>
                <form id="formKeluar" action="{{ route('admin.visitors.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="out">
                    <div class="flex gap-3">
                        <input type="number" id="inputKeluar" name="quantity" min="1" max="{{ $currentInside > 0 ? $currentInside : '' }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-100 transition-all font-bold text-gray-800" placeholder="Jml Orang" {{ $currentInside == 0 ? 'disabled' : '' }}>
                        <button type="button" onclick="showConfirmModal('out')" class="bg-yellow-500 hover:bg-yellow-600 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed text-white px-6 py-3 rounded-xl font-bold transition shadow-sm whitespace-nowrap active:scale-95" {{ $currentInside == 0 ? 'disabled' : '' }}>Simpan</button>
                    </div>
                    @if($currentInside == 0)
                        <p class="text-[11px] font-medium text-red-400 mt-3 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Tidak ada pengunjung di dalam area.
                        </p>
                    @endif
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 overflow-hidden h-full">
                <h3 class="text-lg font-bold text-primary-950 mb-4">Riwayat Hari Ini</h3>
                
                @if($logs->isEmpty())
                    <div class="text-center py-16 text-gray-400 flex flex-col items-center justify-center h-full">
                        <svg class="w-12 h-12 mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <p class="text-sm font-medium">Belum ada data pengunjung hari ini.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wider">
                                    <th class="pb-3 font-bold px-4">Waktu</th>
                                    <th class="pb-3 font-bold px-4">Aktivitas</th>
                                    <th class="pb-3 font-bold px-4 text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @foreach($logs as $log)
                                <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                                    <td class="py-3.5 px-4 font-medium text-gray-500">{{ $log->created_at->format('H:i') }} <span class="text-xs text-gray-400">WIB</span></td>
                                    <td class="py-3.5 px-4">
                                        @if($log->type == 'in')
                                            <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-2.5 py-1 rounded-md text-xs font-bold border border-green-100">
                                                <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                                Masuk
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-2.5 py-1 rounded-md text-xs font-bold border border-yellow-100">
                                                <svg class="w-3.5 h-3.5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                                Keluar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-right font-black text-gray-900">{{ $log->quantity }} <span class="font-medium text-gray-400 text-xs">Org</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $logs->links('layouts.partials.pagination') }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<div id="confirmModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop" onclick="closeConfirmModal()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div id="modalPanel" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all w-full max-w-sm sm:my-8 sm:w-full opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 duration-300">
                
                <div id="modalHeader" class="px-6 py-6 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100 flex items-center gap-4">
                    <div id="modalIconBg" class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-primary-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg id="modalIcon" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-black leading-6 text-gray-900" id="modal-title">Konfirmasi Data</h3>
                    </div>
                </div>

                <div class="px-6 py-6 sm:px-6">
                    <p class="text-sm text-gray-600 mb-4 text-center sm:text-left">Anda yakin ingin menyimpan data berikut?</p>
                    
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Aktivitas</span>
                            <span id="modalTextType" class="text-sm font-black px-3 py-1 rounded-lg">Masuk</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Jumlah Orang</span>
                            <span id="modalTextQuantity" class="text-2xl font-black text-gray-900">0</span>
                        </div>
                    </div>
                    
                    <p id="modalWarningRevenue" class="text-[11px] font-medium text-primary-600 mt-4 text-center bg-primary-50 py-2 rounded-lg hidden">
                        *Data ini akan menambah total pendapatan hari ini.
                    </p>
                </div>

                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100 gap-3">
                    <button type="button" id="btnConfirmSubmit" class="inline-flex w-full justify-center rounded-xl bg-primary-600 px-4 py-3 text-sm font-bold text-white shadow-sm hover:bg-primary-700 sm:ml-3 sm:w-auto transition-colors active:scale-95">
                        Ya, Simpan Data
                    </button>
                    <button type="button" onclick="closeConfirmModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors active:scale-95">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Menyimpan form mana yang sedang di-trigger
    let currentFormId = null;

    function showConfirmModal(type) {
        // Tentukan input dan form berdasarkan tipe
        const inputId = type === 'in' ? 'inputMasuk' : 'inputKeluar';
        const formId = type === 'in' ? 'formMasuk' : 'formKeluar';
        const inputEl = document.getElementById(inputId);
        
        // Validasi HTML bawaan (required, min, max)
        if (!inputEl.checkValidity()) {
            inputEl.reportValidity(); // Menampilkan pop-up validasi default browser
            return;
        }

        const quantity = inputEl.value;
        currentFormId = formId;

        // --- Kustomisasi Tampilan Modal berdasarkan Tipe ---
        const typeEl = document.getElementById('modalTextType');
        const qtyEl = document.getElementById('modalTextQuantity');
        const iconBg = document.getElementById('modalIconBg');
        const icon = document.getElementById('modalIcon');
        const btnSubmit = document.getElementById('btnConfirmSubmit');
        const warningRevenue = document.getElementById('modalWarningRevenue');

        qtyEl.textContent = quantity + ' Orang';

        if (type === 'in') {
            typeEl.textContent = 'MASUK';
            typeEl.className = 'text-xs font-black px-3 py-1.5 rounded-lg bg-green-100 text-green-700';
            iconBg.className = 'mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10';
            icon.className = 'h-6 w-6 text-green-600';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>';
            btnSubmit.className = 'inline-flex w-full justify-center rounded-xl bg-green-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-green-700 sm:ml-3 sm:w-auto transition-colors active:scale-95';
            warningRevenue.classList.remove('hidden'); // Tampilkan info pendapatan
        } else {
            typeEl.textContent = 'KELUAR';
            typeEl.className = 'text-xs font-black px-3 py-1.5 rounded-lg bg-yellow-100 text-yellow-700';
            iconBg.className = 'mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10';
            icon.className = 'h-6 w-6 text-yellow-600';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>';
            btnSubmit.className = 'inline-flex w-full justify-center rounded-xl bg-yellow-500 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-yellow-600 sm:ml-3 sm:w-auto transition-colors active:scale-95';
            warningRevenue.classList.add('hidden'); // Sembunyikan info pendapatan
        }

        // --- Tampilkan Modal dengan Animasi ---
        const modal = document.getElementById('confirmModal');
        const backdrop = document.getElementById('modalBackdrop');
        const panel = document.getElementById('modalPanel');

        modal.classList.remove('hidden');
        
        // Force reflow
        void modal.offsetWidth;

        // Jalankan transisi
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        
        panel.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
    }

    function closeConfirmModal() {
        const backdrop = document.getElementById('modalBackdrop');
        const panel = document.getElementById('modalPanel');

        // Reverse animasi
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        
        panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
        panel.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');

        // Tunggu animasi selesai baru di-hidden
        setTimeout(() => {
            document.getElementById('confirmModal').classList.add('hidden');
            currentFormId = null;
        }, 300); // Sesuai dengan durasi duration-300 di Tailwind
    }

    // Event Listener untuk tombol Konfirmasi di dalam Modal
    document.getElementById('btnConfirmSubmit').addEventListener('click', function() {
        if (currentFormId) {
            // Ubah teks tombol menjadi "Menyimpan..."
            this.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...`;
            this.disabled = true;
            
            // Submit form aslinya
            document.getElementById(currentFormId).submit();
        }
    });
</script>
@endsection