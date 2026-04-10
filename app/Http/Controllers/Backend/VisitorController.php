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
        
        // Ambil semua log hari ini, urutkan dari yang terbaru
        $logs = VisitorLog::whereDate('created_at', $today)->latest()->get();
        
        // Kalkulasi Statistik
        $totalIn = $logs->where('type', 'in')->sum('quantity');
        $totalOut = $logs->where('type', 'out')->sum('quantity');
        
        // Mencegah minus jika ada kesalahan input admin
        $currentInside = max(0, $totalIn - $totalOut); 
        
        // Pendapatan hanya dari pengunjung masuk
        $todayRevenue = $logs->where('type', 'in')->sum('total_price');

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

        // Harga statis sesuai spesifikasi
        $pricePerTicket = 10000;
        
        // Total harga hanya dihitung jika tipe 'in' (Masuk)
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