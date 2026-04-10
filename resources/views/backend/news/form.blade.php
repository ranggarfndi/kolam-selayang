@extends('layouts.main')
@section('title', isset($news) ? 'Edit Berita' : 'Tulis Berita Baru')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-950 tracking-tighter">{{ isset($news) ? 'Edit Berita' : 'Tulis Berita Baru' }}</h1>
        </div>
        <a href="{{ route('admin.news.index') }}" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm">
            Batal & Kembali
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

    <form action="{{ isset($news) ? route('admin.news.update', $news->id) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 space-y-6">
        @csrf
        @if(isset($news)) @method('PUT') @endif

        <div>
            <label class="block text-primary-950 text-sm font-bold mb-2">Judul Berita</label>
            <input type="text" name="title" value="{{ old('title', $news->title ?? '') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm" placeholder="Contoh: Kolam Selayang Ditutup Sementara Untuk Perbaikan" required>
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
            <button type="submit" class="bg-primary-700 hover:bg-primary-800 text-white font-bold py-3 px-8 rounded-full transition shadow-sm hover:scale-105">
                {{ isset($news) ? 'Simpan Perubahan' : 'Terbitkan Berita' }}
            </button>
        </div>
    </form>

</div>
@endsection