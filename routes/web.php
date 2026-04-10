<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;

// Halaman Publik (Frontend)
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/berita', [FrontendController::class, 'newsIndex'])->name('news.index');
// Perhatikan {news:slug} agar URL menggunakan slug, bukan ID angka
Route::get('/berita/{news:slug}', [FrontendController::class, 'newsShow'])->name('news.show');

// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Grup Admin (Harus Login)
Route::middleware('auth')->prefix('admin')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('admin.dashboard');

    // Modul Kolam & Pengaturan
    Route::get('/pools', [App\Http\Controllers\Backend\PoolController::class, 'index'])->name('admin.pools');
    Route::post('/pools/{pool}/status', [App\Http\Controllers\Backend\PoolController::class, 'updateStatus'])->name('admin.pools.status');
    Route::post('/pools/bulk-status', [App\Http\Controllers\Backend\PoolController::class, 'bulkUpdateStatus'])->name('admin.pools.bulk');
    Route::post('/settings/hours', [App\Http\Controllers\Backend\PoolController::class, 'updateHours'])->name('admin.settings.hours');

    // Modul Pengunjung
    Route::get('/visitors', [App\Http\Controllers\Backend\VisitorController::class, 'index'])->name('admin.visitors');
    Route::post('/visitors', [App\Http\Controllers\Backend\VisitorController::class, 'store'])->name('admin.visitors.store');

    // Modul Laporan
    Route::get('/reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('admin.reports');
    Route::get('/reports/export', [App\Http\Controllers\Backend\ReportController::class, 'exportCsv'])->name('admin.reports.export');

    // Modul Berita
    Route::get('/news', [App\Http\Controllers\Backend\NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/news/create', [App\Http\Controllers\Backend\NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [App\Http\Controllers\Backend\NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{news}/edit', [App\Http\Controllers\Backend\NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{news}', [App\Http\Controllers\Backend\NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [App\Http\Controllers\Backend\NewsController::class, 'destroy'])->name('admin.news.destroy');
});