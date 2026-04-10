@extends('layouts.main')
@section('title', 'Manajemen Berita - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
    
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
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1.5 rounded-lg text-xs font-bold transition">Hapus</button>
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
                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-700 px-4 py-2 rounded-xl text-xs font-bold transition border border-red-100">Hapus</button>
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
@endsection