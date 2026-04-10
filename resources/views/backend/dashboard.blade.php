@extends('layouts.main')
@section('title', 'Dashboard Utama Administrator - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100 mb-10">
        <div class="md:flex md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-primary-950 tracking-tighter">
                    Selamat Datang kembali, <span class="text-primary-700">{{ Auth::user()->name }}!</span>
                </h1>
                <p class="text-gray-600 mt-2 text-lg">Anda memiliki kendali penuh atas sistem operasional Kolam Selayang Medan hari ini.</p>
            </div>
            <div class="mt-6 md:mt-0">
                <span class="text-sm font-semibold text-gray-500">{{ date('d M Y') }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        
        <a href="{{ route('admin.pools') }}" class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex items-start gap-5 hover:border-primary-300 hover:shadow-md transition cursor-pointer group">
            <div class="p-3.5 bg-sky-100 text-sky-700 rounded-2xl group-hover:bg-primary-600 group-hover:text-white transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Status Kolam</p>
                <p class="text-xl font-bold text-gray-900 mt-1">Kelola Status &rarr;</p>
            </div>
        </a>
        
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex items-start gap-5 hover:border-primary-100 transition cursor-pointer">
            <div class="p-3.5 bg-primary-100 text-primary-700 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Pengunjung</p>
                <p class="text-xl font-bold text-gray-900 mt-1">Live Update</p>
            </div>
        </div>
        
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex items-start gap-5 hover:border-primary-100 transition cursor-pointer">
            <div class="p-3.5 bg-primary-100 text-primary-700 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M9 14l3-3m0 0l3 3m-3-3v8"></path></svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Uang Tiket Hari Ini</p>
                <p class="text-xl font-bold text-gray-900 mt-1">Rp 0</p>
            </div>
        </div>
        
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex items-start gap-5 hover:border-primary-100 transition cursor-pointer">
            <div class="p-3.5 bg-primary-100 text-primary-700 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Berita Terbaru</p>
                <p class="text-xl font-bold text-gray-900 mt-1">Terbitkan</p>
            </div>
        </div>

    </div>

</div>
@endsection