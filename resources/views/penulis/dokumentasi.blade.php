@extends('layouts.dashboard')
@section('title', 'Panduan Penggunaan')
@section('page-title', 'Panduan Penggunaan')

@section('content')
<div class="flex gap-8" x-data="sectionNav()">

    {{-- Main Content --}}
    <div x-data="dokPenulis()" class="flex-1 min-w-0">

    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <button @click="downloadPdf()" :disabled="pdfLoading"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-bold text-lg uppercase tracking-wide hover:bg-primary-700 transition disabled:opacity-50">
            <i class="fas" :class="pdfLoading ? 'fa-spinner fa-spin' : 'fa-file-pdf'"></i>
            <span x-text="pdfLoading ? 'Generating...' : 'Download PDF'"></span>
        </button>
    </div>

    {{-- PDF Content Area --}}
    <div id="dokumentasi-content">

        {{-- Header --}}
        <div id="sec-header" class="bg-white shadow-sm p-6 mb-6">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold text-dark mb-1">Panduan Penggunaan — Penulis</h2>
                    <p class="text-gray-500">Panduan lengkap penggunaan panel Penulis pada website {{ $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua' }}. Dokumen ini menjelaskan cara mengelola konten blog, media, foto bercerita, dan fitur lainnya.</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 mt-4 text-lg">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary/10 text-primary font-bold"><i class="fas fa-user-pen"></i> Role: Penulis</span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-600 font-medium"><i class="fas fa-calendar"></i> Diperbarui: {{ date('d M Y') }}</span>
            </div>
        </div>

        {{-- Daftar Isi --}}
        <div id="sec-daftar-isi" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-list-ol mr-2 text-primary"></i>Daftar Isi
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 text-lg">
                @php
                    $daftarIsi = [
                        ['sec-login', 'Login & Navigasi'],
                        ['sec-dashboard', 'Dasbor'],
                        ['sec-blog', 'Mengelola Blog'],
                        ['sec-kategori', 'Mengelola Kategori Blog'],
                        ['sec-media', 'Mengelola Media'],
                        ['sec-galeri', 'Mengelola Foto Bercerita'],
                        ['sec-statistik', 'Statistik Pengunjung'],
                        ['sec-aktivitas', 'Aktivitas Login'],
                        ['sec-profil', 'Edit Profil'],
                        ['sec-tips', 'Tips & Catatan Penting'],
                        ['sec-developer', 'Developer'],
                    ];
                @endphp
                @foreach ($daftarIsi as $i => $item)
                    <a href="#{{ $item[0] }}" class="flex items-center gap-2 py-1 text-gray-600 hover:text-primary transition">
                        <span class="w-6 h-6 bg-primary/10 text-primary flex items-center justify-center shrink-0 text-lg font-bold">{{ $i + 1 }}</span>
                        {{ $item[1] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- 1. Login & Navigasi --}}
        <div id="sec-login" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-sign-in-alt mr-2 text-primary"></i>1. Login & Navigasi
            </h3>
            <div class="space-y-4 text-lg text-gray-600">
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 bg-primary text-white flex items-center justify-center shrink-0 text-lg font-bold mt-0.5">1</span>
                    <div>
                        <p class="font-bold text-dark">Buka Halaman Login</p>
                        <p>Akses halaman login melalui URL: <code class="bg-gray-100 px-2 py-0.5 text-primary font-mono">/login</code></p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 bg-primary text-white flex items-center justify-center shrink-0 text-lg font-bold mt-0.5">2</span>
                    <div>
                        <p class="font-bold text-dark">Masukkan Kredensial</p>
                        <p>Isi <strong>email</strong> dan <strong>password</strong> akun Penulis yang telah didaftarkan oleh Admin.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 bg-primary text-white flex items-center justify-center shrink-0 text-lg font-bold mt-0.5">3</span>
                    <div>
                        <p class="font-bold text-dark">Navigasi Sidebar</p>
                        <p>Setelah login, gunakan <strong>sidebar kiri</strong> untuk mengakses semua menu: Blog, Media, Foto Bercerita, Statistik, dll. Di perangkat mobile, klik ikon <i class="fas fa-bars text-gray-400"></i> untuk membuka sidebar.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 bg-primary text-white flex items-center justify-center shrink-0 text-lg font-bold mt-0.5">4</span>
                    <div>
                        <p class="font-bold text-dark">Logout</p>
                        <p>Klik nama Anda di pojok kanan atas, kemudian pilih <strong>Logout</strong>.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Dasbor --}}
        <div id="sec-dashboard" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-tachometer-alt mr-2 text-primary"></i>2. Dasbor
            </h3>
            <div class="text-lg text-gray-600 space-y-3">
                <p>Halaman dasbor menampilkan ringkasan data keseluruhan yang Anda kelola:</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach ([
                        ['fa-newspaper', 'Jumlah blog yang telah dibuat'],
                        ['fa-images', 'Jumlah album foto bercerita'],
                        ['fa-photo-video', 'Jumlah file media (foto & video)'],
                        ['fa-tags', 'Jumlah kategori blog'],
                    ] as $item)
                        <div class="flex items-center gap-2 p-2 bg-gray-50">
                            <i class="fas {{ $item[0] }} text-primary w-5 text-center"></i>
                            <span>{{ $item[1] }}</span>
                        </div>
                    @endforeach
                </div>
                <p>Di bawah statistik, terdapat daftar <strong>Blog Terbaru</strong> yang Anda tulis beserta status (Draft / Terbit).</p>
            </div>
        </div>

        {{-- 3. Blog --}}
        <div id="sec-blog" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-newspaper mr-2 text-primary"></i>3. Mengelola Blog
            </h3>
            <div class="text-lg text-gray-600 space-y-4">
                <p>Menu <strong>Blog</strong> digunakan untuk membuat dan mengelola postingan blog.</p>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <p class="font-bold text-dark mb-2"><i class="fas fa-plus-circle mr-1 text-blue-500"></i> Menambah Blog Baru</p>
                    <ol class="list-decimal list-inside space-y-1">
                        <li>Klik tombol <strong>Tambah Blog</strong></li>
                        <li>Isi <strong>Judul Blog</strong> (wajib)</li>
                        <li>Isi <strong>Ringkasan</strong> (opsional — tampil di daftar blog publik)</li>
                        <li>Tulis <strong>Konten Blog</strong> menggunakan editor WYSIWYG (TinyMCE)</li>
                        <li>Isi <strong>Sumber Referensi</strong> jika konten diambil dari sumber lain (opsional)</li>
                        <li>Pilih <strong>Kategori</strong> dari dropdown</li>
                        <li>Atur <strong>Status</strong>: <code class="bg-gray-100 px-1">Draft</code> (belum tayang) atau <code class="bg-gray-100 px-1">Terbit</code> (tayang di website)</li>
                        <li>Atur <strong>Tanggal Publikasi</strong> (opsional — default tanggal saat ini)</li>
                        <li>Pilih <strong>Gambar Blog</strong> dari Media Library atau upload baru</li>
                        <li>Klik <strong>Simpan</strong></li>
                    </ol>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <p class="font-bold text-dark mb-2"><i class="fas fa-edit mr-1 text-yellow-500"></i> Mengedit Blog</p>
                    <p>Klik ikon <i class="fas fa-ellipsis-vertical text-gray-400"></i> pada baris blog, pilih <strong>Edit</strong>. Ubah data yang diperlukan, lalu klik <strong>Perbarui</strong>.</p>
                </div>

                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                    <p class="font-bold text-dark mb-2"><i class="fas fa-trash mr-1 text-red-500"></i> Menghapus & Memulihkan</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li><strong>Hapus</strong> — blog dipindahkan ke tempat sampah (soft delete), bisa dipulihkan</li>
                        <li><strong>Terhapus</strong> — klik tab/tombol "Terhapus" untuk melihat data yang dihapus</li>
                        <li><strong>Pulihkan</strong> — mengembalikan blog ke daftar aktif</li>
                        <li><strong>Hapus Permanen</strong> — menghapus data secara permanen, tidak bisa dikembalikan</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 4. Kategori --}}
        <div id="sec-kategori" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-tags mr-2 text-primary"></i>4. Mengelola Kategori Blog
            </h3>
            <div class="text-lg text-gray-600 space-y-3">
                <p>Menu <strong>Blog > Kategori Blog</strong> untuk membuat dan mengelola kategori blog.</p>
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <p class="font-bold text-dark mb-2">Cara Menambah Kategori</p>
                    <ol class="list-decimal list-inside space-y-1">
                        <li>Klik <strong>Tambah Kategori</strong></li>
                        <li>Isi <strong>Nama Kategori</strong> — slug (URL) akan otomatis dibuat dari nama</li>
                        <li>Klik <strong>Simpan</strong></li>
                    </ol>
                </div>
                <p>Kategori mendukung <strong>soft delete</strong> (hapus sementara), <strong>restore</strong> (pulihkan), dan <strong>force delete</strong> (hapus permanen).</p>
                <div class="bg-orange-50 border-l-4 border-orange-400 p-4 text-orange-800">
                    <i class="fas fa-exclamation-triangle mr-1"></i> <strong>Perhatian:</strong> Pastikan tidak ada blog yang menggunakan kategori sebelum menghapus permanen.
                </div>
            </div>
        </div>

        {{-- 5. Media --}}
        <div id="sec-media" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-photo-video mr-2 text-primary"></i>5. Mengelola Media
            </h3>
            <div class="text-lg text-gray-600 space-y-4">
                <p>Menu <strong>Media > Media</strong> untuk mengelola file gambar dan video yang digunakan di blog dan foto bercerita.</p>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <p class="font-bold text-dark mb-2">Upload Media Baru</p>
                    <ol class="list-decimal list-inside space-y-1">
                        <li>Klik <strong>Tambah Media</strong></li>
                        <li>Pilih tipe: <strong>Foto</strong> atau <strong>Video</strong> (YouTube)</li>
                        <li>Untuk foto: upload file gambar (otomatis dikonversi ke WebP & di-resize max 720px)</li>
                        <li>Untuk video: masukkan <strong>YouTube Video ID</strong></li>
                        <li>Isi <strong>Judul</strong></li>
                        <li>Klik <strong>Simpan</strong></li>
                    </ol>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50">
                        <p class="font-bold text-dark mb-1"><i class="fas fa-image text-primary mr-1"></i> Format Foto</p>
                        <p>JPG, PNG, GIF, WebP — maks 2MB. Gambar otomatis dioptimasi ke format WebP.</p>
                    </div>
                    <div class="p-4 bg-gray-50">
                        <p class="font-bold text-dark mb-1"><i class="fab fa-youtube text-red-500 mr-1"></i> Video YouTube</p>
                        <p>Masukkan Video ID saja (contoh: <code class="bg-gray-100 px-1">dQw4w9WgXcQ</code>), bukan full URL.</p>
                    </div>
                </div>

                <p>Media yang sudah di-upload dapat digunakan di <strong>Blog</strong> (sebagai gambar utama) dan <strong>Foto Bercerita</strong> (sebagai item foto cerita).</p>
            </div>
        </div>

        {{-- 6. Foto Bercerita --}}
        <div id="sec-galeri" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-images mr-2 text-primary"></i>6. Mengelola Foto Bercerita
            </h3>
            <div class="text-lg text-gray-600 space-y-4">
                <p>Menu <strong>Media > Foto Bercerita</strong> untuk membuat album foto/video kegiatan.</p>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <p class="font-bold text-dark mb-2">Membuat Album Foto Bercerita</p>
                    <ol class="list-decimal list-inside space-y-1">
                        <li>Klik <strong>Tambah Foto Bercerita</strong></li>
                        <li>Isi <strong>Judul Album</strong></li>
                        <li>Isi <strong>Deskripsi</strong> (opsional)</li>
                        <li>Pilih <strong>media</strong> (foto/video) yang ingin dimasukkan ke album — gunakan klik untuk memilih/membatalkan, bisa pilih banyak sekaligus</li>
                        <li>Klik <strong>Simpan</strong></li>
                    </ol>
                </div>

                <div class="bg-green-50 border-l-4 border-green-400 p-4">
                    <p class="font-bold text-dark mb-2"><i class="fas fa-eye mr-1 text-green-500"></i> Toggle Publik</p>
                    <p>Setiap album memiliki toggle <strong>Publik</strong>. Album yang ditandai publik akan tampil di halaman foto bercerita website. Album yang tidak publik hanya terlihat di panel penulis.</p>
                </div>
            </div>
        </div>


        {{-- 9. Statistik --}}
        <div id="sec-statistik" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-chart-bar mr-2 text-primary"></i>9. Statistik Pengunjung
            </h3>
            <div class="text-lg text-gray-600 space-y-3">
                <p>Menu <strong>Laporan > Statistik Pengunjung</strong> menampilkan data kunjungan website.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="flex items-center gap-2 p-3 bg-gray-50">
                        <i class="fas fa-eye text-blue-600 w-5 text-center"></i>
                        <span><strong>Hari Ini</strong> — jumlah pengunjung hari ini</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 bg-gray-50">
                        <i class="fas fa-calendar text-green-600 w-5 text-center"></i>
                        <span><strong>Bulan Ini</strong> — jumlah pengunjung bulan berjalan</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 bg-gray-50">
                        <i class="fas fa-users text-primary w-5 text-center"></i>
                        <span><strong>Total</strong> — total seluruh pengunjung</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 bg-gray-50">
                        <i class="fas fa-newspaper text-orange-500 w-5 text-center"></i>
                        <span><strong>Pembaca Blog</strong> — total pembaca seluruh blog</span>
                    </div>
                </div>
                <p>Gunakan tombol filter <strong>Harian</strong>, <strong>Mingguan</strong>, <strong>Bulanan</strong>, <strong>Tahunan</strong> untuk melihat data sesuai rentang waktu.</p>
            </div>
        </div>

        {{-- 10. Aktivitas Login --}}
        <div id="sec-aktivitas" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-history mr-2 text-primary"></i>10. Aktivitas Login
            </h3>
            <div class="text-lg text-gray-600 space-y-3">
                <p>Menu <strong>Pengguna > Aktivitas Login</strong> menampilkan riwayat login akun Anda.</p>
                <p>Informasi yang tersedia:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li><strong>Pengguna</strong> — nama akun yang login</li>
                    <li><strong>Email</strong> — email yang digunakan</li>
                    <li><strong>IP Address</strong> — alamat IP perangkat</li>
                    <li><strong>Waktu</strong> — tanggal dan jam login</li>
                    <li><strong>Status</strong> — Berhasil atau Gagal</li>
                </ul>
                <div class="bg-orange-50 border-l-4 border-orange-400 p-4 text-orange-800">
                    <i class="fas fa-shield-alt mr-1"></i> Jika Anda melihat aktivitas login yang mencurigakan, segera ubah password Anda melalui menu <strong>Edit Profil</strong>.
                </div>
            </div>
        </div>

        {{-- 11. Profil --}}
        <div id="sec-profil" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-user-edit mr-2 text-primary"></i>11. Edit Profil
            </h3>
            <div class="text-lg text-gray-600 space-y-3">
                <p>Klik <strong>nama Anda</strong> di pojok kanan atas, lalu pilih <strong>Edit Profil</strong>.</p>
                <p>Data yang dapat diubah:</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach ([
                        ['fa-user', 'Nama Lengkap'],
                        ['fa-envelope', 'Email'],
                        ['fa-lock', 'Password (opsional)'],
                        ['fa-phone', 'Nomor HP'],
                        ['fa-id-badge', 'Keterangan Singkat'],
                    ] as $field)
                        <div class="flex items-center gap-2 p-2 bg-gray-50">
                            <i class="fas {{ $field[0] }} text-primary w-5 text-center"></i>
                            <span>{{ $field[1] }}</span>
                        </div>
                    @endforeach
                </div>
                <p><strong>Role</strong> tidak dapat diubah sendiri — hanya Admin yang dapat mengubah role pengguna.</p>
            </div>
        </div>

        {{-- 12. Tips --}}
        <div id="sec-tips" class="bg-white shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-lightbulb mr-2 text-primary"></i>12. Tips & Catatan Penting
            </h3>
            <div class="text-lg text-gray-600 space-y-4">
                <div class="flex items-start gap-3 p-4 bg-green-50">
                    <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-dark">Upload Media Dulu</p>
                        <p>Sebelum membuat blog atau foto bercerita, pastikan gambar/video sudah di-upload di menu <strong>Media</strong>. Media yang sudah di-upload bisa digunakan berulang kali.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 bg-blue-50">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-dark">Gunakan Status Draft</p>
                        <p>Jika blog belum selesai, simpan dengan status <strong>Draft</strong>. Blog Draft tidak akan tampil di website publik.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 bg-yellow-50">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-dark">Soft Delete ≠ Hapus Permanen</p>
                        <p>Data yang dihapus masuk ke <strong>tempat sampah</strong> dan bisa dipulihkan. Gunakan <strong>Hapus Permanen</strong> hanya jika benar-benar yakin.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 bg-purple-50">
                    <i class="fas fa-image text-purple-600 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-dark">Optimasi Gambar Otomatis</p>
                        <p>Semua gambar yang di-upload otomatis dikonversi ke format <strong>WebP</strong> dan di-resize maksimal <strong>720px</strong> untuk performa website yang optimal.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 bg-red-50">
                    <i class="fas fa-shield-alt text-red-600 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-dark">Keamanan Akun</p>
                        <p>Jangan bagikan email dan password Anda kepada siapa pun. Periksa <strong>Aktivitas Login</strong> secara berkala.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 13. Developer --}}
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

    </div>{{-- /dokPenulis() --}}

    {{-- Sidebar Navigation --}}
    <aside class="hidden lg:block w-56 shrink-0">
        <nav class="sticky top-24 bg-white shadow-sm p-4 space-y-1">
            <p class="text-lg font-extrabold uppercase text-gray-400 tracking-wider mb-3 px-3">Navigasi</p>
            <template x-for="item in sections" :key="item.id">
                <a :href="'#' + item.id" @click.prevent="scrollTo(item.id)"
                   class="flex items-center gap-2.5 px-3 py-2.5 text-lg font-semibold transition-all"
                   :class="active === item.id ? 'text-primary bg-primary/10 border-l-3 border-primary' : 'text-gray-500 hover:text-dark hover:bg-gray-50 border-l-3 border-transparent'">
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
            { id: 'sec-header',         label: 'Pendahuluan',        icon: 'fas fa-info-circle' },
            { id: 'sec-daftar-isi',     label: 'Daftar Isi',         icon: 'fas fa-list-ol' },
            { id: 'sec-login',          label: 'Login',              icon: 'fas fa-sign-in-alt' },
            { id: 'sec-dashboard',      label: 'Dasbor',             icon: 'fas fa-tachometer-alt' },
            { id: 'sec-blog',           label: 'Blog',               icon: 'fas fa-newspaper' },
            { id: 'sec-kategori',       label: 'Kategori',           icon: 'fas fa-tags' },
            { id: 'sec-media',          label: 'Media',              icon: 'fas fa-photo-video' },
            { id: 'sec-galeri',         label: 'Foto Bercerita',     icon: 'fas fa-images' },
            { id: 'sec-statistik',      label: 'Statistik',          icon: 'fas fa-chart-bar' },
            { id: 'sec-aktivitas',      label: 'Aktivitas Login',    icon: 'fas fa-history' },
            { id: 'sec-profil',         label: 'Profil',             icon: 'fas fa-user-edit' },
            { id: 'sec-tips',           label: 'Tips',               icon: 'fas fa-lightbulb' },
            { id: 'sec-developer',      label: 'Developer',          icon: 'fas fa-code' },
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

function dokPenulis() {
    return {
        pdfLoading: false,

        async downloadPdf() {
            this.pdfLoading = true;
            try {
                const el = document.getElementById('dokumentasi-content');

                // Build PDF header
                const header = document.createElement('div');
                header.innerHTML = `
                    <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:3px solid #2d8057;padding-bottom:16px;margin-bottom:24px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <img src="{{ asset('img/logo-yali-papua.png') }}" style="height:48px;" />
                            <div>
                                <div style="font-size:18px;font-weight:800;color:#1A1A1A;">{{ $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua' }}</div>
                                <div style="font-size:12px;color:#707070;">Panduan Penggunaan — Penulis</div>
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
                        <span>Panduan Penulis — {{ $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua' }} — Nokensoft &copy; {{ date('Y') }}</span>
                        <span>www.nokensoft.com | info@nokensoft.com</span>
                    </div>
                `;

                const wrapper = document.createElement('div');
                wrapper.appendChild(header);
                const clone = el.cloneNode(true);
                wrapper.appendChild(clone);
                wrapper.appendChild(footer);

                const opt = {
                    margin:       [10, 12, 10, 12],
                    filename:     'Panduan-Penulis-{{ Str::slug($situs["nama_situs"] ?? "YALI-Papua") }}.pdf',
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
        }
    };
}
</script>
@endpush
