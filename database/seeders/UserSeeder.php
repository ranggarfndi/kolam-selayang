<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun admin utama
        User::create([
            'name' => 'Admin Selayang',
            'email' => 'admin@selayang.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}