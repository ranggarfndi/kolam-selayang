<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use App\Models\Setting;
use App\Models\VisitorLog;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Kolam
        $pools = Pool::all();
        
        // 2. Kalkulasi Live Pengunjung Hari Ini
        $today = Carbon::today();
        $totalIn = VisitorLog::whereDate('created_at', $today)->where('type', 'in')->sum('quantity');
        $totalOut = VisitorLog::whereDate('created_at', $today)->where('type', 'out')->sum('quantity');
        $currentInside = max(0, $totalIn - $totalOut);
        
        // 3. Ambil 3 Berita Terbaru (DIUBAH)
        // Sebelumnya take(5), kita ubah jadi 3 agar pas dengan grid 3 kolom di tampilan Home
        $latestNews = News::latest()->take(3)->get();

        return view('frontend.home', compact('pools', 'currentInside', 'latestNews'));
    }

    public function newsIndex()
    {
        // Menampilkan berita dengan pagination (SUDAH BENAR)
        // Kita gunakan 9 agar simetris (3 baris x 3 kolom)
        $news = News::latest()->paginate(9);
        return view('frontend.news.index', compact('news'));
    }

    public function newsShow($slug)
    {
        // Menggunakan slug agar URL lebih SEO-friendly dan aman
        $news = News::where('slug', $slug)->firstOrFail();
        return view('frontend.news.show', compact('news'));
    }
}