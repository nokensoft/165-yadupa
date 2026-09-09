<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PhotoSeeder extends Seeder
{
    /**
     * Data diambil dari __TEMPLATE/media.json (dokumentasi kegiatan resmi YADUPA).
     * Setiap gambar pada array "galeri" milik satu kegiatan dijadikan satu baris Photo.
     * Gambar terkait disalin ke public/img/media/.
     */
    public function run(): void
    {
        $items = [
            [
                'title'      => 'Pelatihan Kemampuan Fasilitasi Bagi Staf Lapangan Dan Motivator Kampung',
                'category'   => 'Pelatihan',
                'keterangan' => 'Pelatihan kemampuan fasilitasi bagi staf pusat, staf cabang, dan motivator kampung pada 28-30 April 2023 di Jayapura, guna mendampingi masyarakat adat Papua memfasilitasi Rencana Pengembangan Kampung berbasis aset lokal.',
                'images'     => [
                    'pelatihan-kemampuan-fasilitasi-bagi-staf-lapangan-dan-motivator-kampung.jpg',
                    'pelatihan-kemampuan-fasilitasi-bagi-staf-lapangan-dan-motivator-kampung-2.jpg',
                    'pelatihan-kemampuan-fasilitasi-bagi-staf-lapangan-dan-motivator-kampung-3.jpg',
                ],
            ],
            [
                'title'      => 'Pelatihan Dan Penguatan Kapasitas Berbasis Aset Oleh YADUPA',
                'category'   => 'Pelatihan',
                'keterangan' => 'Pelatihan perencanaan pembangunan menggunakan pendekatan Asset-Based Community Development (ABCD) dan metode 4D, dilaksanakan 30 Maret - 1 April 2023 di Jayapura.',
                'images'     => [
                    'pelatihan-dan-penguatan-kapasitas-berbasis-aset-oleh-yadupa-1.jpg',
                    'pelatihan-dan-penguatan-kapasitas-berbasis-aset-oleh-yadupa-2.jpg',
                ],
            ],
            [
                'title'      => 'Pertemuan Sharing Informasi dan Pengalaman Pendampingan Masyarakat',
                'category'   => 'Rapat & Pertemuan',
                'keterangan' => 'Rapat koordinasi evaluasi capaian program pendampingan masyarakat di Kabupaten Yapen, Waropen, Biak, dan Yalimo, dilaksanakan 23 September 2022.',
                'images'     => [
                    'pertemuan-sharing-informasi-dan-pengalaman-pendampingan-masyarakat-1.jpg',
                ],
            ],
            [
                'title'      => 'Pra-Lokakarya Pemetaan Wilayah Adat Suku Awera/Taru dan Demisa Kabupaten Waropen',
                'category'   => 'Lokakarya & Pemetaan',
                'keterangan' => 'Pra-Lokakarya Pemetaan Wilayah Adat Suku Awera/Taru dan Demisa di Inggerus, 25-26 Agustus 2023, bertema Membangun Pemahaman Bersama Dalam Pelaksanaan Penataan Wilayah Adat di Kabupaten Waropen.',
                'images'     => [
                    'pra-lokakarya-pemetaan-wilayah-adat-waropen-1.jpg',
                    'pra-lokakarya-pemetaan-wilayah-adat-waropen-2.jpg',
                    'pra-lokakarya-pemetaan-wilayah-adat-waropen-3.jpg',
                ],
            ],
            [
                'title'      => 'Lomba Pidato Pelajar SMA/SMK Kota dan Kabupaten Jayapura Tahun 2023',
                'category'   => 'Lomba & Kompetisi',
                'keterangan' => 'Lomba Pidato tingkat SMA/SMK se-Kota dan Kabupaten Jayapura 2023 bertema Pemekaran dan Masyarakat Adat (Berkat atau Kutuk), diselenggarakan bersama GEMPHA.',
                'images'     => [
                    'lomba-pidato-sma-smk-jayapura-1.jpg',
                    'lomba-pidato-sma-smk-jayapura-2.jpg',
                    'lomba-pidato-sma-smk-jayapura-3.jpg',
                    'lomba-pidato-sma-smk-jayapura-4.jpg',
                ],
            ],
            [
                'title'      => 'Lomba Menulis Cerita Rakyat dan Bercerita di Radio oleh YADUPA dan GEMPHA',
                'category'   => 'Lomba & Kompetisi',
                'keterangan' => 'Lomba Menulis Cerita Rakyat dan Bercerita di Radio tahun 2022, bagian dari kampanye #CeritaTentangSaPuKampung bersama GEMPHA.',
                'images'     => [
                    'lomba-menulis-cerita-rakyat-papua.jpg',
                ],
            ],
            [
                'title'      => 'Ajang Debat Mahasiswa Tahun 2022: Kearifan Lokal sebagai Modal Pembangunan',
                'category'   => 'Lomba & Kompetisi',
                'keterangan' => 'Debat Mahasiswa 2022 bertema Kearifan Lokal Masyarakat Adat Papua Sebagai Modal Dasar Pembangunan, diikuti UNIPA Manokwari, STFT Fajar Timur Jayapura, dan MUSAMUS Merauke.',
                'images'     => [
                    'debat-mahasiswa-yadupa-2022.jpg',
                ],
            ],
            [
                'title'      => 'Perencanaan Kerja Strategis (Renstra) YADUPA 2021-2025',
                'category'   => 'Perencanaan Strategis',
                'keterangan' => 'Penyusunan Rencana Kerja Strategis (RENSTRA) YADUPA 2021-2025 pada 9-12 Maret 2021 di P3W Padang Bulan, Abepura.',
                'images'     => [
                    'perencanaan-kerja-strategis-yadupa-2021.jpg',
                    'perencanaan-kerja-strategis-yadupa-2021-2.jpg',
                    'perencanaan-kerja-strategis-yadupa-2021-3.jpg',
                ],
            ],
            [
                'title'      => 'Rapat Kerja Triwulan Divisi YADUPA',
                'category'   => 'Rapat & Pertemuan',
                'keterangan' => 'Rapat kerja triwulan seluruh divisi YADUPA di kantor pusat Jayapura, dipimpin Direktur YADUPA Leonard Imbiri, 19 Maret 2020.',
                'images'     => [
                    'rapat-kerja-triwulan-divisi-yadupa-1.jpg',
                    'rapat-kerja-triwulan-divisi-yadupa-2.jpg',
                ],
            ],
        ];

        foreach ($items as $item) {
            $multiple = count($item['images']) > 1;

            foreach ($item['images'] as $index => $filename) {
                // Judul unik untuk tiap foto dalam satu galeri kegiatan, mis. "... (2)".
                $title = $multiple ? "{$item['title']} (" . ($index + 1) . ')' : $item['title'];

                Photo::updateOrCreate(
                    ['slug' => Str::slug($title)],
                    [
                        'title'      => $title,
                        'image'      => 'img/media/' . $filename,
                        'category'   => $item['category'],
                        'keterangan' => $item['keterangan'],
                        'status'     => true,
                    ]
                );
            }
        }
    }
}
