<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\KategoriBlog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID Kategori berdasarkan Slug
        $kategoriBerita = KategoriBlog::where('slug', 'berita')->first()?->id;
        $kategoriPengumuman = KategoriBlog::where('slug', 'pengumuman')->first()?->id;
        $kategoriAgenda = KategoriBlog::where('slug', 'agenda')->first()?->id;
        $kategoriInfografis = KategoriBlog::where('slug', 'infografis')->first()?->id;

        $blogs = [
            // 1. Kategori: Berita
            [
                'judul' => 'Teluk Wondama Adopsi Metode Pembelajaran Matematika Gasing',
                'slug' => Str::slug('Teluk Wondama Adopsi Metode Pembelajaran Matematika Gasing'),
                'ringkasan' => 'Pemkab Teluk Wondama mengadopsi metode Matematika GASING yang dikembangkan oleh Prof. Yohanes Surya untuk meningkatkan minat belajar siswa SD.',
                'konten' => '<p>Dinas Pendidikan, Pemuda, dan Olahraga Kabupaten Teluk Wondama resmi mengadopsi metode pembelajaran Matematika GASING (Gampang, Asyik, dan Menyenangkan) yang dikembangkan oleh Prof. Yohanes Surya. Langkah ini diambil untuk meningkatkan minat belajar anak-anak serta menghapus anggapan bahwa matematika adalah pelajaran yang sulit.</p><p>Program pelatihan hasil kerja sama dengan Surya Institute ini berlangsung selama 17 hari di Wasior dengan melibatkan 144 peserta (96 siswa dan 48 guru SD) serta didampingi 12 trainer muda.</p>',
                'sumber_nama' => 'ANTARA Papua Tengah',
                'sumber_link' => 'https://papuatengah.antaranews.com/berita/66541/teluk-wondama-adopsi-metode-pembelajaran-matematika-gasing',
                'kategori_blog_id' => $kategoriBerita,
                'gambar_url' => 'https://img.antaranews.com/cache/1200x800/2025/06/10/FotoJet-2025-06-10T211735.317.jpg',
                'user_id' => 1,
                'status' => 'terbit',
                'tanggal_terbit' => '2025-06-11',
                'jumlah_dibaca' => 120,
            ],

            // 2. Kategori: Pengumuman
            [
                'judul' => 'Penyaluran Beasiswa Indonesia Pintar (PIP) untuk Pelajar SD dan SMP Kepulauan Roon',
                'slug' => Str::slug('Penyaluran Beasiswa Indonesia Pintar PIP untuk Pelajar SD dan SMP Kepulauan Roon'),
                'ringkasan' => 'Informasi penyaluran beasiswa Program Indonesia Pintar (PIP) TA 2025/2026 bagi 104 pelajar SD dan SMP di wilayah Kepulauan Roon.',
                'konten' => '<p>Diumumkan kepada seluruh orang tua dan wali murid di wilayah Kepulauan Roon, sebanyak 104 pelajar tingkat SD dan SMP resmi menerima dana bantuan Program Indonesia Pintar (PIP) Tahun Ajaran 2025/2026.</p><p>Penyaluran dilakukan untuk empat sekolah target: SMPN Roon (32 siswa), SDN Sariay (4 siswa), SDN Menarbu (22 siswa), dan SD YPK Yende (46 siswa). Proses pencairan dana dikawal langsung oleh mekanisme pemberian kuasa guna memudahkan warga kepulauan.</p>',
                'sumber_nama' => 'Dinas Pendidikan Teluk Wondama',
                'sumber_link' => 'https://papuatengah.antaranews.com/berita/69741/104-pelajar-sd-dan-smp-di-pulau-roon-wondama-terima-beasiswa-indonesia-pintar',
                'kategori_blog_id' => $kategoriPengumuman,
                'gambar_url' => 'https://img.antaranews.com/cache/1200x800/2025/08/11/FotoJet-2025-08-11T174436.010.jpg',
                'user_id' => 1,
                'status' => 'terbit',
                'tanggal_terbit' => '2025-08-11',
                'jumlah_dibaca' => 85,
            ],

            // 3. Kategori: Agenda
            [
                'judul' => 'Pelantikan 50 Pejabat Struktural di Lingkup Pemkab Teluk Wondama',
                'slug' => Str::slug('Pelantikan 50 Pejabat Struktural di Lingkup Pemkab Teluk Wondama'),
                'ringkasan' => 'Agenda resmi pelantikan dan rotasi 50 pejabat tinggi pratama dan administrator oleh Bupati Elysa Auri di Gedung Sasana Karya, Rasiei.',
                'konten' => '<p>Pemerintah Kabupaten Teluk Wondama menggelar agenda pelantikan 50 pejabat struktural yang dipimpin langsung oleh Bupati Elysa Auri di Gedung Sasana Karya, Rasiei.</p><p>Agenda rotasi dan promosi jabatan ini bertujuan untuk memperkuat tata kelola pemerintahan, penyegaran struktur organisasi, serta memacu kualitas pelayanan publik di bidang pendidikan dan pembangunan daerah.</p>',
                'sumber_nama' => 'Kabar Timur',
                'sumber_link' => 'https://kabartimur.com/bupati-auri-lantik-50-pejabat-tinggi-pratama-dan-administrator-bantu-saya-lihat-masyarakat-wondama/',
                'kategori_blog_id' => $kategoriAgenda,
                'gambar_url' => 'https://kabartimur.com/wp-content/uploads/2026/03/Compress_20260318_083033_3707.jpg',
                'user_id' => 1,
                'status' => 'terbit',
                'tanggal_terbit' => '2026-03-18',
                'jumlah_dibaca' => 45,
            ],

            // 4. Kategori: Infografis
            [
                'judul' => 'Infografis Alokasi Anggaran Rp 9,5 Miliar Pembangunan SMA Negeri V Wondama',
                'slug' => Str::slug('Infografis Alokasi Anggaran Rp 9,5 Miliar Pembangunan SMA Negeri V Wondama'),
                'ringkasan' => 'Rincian alokasi DAK sebesar Rp9,516 miliar untuk pembangunan fasilitas fisik dan infrastruktur penunjang SMA Negeri V Wondama di Kampung Rado.',
                'konten' => '<p>Visualisasi dan rincian alokasi anggaran Dana Alokasi Khusus (DAK) senilai Rp9,516 miliar yang direalisasikan untuk pembangunan SMA Negeri V Wondama di Kampung Rado, Distrik Wasior.</p><p>Fasilitas yang dibangun mencakup 9 ruang kelas, laboratorium IPA, komputer, bahasa, perpustakaan, serta rumah dinas bagi kepala sekolah dan guru.</p>',
                'sumber_nama' => 'Suara Sorong',
                'sumber_link' => 'https://suarasorong.com/pemkab-teluk-wondama-alokasikan-rp-95-miliar-bangun-sma-negeri-v/',
                'kategori_blog_id' => $kategoriInfografis,
                'gambar_url' => 'https://suarasorong.com/wp-content/uploads/2024/05/WONDAMA.webp',
                'user_id' => 1,
                'status' => 'terbit',
                'tanggal_terbit' => '2024-05-19',
                'jumlah_dibaca' => 210,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::updateOrCreate(
                ['slug' => $blog['slug']],
                $blog
            );
        }
    }
}