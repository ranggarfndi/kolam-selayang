@extends('layouts.main')
@section('title', 'Manajemen Status Kolam - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 relative">
    
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-950 tracking-tighter">Manajemen Kolam</h1>
            <p class="text-gray-600 mt-1">Kelola status operasional dan jam buka Kolam Selayang.</p>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden">
                <h2 class="text-xl font-bold text-primary-950 mb-4 relative z-10">Ubah Semua Status Sekaligus</h2>
                <form id="formBulkStatus" action="{{ route('admin.pools.bulk') }}" method="POST" class="flex flex-wrap gap-3 relative z-10">
                    @csrf
                    <button type="button" data-name="status" data-value="Buka" onclick="openPoolModal(this, 'Buka Semua Kolam', 'Yakin ingin mengubah status SEMUA kolam menjadi BUKA secara serentak?', 'green')" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-sm transition hover:scale-105 active:scale-95">Buka Semua</button>
                    
                    <button type="button" data-name="status" data-value="Pembersihan" onclick="openPoolModal(this, 'Pembersihan Massal', 'Yakin ingin mengubah status SEMUA kolam menjadi DALAM PEMBERSIHAN?', 'yellow')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-sm transition hover:scale-105 active:scale-95">Pembersihan Semua</button>
                    
                    <button type="button" data-name="status" data-value="Tutup" onclick="openPoolModal(this, 'Tutup Semua Kolam', 'PERINGATAN: Yakin ingin MENUTUP SEMUA kolam saat ini juga?', 'red')" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-sm transition hover:scale-105 active:scale-95">Tutup Semua</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($pools as $pool)
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-extrabold text-gray-900">{{ $pool->name }}</h3>
                            @if($pool->status == 'Buka')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">BUKA</span>
                            @elseif($pool->status == 'Pembersihan')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">PEMBERSIHAN</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">TUTUP</span>
                            @endif
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Kedalaman: <span class="font-semibold text-gray-700">{{ $pool->depth_info ?? '-' }}</span></p>
                    </div>
                    
                    <form action="{{ route('admin.pools.status', $pool->id) }}" method="POST">
                        @csrf
                        <div class="flex gap-2">
                            <select name="status" class="block w-full bg-gray-50 border border-gray-200 text-gray-700 py-2 px-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium">
                                <option value="Buka" {{ $pool->status == 'Buka' ? 'selected' : '' }}>Buka</option>
                                <option value="Pembersihan" {{ $pool->status == 'Pembersihan' ? 'selected' : '' }}>Pembersihan</option>
                                <option value="Tutup" {{ $pool->status == 'Tutup' ? 'selected' : '' }}>Tutup</option>
                            </select>
                            <button type="button" onclick="openPoolModal(this, 'Perbarui Status Kolam', 'Yakin ingin menyimpan status baru untuk {{ $pool->name }}?', 'blue')" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm active:scale-95">Simpan</button>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>

        </div>

        <div class="lg:col-span-1">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-primary-950 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Jam Operasional
                </h2>
                
                <form action="{{ route('admin.settings.hours') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Senin</label>
                        <input type="text" name="senin" value="{{ $hoursSetting->value['senin'] ?? '' }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm font-bold" placeholder="Contoh: 12.00 WIB - 17.15 WIB" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Selasa - Minggu</label>
                        <input type="text" name="selasa_minggu" value="{{ $hoursSetting->value['selasa_minggu'] ?? '' }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm font-bold" placeholder="Contoh: 07.00 WIB - 17.15 WIB" required>
                    </div>
                    
                    <button type="button" onclick="openPoolModal(this, 'Perbarui Jam Operasional', 'Yakin ingin memperbarui informasi jam operasional yang akan tampil di halaman depan pengunjung?', 'blue')" class="w-full bg-primary-700 hover:bg-primary-800 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm mt-4 active:scale-95">
                        Perbarui Jam Operasional
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="poolModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0" id="pModalBackdrop" onclick="closePoolModal()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div id="pModalPanel" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all w-full max-w-sm sm:my-8 sm:w-full opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 duration-300">
                
                <div class="px-6 py-6 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100 flex items-center gap-4">
                    <div id="pmIconBg" class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <svg id="pmIcon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"></svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-black leading-6 text-gray-900" id="pmTitle">Konfirmasi</h3>
                    </div>
                </div>

                <div class="px-6 py-6 sm:px-6">
                    <p id="pmDesc" class="text-sm text-gray-600 text-center sm:text-left font-medium leading-relaxed"></p>
                </div>

                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100 gap-3">
                    <button type="button" id="pmBtnConfirm" class="inline-flex w-full justify-center rounded-xl px-4 py-3 text-sm font-bold text-white shadow-sm sm:ml-3 sm:w-auto transition-colors active:scale-95">
                        Ya, Lanjutkan
                    </button>
                    <button type="button" onclick="closePoolModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors active:scale-95">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentTargetForm = null;
    let submitDataName = null;
    let submitDataValue = null;

    function openPoolModal(btnElement, title, message, theme) {
        const form = btnElement.closest('form');

        // Validasi HTML bawaan (Terutama untuk form Jam Operasional)
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        currentTargetForm = form;
        
        // Simpan data khusus untuk form Bulk Action (Buka Semua, dll)
        submitDataName = btnElement.getAttribute('data-name');
        submitDataValue = btnElement.getAttribute('data-value');

        // Referensi elemen modal
        const mTitle = document.getElementById('pmTitle');
        const mDesc = document.getElementById('pmDesc');
        const iconBg = document.getElementById('pmIconBg');
        const icon = document.getElementById('pmIcon');
        const btnConfirm = document.getElementById('pmBtnConfirm');

        // Set Teks
        mTitle.textContent = title;
        mDesc.textContent = message;

        // Reset kelas UI
        iconBg.className = 'mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10';
        btnConfirm.className = 'inline-flex w-full justify-center rounded-xl px-6 py-3 text-sm font-bold text-white shadow-sm sm:ml-3 sm:w-auto transition-colors active:scale-95';

        // Set Tema (Warna & Ikon)
        if (theme === 'green') {
            iconBg.classList.add('bg-green-100');
            icon.className = 'h-6 w-6 text-green-600';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
            btnConfirm.classList.add('bg-green-600', 'hover:bg-green-700');
        } else if (theme === 'yellow') {
            iconBg.classList.add('bg-yellow-100');
            icon.className = 'h-6 w-6 text-yellow-600';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>';
            btnConfirm.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
        } else if (theme === 'red') {
            iconBg.classList.add('bg-red-100');
            icon.className = 'h-6 w-6 text-red-600';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>';
            btnConfirm.classList.add('bg-red-600', 'hover:bg-red-700');
        } else { // blue (default)
            iconBg.classList.add('bg-primary-100');
            icon.className = 'h-6 w-6 text-primary-600';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>';
            btnConfirm.classList.add('bg-primary-600', 'hover:bg-primary-700');
        }

        // Tampilkan Modal dengan Animasi
        const modal = document.getElementById('poolModal');
        const backdrop = document.getElementById('pModalBackdrop');
        const panel = document.getElementById('pModalPanel');

        modal.classList.remove('hidden');
        void modal.offsetWidth; // Force reflow

        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        panel.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
    }

    function closePoolModal() {
        const backdrop = document.getElementById('pModalBackdrop');
        const panel = document.getElementById('pModalPanel');

        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
        panel.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');

        setTimeout(() => {
            document.getElementById('poolModal').classList.add('hidden');
            currentTargetForm = null;
        }, 300);
    }

    // Aksi submit setelah dikonfirmasi
    document.getElementById('pmBtnConfirm').addEventListener('click', function() {
        if (currentTargetForm) {
            
            // Khusus form Bulk Action, kita harus menyisipkan input hidden
            // karena type="button" tidak mengirimkan name/value-nya sendiri ke server
            if (submitDataName && submitDataValue) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = submitDataName;
                hiddenInput.value = submitDataValue;
                currentTargetForm.appendChild(hiddenInput);
            }

            // Ubah tombol jadi status loading
            this.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
            this.disabled = true;
            
            currentTargetForm.submit();
        }
    });
</script>
@endsection