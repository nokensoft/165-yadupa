<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Halaman contoh yang dapat dikelola operator melalui menu Halaman.
     * Konten diringkas dari YADUPA_PROFILE.MD (profil resmi YADUPA per tahun 2026).
     */
    public function run(): void
    {
        $pages = [
            [
            'title' => 'Sejarah & Tujuan Pendirian',
            'cover' => 'img/media/perencanaan-kerja-strategis-yadupa-2021.jpg',
            'content' => '
                <h3>Bagaimana YADUPA Lahir?</h3>
                <p>Melalui Rapat Kerja Dewan Adat Papua yang Pertama, Dewan Adat Papua memutuskan mendirikan organisasi yang dapat membantu mengimplementasikan Dewan Adat Papua, guna penguatan Masyarakat Adat.</p>
                <p>Kesepakatan ini direalisasikan melalui Akta Notaris Nomor 17, di mana pada tanggal <strong>23 April 2003</strong> didirikan organisasi Masyarakat Adat Papua dengan nama <strong>Yayasan Anak Dusun Papua (YADUPA)</strong>.</p>

                <h3 class="mt-6">Tujuan Pendirian</h3>
                <ol>
                    <li>Sebagai penguatan Masyarakat Adat Papua dengan melibatkan masyarakat dalam perencanaan sampai pada implementasi program secara berkelanjutan.</li>
                    <li>Meningkatkan kualitas hidup Masyarakat Adat terkait pengembangan masyarakat yang berdasarkan pada nilai-nilai budaya.</li>
                    <li>Melibatkan Generasi Muda dalam bekerja dan mempromosikan hak-hak Masyarakat Adat.</li>
                </ol>
            ',
            ],

            [
            'title' => 'Prinsip & Bidang Kerja',
            'cover' => 'img/media/pelatihan-kemampuan-fasilitasi-bagi-staf-lapangan-dan-motivator-kampung.jpg',
            'content' => '
                <h3>Prinsip Kerja</h3>
                <ul>
                    <li>Kemandirian</li>
                    <li>Keadilan</li>
                    <li>Kebenaran</li>
                    <li>Demokrasi</li>
                    <li>Kesetaraan Gender</li>
                </ul>

                <h3 class="mt-6">Bidang Kerja Utama</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Bidang</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Lobby and Advocacy</strong></td>
                            <td>Melakukan dialog strategis, lobi, dan advokasi kebijakan untuk memperjuangkan serta mempromosikan hak-hak masyarakat adat Papua.</td>
                        </tr>
                        <tr>
                            <td><strong>Community Development</strong></td>
                            <td>Pendampingan langsung masyarakat dari tahap perencanaan hingga implementasi program secara mandiri dan berkelanjutan di tingkat kampung.</td>
                        </tr>
                        <tr>
                            <td><strong>Share Resources, Join Solution</strong></td>
                            <td>Membangun kolaborasi dan berbagi sumber daya guna merumuskan solusi bersama atas berbagai tantangan yang dihadapi komunitas adat.</td>
                        </tr>
                    </tbody>
                </table>
            ',
            ],

            [
            'title' => 'Program Kerja & Implementasi Lapangan',
            'cover' => 'img/media/pra-lokakarya-pemetaan-wilayah-adat-waropen-1.jpg',
            'content' => '
                <h3>Pilar 01 — Pelestarian Budaya</h3>
                <p>Menjaga warisan leluhur melalui sistem pendidikan budaya, dokumentasi nilai, serta kebijakan pemerintah.</p>
                <ul>
                    <li>Melestarikan adat melalui pendidikan budaya</li>
                    <li>Mendokumentasikan nilai-nilai budaya melalui pembelajaran budaya</li>
                    <li>Mendorong pemerintah & isu lain untuk melestarikan budaya melalui kebijakan</li>
                </ul>
                <blockquote><strong>Implementasi:</strong> Pelestarian budaya di kampung-kampung melalui pelaksanaan Wor (Nyanyian Biak), pelatihan ukiran, serta tarian tradisional Biak sebagai media transfer pengetahuan kepada generasi muda.</blockquote>

                <h3 class="mt-6">Pilar 02 — Pengembangan Ekonomi Kerakyatan</h3>
                <p>Mengembangkan aset, produk lokal, kapasitas masyarakat, serta memperluas akses jaringan pasar.</p>
                <ul>
                    <li>Mengembangkan aset Masyarakat Adat</li>
                    <li>Mengembangkan produk-produk Masyarakat Adat</li>
                    <li>Mengembangkan jaringan pasar bagi pemasaran produk lokal</li>
                    <li>Mengembangkan kapasitas masyarakat adat dalam pengolahan</li>
                </ul>
                <table>
                    <thead>
                        <tr>
                            <th>Kampung</th>
                            <th>Kabupaten</th>
                            <th>Produk / Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Turu</td><td>Yapen</td><td>Inovasi pizza dari bahan lokal (keladi)</td></tr>
                        <tr><td>Sarawandori</td><td>Yapen</td><td>Produksi mie rumput laut</td></tr>
                        <tr><td>Waniwon</td><td>Yapen</td><td>Kerajinan tangan dari daun tikar</td></tr>
                        <tr><td>Owi</td><td>Biak</td><td>Pengolahan VCO (Virgin Coconut Oil) dari kelapa</td></tr>
                        <tr><td>Imbari</td><td>Biak</td><td>Pengolahan minyak gaharu</td></tr>
                    </tbody>
                </table>

                <h3 class="mt-6">Pilar 03 — Perlindungan Lingkungan & Ekowisata</h3>
                <p>Menjaga kelestarian alam berbasis kearifan masyarakat adat serta memetakan wilayah adat secara partisipatif.</p>
                <ul>
                    <li>Mendorong ekowisata berbasis kearifan lokal</li>
                    <li>Melestarikan lingkungan berbasis masyarakat adat</li>
                    <li>Pengembangan potensi wisata kampung</li>
                    <li>Pemetaan wilayah adat secara partisipatif</li>
                </ul>
                <blockquote><strong>Implementasi:</strong> Pemetaan Wilayah Adat Uruie Faisei di Kabupaten Waropen, sebagai bentuk perlindungan hak ulayat dan pengelolaan sumber daya alam yang berkelanjutan.</blockquote>
            ',
            ],

            [
            'title' => 'Mitra & Jaringan',
            'cover' => null,
            'content' => '
                <p>Halaman mitra dan jaringan kerja sama YADUPA masih dalam tahap penyusunan (<em>coming soon</em>) pada situs resmi.</p>
                <p>Pihak yang ingin berkolaborasi dapat menghubungi kantor pusat YADUPA melalui halaman Kontak & Kolaborasi.</p>
            ',
            ],

            [
            'title' => 'FAQ',
            'cover' => null,
            'content' => '
                <h3>Pertanyaan yang Sering Diajukan (FAQ)</h3>

                <h4 class="mt-6">1. Apa itu YADUPA?</h4>
                <p>YADUPA (Yayasan Anak Dusun Papua) adalah Lembaga Swadaya Masyarakat (LSM) yang mendapatkan mandat untuk bekerja sebagai penguatan Masyarakat Adat Papua, secara khusus Generasi Muda Papua. YADUPA didirikan pada 23 April 2003 melalui Akta Notaris Nomor 17.</p>

                <h4 class="mt-6">2. Apa fokus kerja utama YADUPA?</h4>
                <p>YADUPA berfokus pada tiga bidang utama: lobi dan advokasi kebijakan (lobby and advocacy), pendampingan masyarakat (community development), serta kolaborasi berbagi sumber daya (share resources, join solution). Implementasi lapangan mencakup tiga pilar program: Pelestarian Budaya, Pengembangan Ekonomi Kerakyatan, dan Perlindungan Lingkungan & Ekowisata.</p>

                <h4 class="mt-6">3. Di wilayah mana saja YADUPA bekerja?</h4>
                <p>Selain kantor pusat di Kota Jayapura, YADUPA memiliki kantor cabang di Kabupaten Yapen, Kabupaten Biak, Kabupaten Waropen, dan Kabupaten Yalimo.</p>

                <h4 class="mt-6">4. Bagaimana cara berkolaborasi atau menjadi mitra YADUPA?</h4>
                <p>Pihak yang ingin berkolaborasi dapat menghubungi kantor pusat YADUPA melalui email office@yadupa.org, telepon (0967) 584433, atau mendatangi kantor pusat maupun kantor cabang terdekat.</p>

                <h4 class="mt-6">5. Bagaimana cara mendapatkan informasi terbaru mengenai kegiatan YADUPA?</h4>
                <p>Informasi kegiatan, berita, dan dokumentasi terbaru dapat diakses melalui menu Media (Berita & Informasi, Galeri Foto, dan Galeri Video) pada situs ini.</p>
            ',
            ],

            [
            'title' => 'Kebijakan Privasi',
            'cover' => null,
            'content' => '
                <h3>Kebijakan Privasi</h3>
                <p>Selamat datang di situs resmi YADUPA (Yayasan Anak Dusun Papua). Kami berkomitmen untuk melindungi privasi dan keamanan data pribadi Anda saat menggunakan layanan digital kami.</p>

                <h3 class="mt-6">1. Pengumpulan Informasi</h3>
                <p>Kami mengumpulkan informasi non-pribadi secara otomatis (seperti alamat IP, tipe peramban, dan halaman yang dikunjungi) untuk keperluan statistik pengunjung dan peningkatan kualitas layanan situs. Informasi pribadi hanya dikumpulkan saat Anda mengisinya secara sukarela melalui formulir kontak.</p>

                <h3 class="mt-6">2. Penggunaan Informasi</h3>
                <p>Informasi yang dikumpulkan hanya digunakan untuk merespons pertanyaan, memproses permohonan kolaborasi, serta meningkatkan efektivitas penyampaian informasi kepada masyarakat.</p>

                <h3 class="mt-6">3. Perlindungan & Keamanan Data</h3>
                <p>Kami menerapkan langkah-langkah keamanan teknis dan organisatoris untuk melindungi data Anda dari akses, perubahan, atau penyalahgunaan yang tidak sah. Kami tidak membagikan, menjual, atau menyewakan informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali diwajibkan oleh undang-undang.</p>

                <h3 class="mt-6">4. Perubahan Kebijakan Privasi</h3>
                <p>Kebijakan Privasi ini dapat diperbarui sewaktu-waktu. Perubahan akan langsung dipublikasikan di halaman ini.</p>
            ',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => Str::slug($page['title'])],
                [
                    'title'   => $page['title'],
                    'cover'   => $page['cover'],
                    'content' => trim($page['content']),
                    'status'  => true,
                ]
            );
        }
    }
}
