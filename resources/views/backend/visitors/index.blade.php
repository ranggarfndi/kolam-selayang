@extends('layouts.main')
@section('title', 'Manajemen Pengunjung - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-950 tracking-tighter">Data Pengunjung</h1>
            <p class="text-gray-600 mt-1">Catat pengunjung masuk/keluar dan pantau pendapatan hari ini.</p>
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-primary-950 text-white p-6 rounded-3xl shadow-sm flex flex-col justify-center">
            <p class="text-primary-200 text-sm font-medium mb-1">Saat Ini Di Dalam</p>
            <p class="text-4xl font-extrabold">{{ $currentInside }} <span class="text-lg font-normal text-primary-300">Orang</span></p>
        </div>
        <div class="bg-white border border-gray-100 p-6 rounded-3xl shadow-sm">
            <p class="text-gray-500 text-sm font-medium mb-1">Total Masuk Hari Ini</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalIn }}</p>
        </div>
        <div class="bg-white border border-gray-100 p-6 rounded-3xl shadow-sm">
            <p class="text-gray-500 text-sm font-medium mb-1">Total Keluar Hari Ini</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalOut }}</p>
        </div>
        <div class="bg-green-50 border border-green-100 p-6 rounded-3xl shadow-sm">
            <p class="text-green-700 text-sm font-medium mb-1">Pendapatan Tiket (Hari Ini)</p>
            <p class="text-2xl font-bold text-green-800">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-primary-950 mb-4">Catat Masuk</h3>
                <form action="{{ route('admin.visitors.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="in">
                    <div class="flex gap-3">
                        <input type="number" name="quantity" min="1" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100" placeholder="Jml Orang">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-sm whitespace-nowrap">Simpan</button>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">*Otomatis menambah pendapatan (x Rp 10.000)</p>
                </form>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-primary-950 mb-4">Catat Keluar</h3>
                <form action="{{ route('admin.visitors.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="out">
                    <div class="flex gap-3">
                        <input type="number" name="quantity" min="1" max="{{ $currentInside > 0 ? $currentInside : '' }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-100" placeholder="Jml Orang">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl font-bold transition shadow-sm whitespace-nowrap" {{ $currentInside == 0 ? 'disabled' : '' }}>Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <h3 class="text-lg font-bold text-primary-950 mb-4">Riwayat Hari Ini</h3>
                
                @if($logs->isEmpty())
                    <div class="text-center py-10 text-gray-500 text-sm">Belum ada data pengunjung hari ini.</div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 text-sm text-gray-500">
                                    <th class="pb-3 font-medium px-4">Waktu</th>
                                    <th class="pb-3 font-medium px-4">Aktivitas</th>
                                    <th class="pb-3 font-medium px-4 text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @foreach($logs as $log)
                                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">{{ $log->created_at->format('H:i') }} WIB</td>
                                    <td class="py-3 px-4">
                                        @if($log->type == 'in')
                                            <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 px-2.5 py-1 rounded-md text-xs font-bold">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                                Masuk
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-md text-xs font-bold">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                                Keluar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-right font-bold">{{ $log->quantity }} Orang</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection