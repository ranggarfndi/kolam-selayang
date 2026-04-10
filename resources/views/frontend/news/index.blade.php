@extends('layouts.main')
@section('title', 'Kabar Terbaru & Informasi - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-16 md:pt-6 md:pb-24">
    <div class="max-w-3xl mb-10 md:mb-12">
        <div class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-primary-50 text-primary-700 text-[10px] font-black tracking-[0.2em] uppercase mb-4 border border-primary-100">
            Arsip Informasi
        </div>
        <h1 class="text-5xl md:text-7xl font-black text-primary-950 tracking-tighter leading-none mb-4">
            Kabar <span class="text-primary-600">Terbaru.</span>
        </h1>
        <p class="text-gray-500 text-base md:text-lg font-medium leading-relaxed">
            Kumpulan berita, pengumuman, dan dokumentasi resmi Kolam Renang Selayang.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16 mb-20">
        @foreach($news as $item)
        <a href="{{ route('news.show', $item->slug) }}" class="group flex flex-col">
            <div class="relative h-72 rounded-[2rem] overflow-hidden mb-8 shadow-sm group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-500">
                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-primary-950/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute bottom-6 left-6 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                    <span class="bg-white/20 backdrop-blur-md text-white border border-white/30 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider">
                        Baca Artikel
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-3 mb-4">
                <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest">{{ $item->published_at->translatedFormat('d M Y') }}</span>
                <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Berita</span>
            </div>
            
            <h3 class="text-2xl font-black text-primary-950 leading-tight mb-4 group-hover:text-primary-600 transition-colors">
                {{ $item->title }}
            </h3>
            
            <p class="text-gray-500 font-medium line-clamp-2 leading-relaxed mb-6">
                {{ Str::limit(strip_tags($item->content), 120, '...') }}
            </p>
            
            <div class="mt-auto w-10 h-0.5 bg-gray-200 group-hover:w-full group-hover:bg-primary-600 transition-all duration-500"></div>
        </a>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $news->links('layouts.partials.pagination') }}
    </div>
</div>
@endsection