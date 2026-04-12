@extends('layouts.main')
@section('title', 'Manajemen Berita - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 relative">
    
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-950 tracking-tighter">Berita & Pengumuman</h1>
            <p class="text-gray-600 mt-1">Kelola berita yang akan tampil di halaman depan pengunjung.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.dashboard') }}" class="text-center sm:text-left bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-3 sm:py-2 rounded-xl text-sm font-bold transition shadow-sm">
                &larr; Kembali
            </a>
            <a href="{{ route('admin.news.create') }}" class="justify-center sm:justify-start bg-primary-700 hover:bg-primary-800 text-white px-5 py-3 sm:py-2 rounded-xl text-sm font-bold shadow-sm transition inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tulis Berita
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500">
                        <th class="py-4 px-6 font-semibold w-24">Gambar</th>
                        <th class="py-4 px-6 font-semibold">Judul Berita</th>
                        <th class="py-4 px-6 font-semibold">Penulis & Tanggal</th>
                        <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse($news as $item)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 px-6">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail" class="w-16 h-12 object-cover rounded-lg border border-gray-200">
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-900">{{ $item->title }}</td>
                        <td class="py-4 px-6 text-gray-500">
                            {{ $item->author->name }} <br>
                            <span class="text-xs">{{ $item->published_at->translatedFormat('d M Y') }}</span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-2">
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="inline-block bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1.5 rounded-lg text-xs font-bold transition">Edit</a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="button" onclick="openDeleteModal(this, '{{ addslashes($item->title) }}')" class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1.5 rounded-lg text-xs font-bold transition active:scale-95">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-gray-500">Belum ada berita yang diterbitkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-gray-100">
            @forelse($news as $item)
            <div class="p-5 flex flex-col gap-3">
                <div class="flex gap-4 items-start">
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail" class="w-20 h-16 object-cover rounded-lg border border-gray-200 shrink-0">
                    <div>
                        <h3 class="font-bold text-gray-900 leading-tight mb-1">{{ $item->title }}</h3>
                        <p class="text-xs text-gray-500">{{ $item->author->name }} • {{ $item->published_at->translatedFormat('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex gap-2 justify-end mt-2">
                    <a href="{{ route('admin.news.edit', $item->id) }}" class="flex-1 text-center bg-yellow-50 hover:bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl text-xs font-bold transition border border-yellow-100">Edit Berita</a>
                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="button" onclick="openDeleteModal(this, '{{ addslashes($item->title) }}')" class="w-full bg-red-50 hover:bg-red-100 text-red-700 px-4 py-2 rounded-xl text-xs font-bold transition border border-red-100 active:scale-95">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="py-10 text-center text-gray-500">
                Belum ada berita yang diterbitkan.
            </div>
            @endforelse
        </div>

        <div class="px-6 py-6 border-t border-gray-50">
            {{ $news->links('layouts.partials.pagination') }}
        </div>
    </div>

</div>

<div id="deleteModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0" id="dmBackdrop" onclick="closeDeleteModal()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div id="dmPanel" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all w-full max-w-sm sm:my-8 sm:w-full opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 duration-300">
                
                <div class="px-6 py-6 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100 flex items-center gap-4">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-black leading-6 text-gray-900" id="dmTitle">Hapus Berita?</h3>
                    </div>
                </div>

                <div class="px-6 py-6 sm:px-6">
                    <p class="text-sm text-gray-600 text-center sm:text-left font-medium leading-relaxed mb-4">
                        Anda yakin ingin menghapus berita ini secara permanen? Data yang dihapus tidak dapat dikembalikan.
                    </p>
                    <div class="bg-red-50 rounded-xl p-4 border border-red-100">
                        <p id="dmNewsTitle" class="text-sm font-bold text-red-900 line-clamp-2 italic">"Judul Berita"</p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100 gap-3">
                    <button type="button" id="dmBtnConfirm" class="inline-flex w-full justify-center rounded-xl bg-red-600 px-4 py-3 text-sm font-bold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto transition-colors active:scale-95">
                        Ya, Hapus
                    </button>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors active:scale-95">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let formToDelete = null;

    function openDeleteModal(btnElement, newsTitle) {
        formToDelete = btnElement.closest('form');
        
        // Set judul berita di dalam modal
        document.getElementById('dmNewsTitle').textContent = '"' + newsTitle + '"';

        // Animasi buka modal
        const modal = document.getElementById('deleteModal');
        const backdrop = document.getElementById('dmBackdrop');
        const panel = document.getElementById('dmPanel');

        modal.classList.remove('hidden');
        void modal.offsetWidth; // Force reflow

        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        panel.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
    }

    function closeDeleteModal() {
        const backdrop = document.getElementById('dmBackdrop');
        const panel = document.getElementById('dmPanel');

        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
        panel.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');

        setTimeout(() => {
            document.getElementById('deleteModal').classList.add('hidden');
            formToDelete = null;
        }, 300);
    }

    document.getElementById('dmBtnConfirm').addEventListener('click', function() {
        if (formToDelete) {
            this.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...`;
            this.disabled = true;
            formToDelete.submit();
        }
    });
</script>
@endsection