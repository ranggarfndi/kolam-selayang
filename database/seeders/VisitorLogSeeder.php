<?php

namespace Database\Seeders;

use App\Models\VisitorLog;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VisitorLogSeeder extends Seeder
{
    public function run(): void
    {
        $pricePerTicket = 10000;

        // Mundur 30 hari dari hari ini
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            
            // Random rombongan masuk per hari (antara 5 sampai 25 rombongan)
            $incomingGroups = rand(5, 25);
            
            for ($j = 0; $j < $incomingGroups; $j++) {
                // Jumlah orang per rombongan (1 - 8 orang)
                $quantityIn = rand(1, 8);
                
                // Waktu masuk acak (Jam 08.00 - 15.00)
                $timeIn = $date->copy()->addHours(rand(8, 15))->addMinutes(rand(0, 59));
                
                VisitorLog::create([
                    'type' => 'in',
                    'quantity' => $quantityIn,
                    'total_price' => $quantityIn * $pricePerTicket,
                    'created_at' => $timeIn,
                    'updated_at' => $timeIn,
                ]);

                // Waktu keluar (2-3 jam setelah masuk)
                $timeOut = $timeIn->copy()->addHours(rand(2, 3))->addMinutes(rand(0, 59));
                
                // Limit jam tutup
                if ($timeOut->hour >= 17) {
                    $timeOut->setTime(17, rand(0, 15));
                }

                VisitorLog::create([
                    'type' => 'out',
                    'quantity' => $quantityIn,
                    'total_price' => 0,
                    'created_at' => $timeOut,
                    'updated_at' => $timeOut,
                ]);
            }
        }
    }
}