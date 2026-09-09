# Website YALI Papua
Website resmi YALI Papua berbasis Laravel untuk pengelolaan konten publik dan administrasi internal.

## Fitur Utama Sisi Admin
- Login dan manajemen autentikasi admin.
- Dashboard admin untuk ringkasan operasional.
- Pengaturan situs (identitas, konfigurasi umum website).
- Manajemen pengguna (CRUD, restore, force delete).
- Manajemen halaman CMS (CRUD, restore, force delete).
- Monitoring aktivitas login admin.
- Backup dan restore database dari panel admin.
- Backup dan restore storage/file media.
- Statistik pengunjung.
- Manajemen profil akun admin.

## Fitur Utama Sisi Visitor
- Beranda website.
- Halaman profil organisasi.
- Halaman CMS dinamis (contoh: sejarah, pilar kerja, FAQ, disclaimer).
- Halaman mitra, kepengurusan, program, dan donasi.
- Blog/artikel (list, detail, dan filter kategori).
- Foto Bercerita/Galeri (list dan detail).
- Halaman kontak.
- SEO endpoint (`robots.txt`, `sitemap.xml`) dan peta situs HTML.

## Teknologi yang Digunakan
- PHP 8.2
- Laravel 12
- MySQL (dikustom melalui script `setup`)
- Vite 7
- Tailwind CSS 4
- Alpine.js
- Axios
- Font Awesome
- Composer dan NPM untuk manajemen dependency

## Cara Deploy
Contoh alur deploy umum di server Linux (VPS/shared hosting yang mendukung Laravel):

1. Clone repository:
   ```bash
   git clone <url-repository> yali-papua
   cd yali-papua
   ```
2. Install dependency backend:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
3. Install dependency frontend dan build asset:
   ```bash
   npm install
   npm run build
   ```
4. Siapkan environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Atur konfigurasi database pada `.env`, lalu jalankan migrasi:
   ```bash
   php artisan migrate --force
   ```
6. Buat storage link (opsional, tetapi direkomendasikan):
   ```bash
   php artisan storage:link
   ```
7. Optimasi cache produksi:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
8. Arahkan web server ke folder `public/`.

## Cara Kembangkan Lanjut di Komputer Lain
1. Clone repository ke komputer baru:
   ```bash
   git clone <url-repository> yali-papua
   cd yali-papua
   ```
2. Pastikan sudah terpasang:
   - PHP 8.2+
   - Composer
   - Node.js + NPM
   - MySQL/MariaDB
3. Jalankan script setup (disarankan):
   ```bash
   ./setup .env --db nama_database --user root --password password_db
   ```
   Script ini akan:
   - membuat `.env` dari `.env.example` (jika belum ada),
   - mengisi konfigurasi database MySQL,
   - menjalankan `composer setup`.
4. Jika tidak memakai script setup, jalankan manual:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   npm install
   npm run dev
   ```
5. Untuk mode pengembangan harian:
   ```bash
   composer dev
   ```
   Perintah ini menjalankan server Laravel, queue listener, log tail, dan Vite secara paralel.

## Author
Nokensoft.com (082199558191)
