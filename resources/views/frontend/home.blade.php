@extends('layouts.main')
@section('title', 'Beranda - Kolam Renang Selayang Medan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    
    <div class="relative bg-primary-950 rounded-[2.5rem] overflow-hidden mb-20 shadow-2xl shadow-primary-900/20">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-gradient-to-br from-sky-400/20 to-primary-600/20 rounded-full blur-[100px] pointer-events-none transform translate-x-1/3 -translate-y-1/3"></div>

        <div class="relative z-10 flex flex-col lg:flex-row items-center gap-12 p-10 md:p-16 lg:p-20">
            <div class="w-full lg:w-3/5 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 py-2 px-5 rounded-full bg-white/5 border border-white/10 text-sky-300 text-xs font-bold tracking-widest uppercase backdrop-blur-sm mb-8">
                    Selamat Datang di
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tighter mb-6 leading-[1.1]">
                    Kolam Renang <span class="text-transparent bg-clip-text bg-sky-400">Selayang</span>
                </h1>
                
                <p class="text-primary-100/80 text-lg md:text-xl font-medium leading-relaxed max-w-xl mx-auto lg:mx-0 mb-10">
                    Nikmati fasilitas kolam renang standar nasional di jantung Kota Medan. Kunjungi kami di Jl. Dr. Mansyur, untuk pengalaman berenang yang nyaman dan berkualitas.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="#status" class="w-full sm:w-auto bg-white text-primary-950 px-8 py-4 rounded-2xl font-bold shadow-xl shadow-white/10 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                        Cek Status Kolam
                    </a>
                    <a href="{{ route('news.index') }}" class="w-full sm:w-auto bg-transparent text-white border border-white/20 px-8 py-4 rounded-2xl font-bold hover:bg-white/10 transition-all duration-300">
                        Baca Berita
                    </a>
                </div>
            </div>

            <div class="w-full lg:w-2/5 lg:flex justify-center relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-sky-400 to-primary-500 rounded-[2.5rem] blur-xl opacity-20 group-hover:opacity-40 transition duration-700"></div>
                
                <div class="relative bg-white/10 backdrop-blur-2xl border border-white/20 p-8 rounded-[2.5rem] shadow-2xl">
                    
                    <div class="flex justify-between items-center mb-8">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-sky-400 to-primary-600 flex items-center justify-center shadow-lg shadow-sky-500/20">
                            <svg class="w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <span class="text-primary-100 font-black text-sm tracking-widest">{{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}</span>
                    </div>

                    @php
                        // Cek apakah hari ini hari Senin (1 = Senin, menurut standar ISO)
                        $isMonday = \Carbon\Carbon::now()->isMonday();
                        
                        // Pilih jam berdasarkan hari
                        $todayHours = $isMonday ? ($jamOperasional['senin'] ?? 'Tutup') : ($jamOperasional['selasa_minggu'] ?? 'Tutup');
                    @endphp

                    <div>
                        <p class="text-primary-100/80 text-sm font-medium mb-1">Jam Operasional Hari Ini</p>
                        <p class="text-xl font-black text-white tracking-tight mb-6">
                            {{ $todayHours }}
                        </p>
                        
                        <p class="text-xs text-primary-100/80 leading-relaxed font-medium italic">
                            Catatan : Jam operasional dapat berubah sewaktu-waktu. Pastikan untuk selalu memeriksa informasi terbaru sebelum berkunjung.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 mb-20 md:mb-32" id="status">
        <div class="lg:col-span-1 bg-gradient-to-br from-sky-400 to-primary-600 rounded-[2.5rem] p-10 text-white relative overflow-hidden group shadow-lg shadow-primary-500/20">
            <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-125 transition-transform duration-700 pointer-events-none">
                <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c0 0-8 6-8 12a8 8 0 0016 0c0-6-8-12-8-12zm0 18a6 6 0 01-6-6c0-4.08 4.63-8.45 6-9.75 1.37 1.3 6 5.67 6 9.75a6 6 0 01-6 6z"/></svg>
            </div>
            <div class="relative z-10 h-full flex flex-col justify-between min-h-[200px]">
                <div>
                    <h3 class="text-primary-100 font-semibold text-lg mb-1">Saat Ini Di Dalam</h3>
                    <p class="text-primary-100/80 text-sm">Update Real-time Hari Ini</p>
                </div>
                <div class="mt-8 flex items-baseline gap-2">
                    <span class="text-7xl font-black tracking-tighter leading-none">{{ $currentInside }}</span>
                    <span class="text-xl font-medium opacity-90">Orang</span>
                </div>
                <div class="mt-8 inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-xs font-bold w-fit">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_8px_rgba(74,222,128,0.8)]"></span> Terhubung ke Sistem
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
            @foreach($pools as $pool)
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-primary-100 transition-all duration-500 group flex flex-col justify-between relative overflow-hidden">
                
                <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full blur-3xl opacity-10 
                    {{ $pool->status == 'Buka' ? 'bg-green-500' : ($pool->status == 'Pembersihan' ? 'bg-yellow-500' : 'bg-red-500') }}">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-8 relative z-10">
                        <div class="p-4 bg-gray-50 text-gray-400 rounded-2xl group-hover:bg-primary-600 group-hover:text-white transition-all duration-500 shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 14.5A2.5 2.5 0 006.5 17h11a2.5 2.5 0 002.5-2.5m-16 0A2.5 2.5 0 016.5 12h11a2.5 2.5 0 012.5 2.5m-16 0V7a2 2 0 012-2h12a2 2 0 012 2v7.5M8 9h8"></path></svg>
                        </div>

                        @if($pool->status == 'Buka')
                            <span class="bg-green-500 text-white px-6 py-2 rounded-2xl text-sm font-black tracking-widest uppercase shadow-lg shadow-green-500/30 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                BUKA
                            </span>
                        @elseif($pool->status == 'Pembersihan')
                            <span class="bg-yellow-400 text-yellow-950 px-6 py-2 rounded-2xl text-sm font-black tracking-widest uppercase shadow-lg shadow-yellow-400/30 flex items-center gap-2">
                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                PEMBERSIHAN
                            </span>
                        @else
                            <span class="bg-red-500 text-white px-6 py-2 rounded-2xl text-sm font-black tracking-widest uppercase shadow-lg shadow-red-500/30">
                                TUTUP
                            </span>
                        @endif
                    </div>

                    <h3 class="text-3xl font-black text-primary-950 mb-2 tracking-tighter group-hover:text-primary-600 transition-colors">{{ $pool->name }}</h3>
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        Kedalaman: <span class="text-gray-900">{{ $pool->depth_info }}</span>
                    </p>
                </div>

                <div class="relative w-full h-1.5 bg-gray-100 mt-10 rounded-full overflow-hidden">
                    <div class="absolute top-0 left-0 h-full bg-primary-500 w-0 group-hover:w-full transition-all duration-700 ease-in-out"></div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div id="berita" class="mb-10">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-primary-950 tracking-tighter">Kabar Terbaru</h2>
                <p class="text-gray-500 mt-2 text-lg">Informasi dan pengumuman seputar Kolam Selayang.</p>
            </div>
            <a href="{{ route('news.index') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 bg-primary-50 text-primary-700 px-6 py-3.5 sm:py-2.5 rounded-full text-sm font-bold hover:bg-primary-100 transition mt-6 sm:mt-0 shadow-sm sm:shadow-none">
                Lihat Semua Berita
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        @if($latestNews->isEmpty())
            <div class="bg-gray-50 p-12 rounded-[2rem] border border-dashed border-gray-200 text-center">
                <p class="text-gray-500 font-medium">Belum ada berita yang diterbitkan.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($latestNews as $news)
                <a href="{{ route('news.show', $news->slug) }}" class="group bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-xl hover:border-primary-200 hover:-translate-y-1 transition-all duration-300 flex flex-col">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6 md:p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="inline-block bg-primary-50 text-primary-600 px-3 py-1 rounded-full text-xs font-bold tracking-wide">BERITA</span>
                            <span class="text-xs font-semibold text-gray-400">{{ $news->published_at->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-3 line-clamp-2 leading-snug group-hover:text-primary-600 transition-colors">{{ $news->title }}</h3>
                        <p class="text-gray-500 text-sm mb-6 flex-grow line-clamp-3 leading-relaxed">{{ Str::limit(strip_tags($news->content), 100, '...') }}</p>
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
                            <span class="text-sm font-bold text-primary-600">Baca Selengkapnya</span>
                            <span class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</div> @endsection