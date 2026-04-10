<?php

namespace Database\Seeders;

use App\Models\Pool;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class PoolSeeder extends Seeder
{
    public function run(): void
    {
        // Data Default Kolam
        Pool::insert([
            ['name' => 'Kolam Atas', 'depth_info' => '1.8m - 5.2m', 'status' => 'Buka', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kolam Bawah', 'depth_info' => '1.5m', 'status' => 'Buka', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Data Default Jam Operasional
        Setting::create([
            'key' => 'operational_hours',
            'value' => [
                'senin' => '12.00 WIB - 17.15 WIB',
                'selasa_minggu' => '07.00 WIB - 17.15 WIB'
            ]
        ]);
    }
}