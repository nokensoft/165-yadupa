<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Seeder ini sengaja tidak diisi.
     *
     * Data video sebelumnya (HUT RI, simulasi gempa, dst.) adalah konten
     * Dinas Pendidikan Teluk Wondama, bukan milik YADUPA. __TEMPLATE/media.json
     * juga tidak memuat tautan video resmi YADUPA, sehingga tidak ada data
     * video nyata yang bisa di-seed tanpa mengarang. Baris lama dihapus agar
     * tidak menampilkan video milik organisasi lain di galeri publik.
     *
     * Tambahkan entri video di sini bila tautan YouTube resmi YADUPA sudah tersedia,
     * atau kelola langsung melalui menu Operator > Video pada dashboard.
     */
    public function run(): void
    {
        Video::query()->delete();
    }
}
