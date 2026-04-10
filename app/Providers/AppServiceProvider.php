<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Pagination Tailwind (Bawaan Anda)
        Paginator::useTailwind();

        // 2. Share Data Jam Operasional ke Semua View (Terutama Footer)
        View::composer('*', function ($view) {
            $operationalHours = Setting::where('key', 'operational_hours')->first();
            
            // Siapkan nilai default jika database kosong
            $jamOperasional = $operationalHours ? $operationalHours->value : [
                'senin' => '12.00 - 17.15 WIB',
                'selasa_minggu' => '07.00 - 17.15 WIB'
            ];

            // Jika formatnya masih String JSON, kita ubah jadi Array
            if (is_string($jamOperasional)) {
                $jamOperasional = json_decode($jamOperasional, true);
            }

            // Lempar variabel $jamOperasional ke semua halaman
            $view->with('jamOperasional', $jamOperasional);
        });
    }
}