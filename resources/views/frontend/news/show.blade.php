@extends('layouts.main')
@section('title', $news->title . ' - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12 md:pt-6 md:pb-20">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('news.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-100 text-primary-950 shadow-sm hover:bg-primary-950 hover:text-white transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kembali</span>
    </div>

    <article class="relative">
        <header class="max-w-4xl mb-8 md:mb-12">
            <div class="flex items-center gap-3 mb-4 text-xs">
                <span class="bg-primary-600 text-white px-2 py-0.5 rounded text-[10px] font-black tracking-widest uppercase">BERITA</span>
                <span class="font-bold text-gray-400 tracking-wider uppercase">{{ $news->published_at->translatedFormat('d F Y') }}</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-primary-950 tracking-tighter leading-[1.1]">
                {{ $news->title }}
            </h1>
        </header>

        <div class="relative w-full h-[300px] md:h-[600px] rounded-[3rem] overflow-hidden mb-16 md:mb-24 shadow-2xl">
            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-3">
                <div class="sticky top-32 p-8 bg-gray-50 rounded-3xl border border-gray-100">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Diterbitkan Oleh</p>
                    <p class="text-xl font-black text-primary-950 tracking-tight mb-1">{{ $news->author->name }}</p>
                    <p class="text-xs font-bold text-primary-600">Admin Kolam Selayang</p>
                </div>
            </div>

            <div class="lg:col-span-8 lg:col-start-5">
                <div class="prose prose-xl prose-primary-950 max-w-none text-gray-600 leading-[1.8] font-medium">
                    {!! nl2br(e($news->content)) !!}
                </div>
                
            </div>
        </div>
    </article>
</div>
@endsection