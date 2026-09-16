<?php

namespace Database\Seeders;

use App\Models\Informasi; // Atau App\Models\BlogPost
use App\Models\KategoriBlog; // Sesuaikan dengan nama model kategori baru kamu
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID Kategori berdasarkan Slug dari tabel blog_categories
        $katBerita = KategoriBlog::where('slug', 'berita')->first()?->id;
        $katPengumuman = KategoriBlog::where('slug', 'pengumuman')->first()?->id;
        $katAgenda = KategoriBlog::where('slug', 'agenda')->first()?->id;
        $katInfografis = KategoriBlog::where('slug', 'infografis')->first()?->id;

        $blogs = [
            [
                'title' => 'Teluk Wondama Adopsi Metode Pembelajaran Matematika Gasing',
                'slug' => Str::slug('Teluk Wondama Adopsi Metode Pembelajaran Matematika Gasing'),
                'content' => '<p>Dinas Pendidikan, Pemuda, dan Olahraga Kabupaten Teluk Wondama resmi mengadopsi metode pembelajaran Matematika GASING (Gampang, Asyik, dan Menyenangkan) yang dikembangkan oleh Prof. Yohanes Surya untuk meningkatkan minat belajar anak-anak serta menghapus anggapan bahwa matematika adalah pelajaran yang sulit.</p><p>Program pelatihan hasil kerja sama dengan Surya Institute ini berlangsung selama 17 hari di Wasior dengan melibatkan 144 peserta (96 siswa dan 48 guru SD) serta didampingi 12 trainer muda.</p>',
                'image' => 'https://img.antaranews.com/cache/1200x800/2025/06/10/FotoJet-2025-06-10T211735.317.jpg',
                'user_id' => 1,
                'status' => true,
                'published_at' => '2025-06-11 00:00:00',
                'categories' => array_filter([$katBerita]),
            ],
            [
                'title' => 'Penyaluran Beasiswa Indonesia Pintar (PIP) untuk Pelajar SD dan SMP Kepulauan Roon',
                'slug' => Str::slug('Penyaluran Beasiswa Indonesia Pintar PIP untuk Pelajar SD dan SMP Kepulauan Roon'),
                'content' => '<p>Diumumkan kepada seluruh orang tua dan wali murid di wilayah Kepulauan Roon, sebanyak 104 pelajar tingkat SD dan SMP resmi menerima dana bantuan Program Indonesia Pintar (PIP) Tahun Ajaran 2025/2026.</p><p>Penyaluran dilakukan untuk empat sekolah target: SMPN Roon (32 siswa), SDN Sariay (4 siswa), SDN Menarbu (22 siswa), dan SD YPK Yende (46 siswa). Proses pencairan dana dikawal langsung oleh mekanisme pemberian kuasa guna memudahkan warga kepulauan.</p>',
                'image' => 'https://img.antaranews.com/cache/1200x800/2025/08/11/FotoJet-2025-08-11T174436.010.jpg',
                'user_id' => 1,
                'status' => true,
                'published_at' => '2025-08-11 00:00:00',
                'categories' => array_filter([$katPengumuman]),
            ],
            [
                'title' => 'Pelantikan 50 Pejabat Struktural di Lingkup Pemkab Teluk Wondama',
                'slug' => Str::slug('Pelantikan 50 Pejabat Struktural di Lingkup Pemkab Teluk Wondama'),
                'content' => '<p>Pemerintah Kabupaten Teluk Wondama menggelar agenda pelantikan 50 pejabat struktural yang dipimpin langsung oleh Bupati Elysa Auri di Gedung Sasana Karya, Rasiei.</p><p>Agenda rotasi dan promosi jabatan ini bertujuan untuk memperkuat tata kelola pemerintahan, penyegaran struktur organisasi, serta memacu kualitas pelayanan publik di bidang pendidikan dan pembangunan daerah.</p>',
                'image' => 'https://kabartimur.com/wp-content/uploads/2026/03/Compress_20260318_083033_3707.jpg',
                'user_id' => 1,
                'status' => true,
                'published_at' => '2026-03-18 00:00:00',
                'categories' => array_filter([$katAgenda]),
            ],
            [
                'title' => 'Infografis Alokasi Anggaran Rp 9,5 Miliar Pembangunan SMA Negeri V Wondama',
                'slug' => Str::slug('Infografis Alokasi Anggaran Rp 9,5 Miliar Pembangunan SMA Negeri V Wondama'),
                'content' => '<p>Visualisasi dan rincian alokasi anggaran Dana Alokasi Khusus (DAK) senilai Rp9,516 miliar yang direalisasikan untuk pembangunan SMA Negeri V Wondama di Kampung Rado, Distrik Wasior.</p><p>Fasilitas yang dibangun mencakup 9 ruang kelas, laboratorium IPA, komputer, bahasa, perpustakaan, serta rumah dinas bagi kepala sekolah dan guru.</p>',
                'image' => 'https://suarasorong.com/wp-content/uploads/2024/05/WONDAMA.webp',
                'user_id' => 1,
                'status' => true,
                'published_at' => '2024-05-19 00:00:00',
                'categories' => array_filter([$katInfografis]),
            ],
        ];

        foreach ($blogs as $item) {
            $categoryIds = $item['categories'];
            unset($item['categories']);

            $post = Informasi::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );

            // Lampirkan relasi kategori via pivot table jika relasi 'categories()' ada pada Model
            if (!empty($categoryIds) && method_exists($post, 'categories')) {
                $post->categories()->sync($categoryIds);
            }
        }
    }
}