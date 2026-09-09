<?php

namespace Database\Seeders;

use App\Models\PengaturanSitus;
use Illuminate\Database\Seeder;

class PengaturanSitusSeeder extends Seeder
{
    /**
     * Data diringkas dari YADUPA_PROFILE.MD (profil resmi YADUPA per tahun 2026).
     */
    public function run(): void
    {
        $settings = [
            // Umum
            'nama_situs'      => 'YADUPA - Yayasan Anak Dusun Papua',
            'nama_situs_en'   => 'YADUPA - Papuan Village Children Foundation',
            'deskripsi_situs' => 'Lembaga Swadaya Masyarakat (LSM) yang mendapatkan mandat untuk bekerja sebagai penguatan Masyarakat Adat Papua, secara khusus Generasi Muda Papua.',

            // Kontak (Kantor Pusat)
            'email'              => 'office@yadupa.org',
            'email_direktur'     => 'office@yadupa.org',
            'email_ketua'        => 'office@yadupa.org',
            'telepon'            => '(0967) 584433',
            'fax'                => null,
            'whatsapp_direktur'  => null,
            'whatsapp_ketua'     => null,
            'alamat'             => 'Jalan Pertambangan Nomor 178, Perumahan Silva Lestari Kotaraja Dalam, Kelurahan VIM, Distrik Abepura, Kota Jayapura',
            'website'            => 'https://www.yadupa.org',
            'logo'               => null,

            // Peta (Kantor Pusat - Abepura, Kota Jayapura)
            'koordinat_maps'   => '-2.594368° LS, 140.675205° BT (Abepura, Kota Jayapura)',
            'google_maps_link' => 'https://maps.google.com/?q=Jalan+Pertambangan+178+Kotaraja+Dalam+Abepura+Jayapura',
            'google_maps_embed'=> null,

            // Media Sosial — belum diaktifkan secara resmi per YADUPA_PROFILE.MD
            'sosmed_facebook'  => null,
            'sosmed_instagram' => null,
            'sosmed_youtube'   => null,
            'sosmed_twitter'   => null,
            'sosmed_tiktok'    => null,
            'sosmed_whatsapp'  => null,

            // SEO
            'seo_meta_keywords'    => 'YADUPA, Yayasan Anak Dusun Papua, LSM Papua, Masyarakat Adat Papua, Penguatan Masyarakat Adat, Generasi Muda Papua, Pendidikan Papua, Jayapura',
            'seo_meta_description' => 'YADUPA (Yayasan Anak Dusun Papua) adalah Lembaga Swadaya Masyarakat yang mendapatkan mandat untuk bekerja sebagai penguatan Masyarakat Adat Papua, secara khusus Generasi Muda Papua.',
            'seo_og_image'         => null,
        ];

        foreach ($settings as $key => $value) {
            PengaturanSitus::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
