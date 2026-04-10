@extends('layouts.main')
@section('title', 'Manajemen Status Kolam - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-8 flex items-center justify-between">
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
                <div class="absolute top-0 right-0 p-8 opacity-5">
                    <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-primary-950 mb-4 relative z-10">Ubah Semua Status Sekaligus</h2>
                <form action="{{ route('admin.pools.bulk') }}" method="POST" class="flex flex-wrap gap-3 relative z-10">
                    @csrf
                    <button type="submit" name="status" value="Buka" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-sm transition hover:scale-105">Buka Semua</button>
                    <button type="submit" name="status" value="Pembersihan" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-sm transition hover:scale-105">Pembersihan Semua</button>
                    <button type="submit" name="status" value="Tutup" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-sm transition hover:scale-105">Tutup Semua</button>
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
                            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm">Simpan</button>
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
                        <input type="text" name="senin" value="{{ $hoursSetting->value['senin'] ?? '' }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm" placeholder="Contoh: 12.00 WIB - 17.15 WIB" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Selasa - Minggu</label>
                        <input type="text" name="selasa_minggu" value="{{ $hoursSetting->value['selasa_minggu'] ?? '' }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm" placeholder="Contoh: 07.00 WIB - 17.15 WIB" required>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary-700 hover:bg-primary-800 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm mt-4">
                        Perbarui Jam Operasional
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection