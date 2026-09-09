<?php

namespace Database\Seeders;

use App\Models\KategoriBlog;
use Illuminate\Database\Seeder;

class KategoriBlogSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['Berita', 'Pengumuman', 'Agenda', 'Infografis'];

        foreach ($kategori as $nama) {
            KategoriBlog::create(['nama' => $nama]);
        }
    }
}
