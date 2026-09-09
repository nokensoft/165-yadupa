<?php

namespace Database\Seeders;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InformasiSeeder extends Seeder
{
    /**
     * Data diambil dari __TEMPLATE/media.json (dokumentasi kegiatan resmi YADUPA).
     * Gambar terkait disalin ke public/img/media/.
     */
    public function run(): void
    {
        // Bersihkan data contoh lama (berita Disdikpora Teluk Wondama) sebelum
        // menanam ulang dengan dokumentasi kegiatan resmi YADUPA.
        Informasi::query()->delete();

        $userId = User::first()->id ?? 1;

        $datas = [
            [
                'title'   => 'Pelatihan Kemampuan Fasilitasi Bagi Staf Lapangan Dan Motivator Kampung',
                'image'   => 'img/media/pelatihan-kemampuan-fasilitasi-bagi-staf-lapangan-dan-motivator-kampung.jpg',
                'content' => '<p>Yayasan Anak Dusun Papua (YADUPA) menyelenggarakan pelatihan kemampuan fasilitasi bagi staf pusat, staf cabang, dan motivator kampung pada 28-30 April 2023 di Jayapura. Pelatihan ini bertujuan untuk meningkatkan kapasitas para peserta dalam mendampingi masyarakat adat Papua agar mampu memfasilitasi &ldquo;Rencana Pengembangan Kampung&rdquo; yang berbasis pada aset lokal mereka sendiri.</p><p>Diharapkan, keterampilan fasilitasi yang diperoleh dapat mendorong masyarakat untuk bangkit, mengelola potensi kampung secara mandiri, dan meningkatkan kesejahteraan hidup mereka. Kegiatan ini diikuti oleh perwakilan dari Kabupaten Sarmi, Paniai, dan Raja Ampat, bersama dengan staf YADUPA pusat serta cabang.</p><p>Pelatihan ini merupakan bagian dari rangkaian program pengembangan masyarakat YADUPA, yang juga mencakup pelatihan Pengembangan Masyarakat Berbasis Aset (ABCD) dan wawancara apresiatif. Seluruh rangkaian kegiatan tersebut menjadi kontribusi nyata YADUPA dalam merayakan usia ke-20 tahun dedikasinya bagi masyarakat adat di Tanah Papua.</p>',
                'published_at' => '2023-04-30',
            ],
            [
                'title'   => 'Pelatihan Dan Penguatan Kapasitas Berbasis Aset Oleh YADUPA',
                'image'   => 'img/media/pelatihan-dan-penguatan-kapasitas-berbasis-aset-oleh-yadupa-1.jpg',
                'content' => '<p>Yayasan Anak Dusun Papua (YADUPA) sebagai lembaga di bawah Dewan Adat Papua berfokus memperjuangkan hak-hak dasar masyarakat adat melalui berbagai program prioritas, termasuk pengembangan masyarakat dan generasi muda. Untuk memperkuat kapasitas staf dan motivator kampung di wilayah dampingan, YADUPA menyelenggarakan pelatihan perencanaan pembangunan menggunakan pendekatan Asset-Based Community Development (ABCD) serta metode 4D.</p><p>Pendekatan ini mengarahkan masyarakat untuk mengenali potensi dan aset lokal yang dimiliki, alih-alih berfokus pada masalah, guna merancang pembangunan kampung secara mandiri. Kegiatan pelatihan peningkatan kapasitas yang dilaksanakan pada 30 Maret hingga 1 April 2023 di Jayapura ini diikuti oleh staf pusat serta perwakilan motivator dari berbagai kabupaten.</p><p>Melalui sesi teori dan praktik yang difasilitasi oleh narasumber, peserta memperoleh paradigma baru yang menempatkan masyarakat sebagai subjek pembangunan. Di akhir kegiatan, para peserta berhasil menyusun rencana kerja dan Rencana Tindak Lanjut (RTL) yang siap diterapkan di wilayah masing-masing demi mewujudkan pemberdayaan masyarakat adat yang berkesinambungan.</p>',
                'published_at' => '2023-04-01',
            ],
            [
                'title'   => 'Pertemuan Sharing Informasi dan Pengalaman Pendampingan Masyarakat',
                'image'   => 'img/media/pertemuan-sharing-informasi-dan-pengalaman-pendampingan-masyarakat-1.jpg',
                'content' => '<p>Yayasan Anak Dusun Papua (YADUPA) menyelenggarakan rapat koordinasi untuk mengevaluasi capaian program pendampingan masyarakat di Kabupaten Yapen, Waropen, Biak, dan Yalimo. Pertemuan yang dilaksanakan pada 23 September 2022 ini menjadi wadah bagi staf pusat, cabang, serta pelaksana program lapangan untuk berbagi pengalaman, hambatan, dan progres implementasi program selama beberapa tahun terakhir.</p><p>Selain mengevaluasi proses kelembagaan dan pengembangan SDM, diskusi ini difokuskan pada penguatan rencana pelaksanaan program berbasis Asset-Based Community Development (ABCD). Melalui refleksi atas pengalaman masa lalu, diharapkan implementasi program pengembangan masyarakat ke depan dapat berjalan lebih efektif dan memberikan manfaat berkelanjutan bagi masyarakat dampingan di wilayah tersebut.</p>',
                'published_at' => '2022-09-23',
            ],
            [
                'title'   => 'Pra-Lokakarya Pemetaan Wilayah Adat Suku Awera/Taru dan Demisa Kabupaten Waropen',
                'image'   => 'img/media/pra-lokakarya-pemetaan-wilayah-adat-waropen-1.jpg',
                'content' => '<p>Yayasan Anak Dusun Papua (YADUPA) menyelenggarakan kegiatan Pra-Lokakarya Pemetaan Wilayah Adat Suku Awera/Taru dan Demisa di Inggerus pada 25-26 Agustus 2023. Mengusung tema &ldquo;Membangun Pemahaman Bersama Dalam Pelaksanaan Penataan Wilayah Adat di Kabupaten Waropen&rdquo;, kegiatan ini dihadiri oleh perwakilan pemerintah daerah seperti KESBANGPOL dan BAPEDA, kepala pemerintahan kampung, tokoh adat, serta masyarakat.</p><p>Pemetaan partisipatif ini penting dilakukan untuk melindungi identitas budaya, memperjelas batas ulayat secara geografis dan sosial, serta mencegah konflik tata ruang akibat tumpang tindih kawasan dengan pemerintah maupun investor. Melalui kegiatan ini, diharapkan masyarakat adat dapat berpartisipasi langsung agar tidak lagi menjadi objek, melainkan penentu dan pelaksana pembangunan di daerahnya.</p>',
                'published_at' => '2023-08-26',
            ],
            [
                'title'   => 'Lomba Pidato Pelajar SMA/SMK Kota dan Kabupaten Jayapura Tahun 2023',
                'image'   => 'img/media/lomba-pidato-sma-smk-jayapura-1.jpg',
                'content' => '<p>Yayasan Anak Dusun Papua (YADUPA) bekerja sama dengan Generasi Muda Papua Untuk Hak Adat (GEMPHA) menyelenggarakan Lomba Pidato tingkat SMA/SMK se-Kota dan Kabupaten Jayapura tahun 2023 dengan mengusung tema &ldquo;Pemekaran dan Masyarakat Adat (Berkat atau Kutuk)&rdquo;.</p><p>Kegiatan tahunan ini melalui beberapa tahapan mulai dari pendaftaran, technical meeting, babak penyisihan di Aula Kesusteran Maranatha Waena yang diikuti 16 peserta dari 10 sekolah, hingga babak final yang disiarkan langsung melalui stasiun televisi lokal Jaya TV pada 30 Juni 2023.</p><p>Melalui penilaian ketat oleh dewan juri profesional, Alvaro Julio Monim dari SMA Lentera Sentani keluar sebagai Juara I, diikuti oleh Mudita Ajeng Ramadhani dari SMA Negeri 1 Jayapura sebagai Juara II, dan Kristina Heliana Wanimbo dari SMA Lentera Sentani sebagai Juara III.</p>',
                'published_at' => '2023-06-30',
            ],
            [
                'title'   => 'Lomba Menulis Cerita Rakyat dan Bercerita di Radio oleh YADUPA dan GEMPHA',
                'image'   => 'img/media/lomba-menulis-cerita-rakyat-papua.jpg',
                'content' => '<p>Sebagai upaya melestarikan kearifan lokal dan membangun kecintaan generasi muda terhadap warisan budaya, Yayasan Anak Dusun Papua (YADUPA) bekerja sama dengan GEMPHA menyelenggarakan Lomba Menulis Cerita Rakyat dan Bercerita di Radio.</p><p>Pada tahun 2022, program ini berhasil menghimpun 25 karya tulis dari anak muda di 5 wilayah adat Papua, yang kemudian diseleksi menjadi 7 naskah terbaik untuk dibawakan langsung melalui RRI Pro 4 Jayapura. Cerita-cerita tersebut sarat akan nilai tradisional, mulai dari cara bertahan hidup hingga etika menjaga lingkungan.</p><p>Melalui kampanye #CeritaTentangSaPuKampung, YADUPA berkomitmen untuk mendokumentasikan karya-karya ini ke dalam bentuk komik, agar dapat menjadi warisan berharga bagi generasi mendatang.</p>',
                'published_at' => '2022-08-01',
            ],
            [
                'title'   => 'Ajang Debat Mahasiswa Tahun 2022: Kearifan Lokal sebagai Modal Pembangunan',
                'image'   => 'img/media/debat-mahasiswa-yadupa-2022.jpg',
                'content' => '<p>Yayasan Anak Dusun Papua (YADUPA) kembali menyelenggarakan ajang Debat Mahasiswa pada tahun 2022 dengan mengangkat tema &ldquo;Kearifan Lokal Masyarakat Adat Papua Sebagai Modal Dasar Pembangunan&rdquo;. Kegiatan ini bertujuan untuk membangun partisipasi aktif, wacana kritis, dan kesadaran generasi muda terhadap nilai-nilai tradisional Papua sebagai landasan pembangunan.</p><p>Debat ini diikuti oleh tiga tim pemenang dari UNIPA Manokwari, STFT Fajar Timur Jayapura, dan MUSAMUS Merauke, dengan mengangkat berbagai isu strategis seperti kebijakan afirmasi Otsus, UU Masyarakat Adat, hingga keterampilan bertahan hidup. Tim Noken dari STFT Fajar Timur berhasil keluar sebagai Juara I dalam kompetisi ini, yang diharapkan dapat terus menjadi ruang aspirasi serta wadah bagi mahasiswa untuk menyumbangkan gagasan konstruktif bagi tanah Papua.</p>',
                'published_at' => '2022-05-01',
            ],
            [
                'title'   => 'Perencanaan Kerja Strategis (Renstra) YADUPA 2021-2025',
                'image'   => 'img/media/perencanaan-kerja-strategis-yadupa-2021.jpg',
                'content' => '<p>Yayasan Anak Dusun Papua (YADUPA) telah merumuskan Rencana Kerja Strategis (RENSTRA) untuk periode lima tahun, yakni 2021 hingga 2025. Kegiatan penyusunan ini dilaksanakan pada 9-12 Maret 2021 di P3W Padang Bulan, Abepura, dengan melibatkan seluruh staf pusat dan cabang serta Dewan Adat Papua.</p><p>Melalui Renstra ini, YADUPA menyepakati fokus kerja yang menggunakan pendekatan Asset-Based Community Development (ABCD) dengan tujuan utama meningkatkan ekonomi masyarakat adat, melindungi hak lingkungan, serta melestarikan budaya sosial masyarakat adat Papua.</p><p>Saat ini, program kerja YADUPA telah menyasar wilayah Kabupaten Yalimo, Yapen, Waropen, dan Biak, dengan rencana pengembangan cakupan wilayah ke area adat Mee Pago dan Domberay di masa mendatang.</p>',
                'published_at' => '2021-03-12',
            ],
            [
                'title'   => 'Rapat Kerja Triwulan Divisi YADUPA',
                'image'   => 'img/media/rapat-kerja-triwulan-divisi-yadupa-1.jpg',
                'content' => '<p>Untuk mengevaluasi pelaksanaan program kerja dari setiap divisi, Direktur Yayasan Anak Dusun Papua (YADUPA), Leonard Imbiri, memimpin rapat triwulan di kantor pusat YADUPA di Jayapura pada 19 Maret 2020.</p><p>Rapat ini bertujuan untuk meninjau progres kerja, memastikan kesesuaian dengan rencana awal, mengecek penerapan anggaran, serta memastikan teknis di lapangan mencapai target dan sasaran yang ditentukan. Kegiatan yang berjalan aman dan lancar ini dihadiri oleh staf administrasi, keuangan, serta SRJS agar seluruh staf dapat mengetahui bersama progres program kegiatan yang telah dilaksanakan.</p>',
                'published_at' => '2020-03-19',
            ],
        ];

        foreach ($datas as $data) {
            Informasi::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'user_id'      => $userId,
                    'title'        => $data['title'],
                    'category'     => 'Berita',
                    'image'        => $data['image'],
                    'content'      => $data['content'],
                    'status'       => true,
                    'published_at' => $data['published_at'],
                ]
            );
        }
    }
}
