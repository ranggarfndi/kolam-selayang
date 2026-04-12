@extends('layouts.main')
@section('title', isset($news) ? 'Edit Berita' : 'Tulis Berita Baru')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 relative">
    
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-950 tracking-tighter">{{ isset($news) ? 'Edit Berita' : 'Tulis Berita Baru' }}</h1>
        </div>
        <a href="{{ route('admin.news.index') }}" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm">
            Batal
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 text-red-700 border border-red-200 p-4 rounded-2xl mb-6 text-sm font-medium">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="formNews" action="{{ isset($news) ? route('admin.news.update', $news->id) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 space-y-6">
        @csrf
        @if(isset($news)) @method('PUT') @endif

        <div>
            <label class="block text-primary-950 text-sm font-bold mb-2">Judul Berita</label>
            <input type="text" name="title" value="{{ old('title', $news->title ?? '') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm font-bold" placeholder="Contoh: Kolam Selayang Ditutup Sementara Untuk Perbaikan" required>
        </div>

        <div>
            <label class="block text-primary-950 text-sm font-bold mb-2">Dokumentasi (Gambar Thumbnail)</label>
            @if(isset($news) && $news->thumbnail)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="Current Image" class="h-32 rounded-lg border border-gray-200 object-cover">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                </div>
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 transition text-sm text-gray-600 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-100 file:text-primary-700 hover:file:bg-primary-200 cursor-pointer" {{ isset($news) ? '' : 'required' }}>
        </div>

        <div>
            <label class="block text-primary-950 text-sm font-bold mb-2">Isi Berita</label>
            <textarea name="content" rows="12" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm leading-relaxed" placeholder="Tulis deskripsi berita di sini..." required>{{ old('content', $news->content ?? '') }}</textarea>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="button" 
                onclick="openNewsModal('{{ isset($news) ? 'Simpan Perubahan?' : 'Terbitkan Berita?' }}', '{{ isset($news) ? 'Yakin ingin memperbarui data berita ini?' : 'Berita ini akan langsung dipublikasikan dan dapat dilihat oleh pengunjung di halaman utama. Lanjutkan?' }}')" 
                class="bg-primary-700 hover:bg-primary-800 text-white font-bold py-3 px-8 rounded-full transition shadow-sm hover:scale-105 active:scale-95">
                {{ isset($news) ? 'Simpan Perubahan' : 'Terbitkan Berita' }}
            </button>
        </div>
    </form>

</div>

<div id="newsModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0" id="nmBackdrop" onclick="closeNewsModal()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div id="nmPanel" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all w-full max-w-sm sm:my-8 sm:w-full opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 duration-300">
                
                <div class="px-6 py-6 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100 flex items-center gap-4">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-primary-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-black leading-6 text-gray-900" id="nmTitle">Konfirmasi</h3>
                    </div>
                </div>

                <div class="px-6 py-6 sm:px-6">
                    <p id="nmDesc" class="text-sm text-gray-600 text-center sm:text-left font-medium leading-relaxed"></p>
                </div>

                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100 gap-3">
                    <button type="button" id="nmBtnConfirm" class="inline-flex w-full justify-center rounded-xl bg-primary-600 hover:bg-primary-700 px-6 py-3 text-sm font-bold text-white shadow-sm sm:ml-3 sm:w-auto transition-colors active:scale-95">
                        Ya, Lanjutkan
                    </button>
                    <button type="button" onclick="closeNewsModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors active:scale-95">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openNewsModal(title, message) {
        const form = document.getElementById('formNews');

        // Fitur "Smart Validation": Mencegah modal terbuka jika ada form yang belum diisi (Judul, Gambar, atau Isi)
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Set teks modal berdasarkan parameter (Edit vs Create)
        document.getElementById('nmTitle').textContent = title;
        document.getElementById('nmDesc').textContent = message;

        // Tampilkan Modal dengan animasi
        const modal = document.getElementById('newsModal');
        const backdrop = document.getElementById('nmBackdrop');
        const panel = document.getElementById('nmPanel');

        modal.classList.remove('hidden');
        void modal.offsetWidth; // Force reflow

        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        panel.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
    }

    function closeNewsModal() {
        const backdrop = document.getElementById('nmBackdrop');
        const panel = document.getElementById('nmPanel');

        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
        panel.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');

        setTimeout(() => {
            document.getElementById('newsModal').classList.add('hidden');
        }, 300);
    }

    document.getElementById('nmBtnConfirm').addEventListener('click', function() {
        // Ubah tombol jadi status loading, sangat berguna jika gambar yang diupload ukurannya besar
        this.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
        this.disabled = true;
        
        // Submit form
        document.getElementById('formNews').submit();
    });
</script>
@endsection