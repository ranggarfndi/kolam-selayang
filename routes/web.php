<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Halaman Frontend Sementara
Route::get('/', function () {
    return view('layouts.main'); 
});

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
});