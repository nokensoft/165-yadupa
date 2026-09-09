<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class HeroSeeder extends Seeder
{
    /**
     * Slide hero beranda. Gambar diambil dari aset identitas YADUPA (bg1/bg2)
     * dan dokumentasi kegiatan nyata (__TEMPLATE/media.json), bukan konten
     * organisasi lain.
     */
    public function run(): void
    {
        // Bersihkan data contoh lama (hero Disdikpora Teluk Wondama) sebelum
        // menanam ulang dengan slide identitas & dokumentasi kegiatan YADUPA.
        Hero::query()->delete();

        $heroes = [
            [
                'title'        => 'YADUPA - Yayasan Anak Dusun Papua',
                'image'        => 'img/hero/yadupa-identitas.jpg',
                'priority'     => 0,
                'status'       => true,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title'        => 'Lomba Menulis Cerita Rakyat dan Bercerita di Radio oleh YADUPA dan GEMPHA',
                'image'        => 'img/hero/lomba-cerita-rakyat-radio.jpg',
                'priority'     => 1,
                'status'       => true,
                'published_at' => Carbon::now()->subDays(6),
            ],
            [
                'title'        => 'Pra-Lokakarya Pemetaan Wilayah Adat Suku Awera/Taru dan Demisa, Kabupaten Waropen',
                'image'        => 'img/media/pra-lokakarya-pemetaan-wilayah-adat-waropen-1.jpg',
                'priority'     => 2,
                'status'       => true,
                'published_at' => Carbon::now(),
            ],
        ];

        foreach ($heroes as $hero) {
            Hero::updateOrCreate(
                ['title' => $hero['title']],
                $hero
            );
        }
    }
}
