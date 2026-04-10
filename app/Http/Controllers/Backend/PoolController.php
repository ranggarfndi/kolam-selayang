<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use App\Models\Setting;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    public function index()
    {
        $pools = Pool::all();
        $hoursSetting = Setting::where('key', 'operational_hours')->first();

        return view('backend.pools.index', compact('pools', 'hoursSetting'));
    }

    public function updateStatus(Request $request, Pool $pool)
    {
        $request->validate(['status' => 'required|in:Buka,Pembersihan,Tutup']);
        $pool->update(['status' => $request->status]);

        return back()->with('success', "Status {$pool->name} berhasil diubah menjadi {$request->status}.");
    }

    public function bulkUpdateStatus(Request $request)
    {
        $request->validate(['status' => 'required|in:Buka,Pembersihan,Tutup']);
        Pool::query()->update(['status' => $request->status]);

        return back()->with('success', "Semua status kolam berhasil diubah menjadi {$request->status}.");
    }

    public function updateHours(Request $request)
    {
        $request->validate([
            'senin' => 'required|string|max:255',
            'selasa_minggu' => 'required|string|max:255',
        ]);

        $setting = Setting::where('key', 'operational_hours')->first();
        $setting->update([
            'value' => [
                'senin' => $request->senin,
                'selasa_minggu' => $request->selasa_minggu,
            ]
        ]);

        return back()->with('success', 'Jam operasional berhasil diperbarui.');
    }
}