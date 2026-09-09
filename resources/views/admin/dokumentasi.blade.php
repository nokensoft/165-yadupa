@extends('layouts.dashboard')
@section('title', 'Dokumentasi')
@section('page-title', 'Dokumentasi')

@section('content')
<div class="flex gap-8" x-data="sectionNav()">

    {{-- Main Content --}}
    <div x-data="dokumentasi()" class="flex-1 min-w-0">

    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <button @click="downloadPdf()" :disabled="pdfLoading"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-bold text-lg uppercase tracking-wide hover:bg-primary-700 transition disabled:opacity-50">
            <i class="fas" :class="pdfLoading ? 'fa-spinner fa-spin' : 'fa-file-pdf'"></i>
            <span x-text="pdfLoading ? 'Generating...' : 'Download PDF'"></span>
        </button>
        <button @click="copyTable()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-dark text-white font-bold text-lg uppercase tracking-wide hover:bg-gray-700 transition">
            <i class="fas" :class="copied ? 'fa-check' : 'fa-copy'"></i>
            <span x-text="copied ? 'Tersalin!' : 'Copy Informasi'"></span>
        </button>
    </div>

    {{-- PDF Content Area --}}
    <div id="dokumentasi-content">

        {{-- Header --}}
        <div id="sec-header" class="bg-white shadow-sm p-6 mb-6">
            <h2 class="text-2xl font-extrabold text-dark mb-1">YADUPA - Yayasan Anak Dusun Papua</h2>
            <p class="text-gray-500">Website resmi YADUPA - Yayasan Anak Dusun Papua — organisasi masyarakat sipil untuk pengkajian dan pemberdayaan masyarakat adat Papua. Menampilkan informasi program pemberdayaan masyarakat adat, konten blog, foto bercerita kegiatan, dan donasi.</p>
        </div>

        {{-- Informasi Proyek (Copyable Table) --}}
        <div id="sec-info" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-info-circle mr-2 text-primary"></i>Informasi Proyek
            </h3>
            <table id="info-table" class="w-full text-left">
                <tbody>
                    @php
                        $infoProyek = [
                            ['Nama Proyek', 'Website YADUPA - Yayasan Anak Dusun Papua'],
                            ['Deskripsi', 'Website resmi Yayasan Lingkungan Hidup Papua'],
                            ['Versi', '1.0.0'],
                            ['Framework', 'Laravel 12 (PHP 8.2+)'],
                            ['Frontend', 'Tailwind CSS 4, Alpine.js 3, Vite 7'],
                            ['Database', 'MySQL'],
                            ['Editor', 'TinyMCE (WYSIWYG)'],
                            ['Icon', 'Font Awesome 7'],
                            ['Font', 'Frank Ruhl Libre (display), Rubik (body)'],
                            ['Autentikasi', 'Custom middleware, role-based access (admin_master, penulis)'],
                            ['Fitur Utama', 'CMS Halaman, Blog, Foto Bercerita, Donasi, SEO, Profil, Statistik Pengunjung, Aktivitas Login, Peta Situs'],
                            ['Developer', 'Nokensoft — PT Noken Inovasi Teknologi Informasi'],
                            ['Website Developer', 'www.nokensoft.com'],
                            ['Kontak Developer', 'info@nokensoft.com | 082199558191'],
                        ];
                    @endphp
                    @foreach ($infoProyek as $info)
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4 font-bold text-lg text-gray-700 w-48 align-top">{{ $info[0] }}</td>
                            <td class="py-3 text-lg text-gray-500">{{ $info[1] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Spesifikasi Teknologi --}}
        <div id="sec-teknologi" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-microchip mr-2 text-primary"></i>Spesifikasi Teknologi
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-server text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Backend</p><p class="text-lg text-gray-500">PHP 8.2+, Laravel 12</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-palette text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Frontend</p><p class="text-lg text-gray-500">Tailwind CSS 4, Alpine.js 3, Vite 7</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-database text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Database</p><p class="text-lg text-gray-500">MySQL</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-icons text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Icon</p><p class="text-lg text-gray-500">Font Awesome 7</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-pen-fancy text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Editor</p><p class="text-lg text-gray-500">TinyMCE (WYSIWYG)</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-shield-alt text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Autentikasi</p><p class="text-lg text-gray-500">Custom middleware, role-based access</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-font text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Font</p><p class="text-lg text-gray-500">Frank Ruhl Libre (display), Rubik (body)</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-chart-line text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Tracking</p><p class="text-lg text-gray-500">Pencatatan kunjungan situs otomatis</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-recycle text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Soft Delete</p><p class="text-lg text-gray-500">Data dihapus sementara, bisa di-restore</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-search text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">SEO</p><p class="text-lg text-gray-500">Dynamic robots.txt, XML sitemap, meta tags</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-image text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Optimasi Gambar</p><p class="text-lg text-gray-500">Konversi otomatis ke WebP, resize max 720px</p></div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-gray-50">
                    <i class="fas fa-bolt text-primary mt-1"></i>
                    <div><p class="font-bold text-lg">Caching</p><p class="text-lg text-gray-500">View Composer cache 5 menit untuk data situs global</p></div>
                </div>
            </div>
        </div>

        <div id="sec-fitur" class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            {{-- Fitur Visitor --}}
            <div class="bg-white shadow-sm p-6">
                <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                    <i class="fas fa-globe mr-2 text-primary"></i>Fitur Visitor (Publik)
                </h3>
                <div class="space-y-0">
                    @php
                    $fiturVisitor = [
                            ['icon' => 'fa-home', 'title' => 'Beranda', 'desc' => 'Statistik organisasi, blog terbaru, program unggulan, foto bercerita, mitra kerja'],
                            ['icon' => 'fa-landmark', 'title' => 'Sejarah', 'desc' => 'Sejarah pendirian YADUPA - Yayasan Anak Dusun Papua sejak 1988 (halaman dinamis CMS)'],
                            ['icon' => 'fa-building', 'title' => 'Profil', 'desc' => 'Profil organisasi yayasan (halaman dinamis CMS)'],
                            ['icon' => 'fa-handshake', 'title' => 'Mitra Kerja', 'desc' => 'Daftar mitra dan sponsor YADUPA - Yayasan Anak Dusun Papua (halaman dinamis CMS)'],
                            ['icon' => 'fa-briefcase', 'title' => 'Bidang Kerja', 'desc' => 'Informasi bidang kerja yayasan (halaman dinamis CMS)'],
                            ['icon' => 'fa-users', 'title' => 'Tokoh', 'desc' => 'Tokoh-tokoh pendiri dan pengurus yayasan'],
                            ['icon' => 'fa-list-check', 'title' => 'Program', 'desc' => 'Program unggulan: Informasi, Ekonomi Kerakyatan, Clean Water, Promosi Usaha'],
                            ['icon' => 'fa-newspaper', 'title' => 'Blog', 'desc' => 'Konten blog dengan filter kategori, pencarian, counter pembaca, dan blog terkait'],
                            ['icon' => 'fa-heart', 'title' => 'Donasi', 'desc' => 'Halaman donasi statis berisi informasi rekening resmi dan FAQ donasi'],
                            ['icon' => 'fa-images', 'title' => 'Foto Bercerita', 'desc' => 'Album foto kegiatan dengan pencarian dan halaman detail'],
                            ['icon' => 'fa-envelope', 'title' => 'Kontak', 'desc' => 'Informasi kontak dan media sosial YADUPA - Yayasan Anak Dusun Papua'],
                            ['icon' => 'fa-sitemap', 'title' => 'Peta Situs', 'desc' => 'Halaman peta situs (HTML sitemap) untuk navigasi lengkap'],
                            ['icon' => 'fa-robot', 'title' => 'SEO', 'desc' => 'Dynamic robots.txt dan XML sitemap otomatis untuk seluruh halaman publik'],
                        ];
                    @endphp
                    @foreach ($fiturVisitor as $fitur)
                        <div class="flex items-start space-x-3 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div class="w-8 h-8 bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fas {{ $fitur['icon'] }} text-lg"></i>
                            </div>
                            <div>
                                <p class="font-bold text-lg">{{ $fitur['title'] }}</p>
                                <p class="text-lg text-gray-500">{{ $fitur['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Fitur Admin & Penulis --}}
            <div class="bg-white shadow-sm p-6">
                <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                    <i class="fas fa-user-shield mr-2 text-primary"></i>Fitur Admin & Penulis
                </h3>
                <div class="space-y-0">
                    <p class="text-lg font-bold uppercase tracking-widest text-gray-400 mb-2">Admin Master</p>
                    @php
                        $fiturAdmin = [
                            ['icon' => 'fa-tachometer-alt', 'title' => 'Dasbor', 'desc' => 'Ringkasan data lengkap (pengguna, halaman, blog, foto bercerita, media, pengunjung), aktivitas login, blog terbaru, aksi cepat, info sistem'],
                            ['icon' => 'fa-file-alt', 'title' => 'Halaman (CMS)', 'desc' => 'Kelola halaman dinamis: sejarah, profil, mitra, bidang kerja, soft delete & restore'],
                            ['icon' => 'fa-cog', 'title' => 'Pengaturan Situs', 'desc' => 'Nama, deskripsi, kontak, sosmed, logo, peta lokasi, SEO'],
                            ['icon' => 'fa-database', 'title' => 'Backup Database', 'desc' => 'Buat, download, hapus, dan restore backup SQL'],
                            ['icon' => 'fa-folder-open', 'title' => 'Backup Storage', 'desc' => 'Buat, download, hapus, restore backup ZIP storage, dan buat storage link (symlink)'],
                            ['icon' => 'fa-users', 'title' => 'Kelola Pengguna', 'desc' => 'CRUD pengguna dengan soft delete, restore & force delete'],
                            ['icon' => 'fa-history', 'title' => 'Aktivitas Login', 'desc' => 'Log riwayat login seluruh pengguna'],
                            ['icon' => 'fa-chart-bar', 'title' => 'Statistik Pengunjung', 'desc' => 'Statistik pengunjung harian, mingguan, bulanan, tahunan'],
                            ['icon' => 'fa-user-edit', 'title' => 'Profil', 'desc' => 'Edit profil akun (nama, email, password, nomor HP, keterangan singkat)'],
                        ];
                    @endphp
                    @foreach ($fiturAdmin as $fitur)
                        <div class="flex items-start space-x-3 py-3 border-b border-gray-100">
                            <div class="w-8 h-8 bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fas {{ $fitur['icon'] }} text-lg"></i>
                            </div>
                            <div>
                                <p class="font-bold text-lg">{{ $fitur['title'] }}</p>
                                <p class="text-lg text-gray-500">{{ $fitur['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach

                    <p class="text-lg font-bold uppercase tracking-widest text-gray-400 mt-4 mb-2">Penulis</p>
                    @php
                        $fiturPenulis = [
                            ['icon' => 'fa-newspaper', 'title' => 'Blog', 'desc' => 'CRUD blog dengan status terbit/draft, soft delete, restore & force delete'],
                            ['icon' => 'fa-tags', 'title' => 'Kategori Blog', 'desc' => 'CRUD kategori blog dengan soft delete, restore & force delete'],
                            ['icon' => 'fa-photo-video', 'title' => 'Media', 'desc' => 'Upload & kelola media (gambar/video), konversi otomatis ke WebP, AJAX upload, soft delete & restore'],
                            ['icon' => 'fa-images', 'title' => 'Foto Bercerita', 'desc' => 'CRUD album foto bercerita dengan relasi media, toggle publik, soft delete & restore'],
                            ['icon' => 'fa-chart-bar', 'title' => 'Statistik Pengunjung', 'desc' => 'Grafik kunjungan situs'],
                            ['icon' => 'fa-history', 'title' => 'Aktivitas Login', 'desc' => 'Log riwayat login penulis'],
                            ['icon' => 'fa-user-edit', 'title' => 'Profil', 'desc' => 'Edit profil akun (nama, email, password, nomor HP, keterangan singkat)'],
                        ];
                    @endphp
                    @foreach ($fiturPenulis as $fitur)
                        <div class="flex items-start space-x-3 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div class="w-8 h-8 bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fas {{ $fitur['icon'] }} text-lg"></i>
                            </div>
                            <div>
                                <p class="font-bold text-lg">{{ $fitur['title'] }}</p>
                                <p class="text-lg text-gray-500">{{ $fitur['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Developer / Author --}}
        <div id="sec-developer" class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-code mr-2 text-primary"></i>Developer
            </h3>
            <div class="flex flex-col sm:flex-row items-start gap-6">
                <div class="shrink-0">
                    <img src="{{ asset('nokensoft/logo-nokensoft.png') }}" alt="Nokensoft" class="w-20 h-20 object-contain">
                </div>
                <div class="flex-1">
                    <h4 class="text-xl font-extrabold text-dark">Nokensoft</h4>
                    <p class="text-lg text-gray-500 mb-3">PT Noken Inovasi Teknologi Informasi</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 text-lg">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-globe text-primary w-5 text-center"></i>
                            <a href="https://www.nokensoft.com" target="_blank" class="text-primary hover:underline">www.nokensoft.com</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-envelope text-primary w-5 text-center"></i>
                            <a href="mailto:info@nokensoft.com" class="text-primary hover:underline">info@nokensoft.com</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fab fa-whatsapp text-primary w-5 text-center"></i>
                            <span class="text-gray-600">082199558191</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-lg font-bold uppercase tracking-widest text-gray-400 mb-2">Layanan Utama</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach (['CMS Berbasis AI', 'Chat Bot', 'SIM Berbasis AI', 'Pembuatan Website Organisasi', 'Pengembangan Sistem Informasi Pemerintahan', 'Pendampingan dan Strategi Pemasaran'] as $layanan)
                                <span class="inline-block px-3 py-1 bg-gray-100 text-lg text-gray-600 font-medium">{{ $layanan }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /#dokumentasi-content --}}

    </div>{{-- /dokumentasi() --}}

    {{-- Sidebar Navigation --}}
    <aside class="hidden lg:block w-56 shrink-0">
        <nav class="sticky top-24 bg-white shadow-sm p-4 space-y-1">
            <p class="text-lg font-extrabold uppercase text-gray-400 tracking-wider mb-3 px-3">Navigasi</p>
            <template x-for="item in sections" :key="item.id">
                <a :href="'#' + item.id" @click.prevent="scrollTo(item.id)"
                   class="flex items-center gap-2.5 px-3 py-2.5 text-lg font-semibold transition-all"
                   :class="active === item.id ? 'text-primary bg-red-50 border-l-3 border-primary' : 'text-gray-500 hover:text-dark hover:bg-gray-50 border-l-3 border-transparent'">
                    <i :class="item.icon" class="w-4 text-center text-lg"></i>
                    <span x-text="item.label"></span>
                </a>
            </template>
        </nav>
    </aside>
</div>{{-- /sectionNav() flex wrapper --}}
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js"></script>
<script>
function sectionNav() {
    return {
        active: 'sec-header',
        sections: [
            { id: 'sec-header',     label: 'Tentang',               icon: 'fas fa-info-circle' },
            { id: 'sec-info',       label: 'Informasi Proyek',       icon: 'fas fa-file-alt' },
            { id: 'sec-teknologi',  label: 'Spesifikasi Teknologi',  icon: 'fas fa-microchip' },
            { id: 'sec-fitur',      label: 'Fitur Website',          icon: 'fas fa-list-check' },
            { id: 'sec-developer',  label: 'Developer',              icon: 'fas fa-code' },
        ],
        init() {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) this.active = entry.target.id;
                });
            }, { rootMargin: '-20% 0px -70% 0px', threshold: 0 });

            this.sections.forEach(s => {
                const el = document.getElementById(s.id);
                if (el) obs.observe(el);
            });
        },
        scrollTo(id) {
            const el = document.getElementById(id);
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    };
}

function dokumentasi() {
    return {
        pdfLoading: false,
        copied: false,

        async downloadPdf() {
            this.pdfLoading = true;
            try {
                const el = document.getElementById('dokumentasi-content');

                // Build PDF header with logos
                const header = document.createElement('div');
                header.innerHTML = `
                    <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:3px solid #2d8057;padding-bottom:16px;margin-bottom:24px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <img src="{{ asset('img/logo-yali-papua.png') }}" style="height:48px;" />
                            <div>
                                <div style="font-size:18px;font-weight:800;color:#1A1A1A;">{{ $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua' }}</div>
                                <div style="font-size:12px;color:#707070;">Dokumentasi Teknis Website</div>
                            </div>
                        </div>
                        <div style="text-align:right;">
                            <img src="{{ asset('nokensoft/logo-nokensoft.png') }}" style="height:36px;" />
                            <div style="font-size:10px;color:#707070;margin-top:2px;">by Nokensoft</div>
                        </div>
                    </div>
                `;

                // Build footer
                const footer = document.createElement('div');
                footer.innerHTML = `
                    <div style="border-top:2px solid #2d8057;padding-top:12px;margin-top:32px;display:flex;justify-content:space-between;font-size:10px;color:#707070;">
                        <span>Dokumentasi Website {{ $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua' }} — Nokensoft &copy; {{ date('Y') }}</span>
                        <span>www.nokensoft.com | info@nokensoft.com</span>
                    </div>
                `;

                // Clone content and prepend header, append footer
                const wrapper = document.createElement('div');
                wrapper.appendChild(header);
                const clone = el.cloneNode(true);
                wrapper.appendChild(clone);
                wrapper.appendChild(footer);

                const opt = {
                    margin:       [10, 12, 10, 12],
                    filename:     'Dokumentasi-YADUPA - Yayasan Anak Dusun Papua.pdf',
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2, useCORS: true, logging: false },
                    jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                    pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
                };

                await html2pdf().set(opt).from(wrapper).save();
            } catch (e) {
                console.error('PDF generation error:', e);
                alert('Gagal generate PDF. Silakan coba lagi.');
            } finally {
                this.pdfLoading = false;
            }
        },

        copyTable() {
            const rows = document.querySelectorAll('#info-table tbody tr');
            let text = '';
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length >= 2) {
                    text += cells[0].textContent.trim() + '\t: ' + cells[1].textContent.trim() + '\n';
                }
            });

            navigator.clipboard.writeText(text.trim()).then(() => {
                this.copied = true;
                setTimeout(() => { this.copied = false; }, 2000);
            }).catch(() => {
                // Fallback
                const ta = document.createElement('textarea');
                ta.value = text.trim();
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                this.copied = true;
                setTimeout(() => { this.copied = false; }, 2000);
            });
        }
    };
}
</script>
@endpush
