<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $admin = User::first(); // Ambil user admin yang baru dibuat

        // Buat 25 berita dummy untuk mengetes pagination
        for ($i = 0; $i < 25; $i++) {
            $title = $faker->sentence(rand(4, 8));
            News::create([
                'user_id' => $admin->id,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . time() . $i,
                'content' => '<p>' . implode('</p><p>', $faker->paragraphs(rand(3, 5))) . '</p>',
                // Placeholder gambar agar rapi di tampilan
                'thumbnail' => 'news/dummy-placeholder.jpg', // Nanti kita bisa abaikan jika gambar tidak diload, atau gunakan URL
                'published_at' => $faker->dateTimeBetween('-2 months', 'now'),
            ]);
        }
    }
}