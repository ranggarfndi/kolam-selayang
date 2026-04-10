<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        // 1. QUERY UNTUK STATISTIK (Ambil semua data hari ini tanpa paginate)
        $allTodayLogs = VisitorLog::whereDate('created_at', $today)->get();
        
        $totalIn = $allTodayLogs->where('type', 'in')->sum('quantity');
        $totalOut = $allTodayLogs->where('type', 'out')->sum('quantity');
        $currentInside = max(0, $totalIn - $totalOut); 
        $todayRevenue = $allTodayLogs->where('type', 'in')->sum('total_price');

        // 2. QUERY UNTUK TABEL (Menggunakan Pagination)
        // Kita tampilkan 15 log per halaman agar admin mudah memantau
        $logs = VisitorLog::whereDate('created_at', $today)
                            ->latest()
                            ->paginate(5);

        return view('backend.visitors.index', compact(
            'logs', 'currentInside', 'todayRevenue', 'totalIn', 'totalOut'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1'
        ]);

        $pricePerTicket = 10000;
        $totalPrice = $request->type === 'in' ? ($request->quantity * $pricePerTicket) : 0;

        VisitorLog::create([
            'type' => $request->type,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice
        ]);

        $actionText = $request->type === 'in' ? 'Masuk' : 'Keluar';
        return back()->with('success', "Berhasil mencatat {$request->quantity} pengunjung {$actionText}.");
    }
}