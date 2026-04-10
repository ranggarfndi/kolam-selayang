@extends('layouts.main')
@section('title', 'Laporan Pendapatan - Kolam Selayang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-950 tracking-tighter">Laporan & Pendapatan</h1>
            <p class="text-gray-600 mt-1">Filter dan unduh rekap harian pengunjung dan tiket.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm text-center">
            &larr; Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Filter Periode Laporan</h2>
            <form action="{{ route('admin.reports') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="w-full sm:w-1/2">
                    <label class="block text-gray-600 text-xs font-bold mb-2">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm">
                </div>
                <div class="w-full sm:w-1/2">
                    <label class="block text-gray-600 text-xs font-bold mb-2">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition text-sm">
                </div>
                <button type="submit" class="w-full sm:w-auto bg-primary-950 hover:bg-primary-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-sm transition whitespace-nowrap">
                    Terapkan
                </button>
            </form>
        </div>

        <div class="bg-green-50 border border-green-100 p-6 md:p-8 rounded-3xl shadow-sm flex flex-col justify-center">
            <p class="text-green-700 text-sm font-bold mb-2">Total Periode Terpilih</p>
            <p class="text-3xl font-extrabold text-green-900 mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-sm font-medium text-green-800">{{ number_format($totalVisitors, 0, ',', '.') }} Pengunjung</p>
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 md:p-8 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h3 class="text-lg font-bold text-primary-950">Rekapitulasi Harian</h3>
            
            <a href="{{ route('admin.reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl text-sm font-bold transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Unduh CSV
            </a>
        </div>

        @if($reports->isEmpty())
            <div class="text-center py-16 text-gray-500">Tidak ada data pengunjung pada rentang tanggal ini.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500">
                            <th class="py-4 px-6 font-semibold">Tanggal</th>
                            <th class="py-4 px-6 font-semibold text-right">Pengunjung Masuk</th>
                            <th class="py-4 px-6 font-semibold text-right">Pendapatan Tiket</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @foreach($reports as $row)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium">{{ \Carbon\Carbon::parse($row->date)->translatedFormat('l, d F Y') }}</td>
                            <td class="py-4 px-6 text-right">{{ number_format($row->total_visitors, 0, ',', '.') }} Orang</td>
                            <td class="py-4 px-6 text-right font-bold text-green-700">Rp {{ number_format($row->total_revenue, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection