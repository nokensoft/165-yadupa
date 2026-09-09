<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PengaturanSitusSeeder::class,
            KategoriBlogSeeder::class,
            BlogSeeder::class,
            PageSeeder::class,
            InformasiSeeder::class,
            HeroSeeder::class,
            PhotoSeeder::class,
            VideoSeeder::class,
        ]);
    }
}
