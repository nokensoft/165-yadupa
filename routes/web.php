<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// VISITOR
use App\Http\Controllers\BerandaController;

use App\Http\Controllers\InformasiController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\VideoController;

use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\KontakController;

use App\Http\Controllers\FaqController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\PrivacyController;

// OPEARTOR
use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\Operator\BeritaController as OperatorBeritaController;
use App\Http\Controllers\Operator\PengumumanController as OperatorPengumumanController;
use App\Http\Controllers\Operator\AgendaController as OperatorAgendaController;
use App\Http\Controllers\Operator\InfografisController as OperatorInfografisController;
use App\Http\Controllers\Operator\PageController as OperatorPageController;
use App\Http\Controllers\Operator\TinyMceUploadController as OperatorTinyMceUploadController;
use App\Http\Controllers\Operator\HeroController as OperatorHeroController;
use App\Http\Controllers\Operator\PhotoController as OperatorPhotoController;
use App\Http\Controllers\Operator\VideoController as OperatorVideoController;
use App\Http\Controllers\Operator\PengaturanSitusController as OperatorPengaturanSitusController;

use App\Http\Controllers\Penulis\AktivitasLoginController as PenulisAktivitasLoginController;
use App\Http\Controllers\Penulis\DashboardController as PenulisDashboardController;
use App\Http\Controllers\Penulis\BlogController;
use App\Http\Controllers\Penulis\KategoriBlogController;
use App\Http\Controllers\Penulis\GaleriController;
use App\Http\Controllers\Penulis\MediaController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\StatistikPengunjungController;
use App\Http\Controllers\StorageFileController;

/*
|--------------------------------------------------------------------------
| Storage Fallback
|--------------------------------------------------------------------------
| Serve file dari storage/app/public via PHP.
| Aktif otomatis jika web server tidak bisa serve file statis
| (cPanel tanpa symlink, php artisan serve di Windows, dll).
*/
Route::get('/storage/{path}', [StorageFileController::class, 'show'])->where('path', '.*')->name('storage.serve');

/*
|--------------------------------------------------------------------------
| SEO Routes (robots.txt & sitemap.xml)
|--------------------------------------------------------------------------
*/
Route::get('/robots.txt', [SeoController::class, 'robots']);
Route::get('/sitemap.xml', [SeoController::class, 'sitemap']);





/*
|--------------------------------------------------------------------------
| Visitor (Public) Routes
|--------------------------------------------------------------------------
*/
Route::middleware('track.visitor')->group(function () {

    Route::get('/', [BerandaController::class, 'index'])->name('beranda');


    // Berita
    Route::prefix('informasi')->name('informasi.')->group(function () {
        Route::get('/', [InformasiController::class, 'index'])->name('index');
        Route::get('{slug}', [InformasiController::class, 'show'])->name('show');
    });


    // Galeri Foto
    Route::prefix('foto')->name('foto.')->group(function () {
        Route::get('/', [FotoController::class, 'index'])->name('index');
        Route::get('{slug}', [FotoController::class, 'show'])->name('show');
    });


    // Galeri Video
    Route::prefix('video')->name('video.')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('index');
        Route::get('{slug}', [VideoController::class, 'show'])->name('show');
    });

    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('informasi.pengumuman');

    Route::get('/agenda', [AgendaController::class, 'index'])->name('informasi.agenda');

    Route::get('/infografis', [InfografisController::class, 'index'])->name('informasi.infografis');

   // Profil
    Route::get('profil/{slug}', [ProfilController::class, 'show'])->name('profil.show');
    
    // Layanan
    Route::get('layanan', [LayananController::class, 'index'])->name('layanan');
    Route::get('layanan/sikora', [LayananController::class, 'sikora'])->name('layanan.sikora');
    
    // Kontak
    Route::get('kontak', [KontakController::class, 'index'])->name('kontak');
    
    // Other
    Route::get('faq', [FaqController::class, 'index'])->name('faq');
    Route::get('sitemap', [SiteMapController::class, 'index'])->name('sitemap');
    Route::get('privacy', [PrivacyController::class, 'index'])->name('privacy');

 

    // Blog / Berita (dynamic)
    Route::get('/blog', [VisitorController::class, 'blog'])->name('blog');
    Route::get('/blog/kategori/{slug}', [VisitorController::class, 'blogKategori'])->name('blog.kategori');
    Route::get('/blog/{slug}', [VisitorController::class, 'blogDetail'])->name('blog.detail');


    // Peta Situs (HTML Sitemap)
    Route::get('/peta-situs', [VisitorController::class, 'petaSitus'])->name('peta-situs');

    // PROFIL (halaman dinamis, dibaca dari tabel pages berdasarkan slug tetap)
    Route::get('/tentang', [ProfilController::class, 'tentang'])->name('profil.tentang');
    Route::get('/prinsip-bidang-kerja', [ProfilController::class, 'prinsipBidangKerja'])->name('profil.prinsip-bidang-kerja');
    Route::get('/program-utama', [ProfilController::class, 'programUtama'])->name('profil.program-utama');
    Route::get('/mitra-jaringan', [ProfilController::class, 'mitra'])->name('profil.mitra');



});





/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest.custom')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth.custom');

/*
|--------------------------------------------------------------------------
| Operator
|--------------------------------------------------------------------------
*/
Route::prefix('penulis')->name('penulis.')->middleware(['auth.custom', 'role:penulis'])->group(function () {
    Route::get('/dashboard', [PenulisDashboardController::class, 'index'])->name('dashboard');

    // Konten
    Route::resource('blog', BlogController::class)->except(['show']);
    Route::patch('/blog/{blog}/restore', [BlogController::class, 'restore'])->name('blog.restore');
    Route::delete('/blog/{blog}/force-delete', [BlogController::class, 'forceDelete'])->name('blog.force-delete');
    Route::resource('kategori-blog', KategoriBlogController::class)->except(['show']);
    Route::patch('/kategori-blog/{kategori_blog}/restore', [KategoriBlogController::class, 'restore'])->name('kategori-blog.restore');
    Route::delete('/kategori-blog/{kategori_blog}/force-delete', [KategoriBlogController::class, 'forceDelete'])->name('kategori-blog.force-delete');
    // Redirect URL lama berita/kategori-berita
    Route::redirect('/berita', '/penulis/blog', 301);
    Route::redirect('/berita/create', '/penulis/blog/create', 301);
    Route::redirect('/kategori-berita', '/penulis/kategori-blog', 301);
    Route::redirect('/kategori-berita/create', '/penulis/kategori-blog/create', 301);
    // Media
    Route::get('/media/json', [MediaController::class, 'json'])->name('media.json');
    Route::post('/media/upload-ajax', [MediaController::class, 'uploadAjax'])->name('media.upload-ajax');
    Route::resource('media', MediaController::class)->except(['show']);
    Route::patch('/media/{medium}/restore', [MediaController::class, 'restore'])->name('media.restore');
    Route::delete('/media/{medium}/force-delete', [MediaController::class, 'forceDelete'])->name('media.force-delete');
    Route::resource('foto-bercerita', GaleriController::class)
        ->parameters(['foto-bercerita' => 'galeri'])
        ->except(['show']);
    Route::patch('/foto-bercerita/{galeri}/toggle-publik', [GaleriController::class, 'togglePublik'])->name('foto-bercerita.toggle-publik');
    Route::patch('/foto-bercerita/{galeri}/restore', [GaleriController::class, 'restore'])->name('foto-bercerita.restore');
    Route::delete('/foto-bercerita/{galeri}/force-delete', [GaleriController::class, 'forceDelete'])->name('foto-bercerita.force-delete');


    // Statistik
    Route::get('/statistik-pengunjung', [StatistikPengunjungController::class, 'index'])->name('statistik-pengunjung');
    Route::get('/statistik-pengunjung/download', [StatistikPengunjungController::class, 'download'])->name('statistik-pengunjung.download');

    // Aktivitas Login (hanya penulis)
    Route::get('/aktivitas-login', [PenulisAktivitasLoginController::class, 'index'])->name('aktivitas-login');

    // Profil
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Dokumentasi / Panduan Penggunaan
    Route::view('/dokumentasi', 'penulis.dokumentasi')->name('dokumentasi');
});

/*
|--------------------------------------------------------------------------
| Operator
|--------------------------------------------------------------------------
*/
Route::prefix('operator')->name('operator.')->middleware(['auth.custom', 'role:operator'])->group(function () {
    Route::get('/dashboard', [OperatorDashboardController::class, 'index'])->name('dashboard.index');

    // Upload gambar untuk TinyMCE
    Route::post('/tinymce/upload', [OperatorTinyMceUploadController::class, 'upload'])->name('tinymce.upload');

    // Informasi (berdasarkan kategori: Berita, Pengumuman, Agenda, Infografis)
    Route::resource('berita', OperatorBeritaController::class)->except(['show']);
    Route::patch('/berita/{berita}/restore', [OperatorBeritaController::class, 'restore'])->name('berita.restore');
    Route::delete('/berita/{berita}/force-delete', [OperatorBeritaController::class, 'forceDelete'])->name('berita.force-delete');

    Route::resource('pengumuman', OperatorPengumumanController::class)->except(['show']);
    Route::patch('/pengumuman/{pengumuman}/restore', [OperatorPengumumanController::class, 'restore'])->name('pengumuman.restore');
    Route::delete('/pengumuman/{pengumuman}/force-delete', [OperatorPengumumanController::class, 'forceDelete'])->name('pengumuman.force-delete');

    Route::resource('agenda', OperatorAgendaController::class)->except(['show']);
    Route::patch('/agenda/{agendum}/restore', [OperatorAgendaController::class, 'restore'])->name('agenda.restore');
    Route::delete('/agenda/{agendum}/force-delete', [OperatorAgendaController::class, 'forceDelete'])->name('agenda.force-delete');

    Route::resource('infografis', OperatorInfografisController::class)->except(['show']);
    Route::patch('/infografis/{infografi}/restore', [OperatorInfografisController::class, 'restore'])->name('infografis.restore');
    Route::delete('/infografis/{infografi}/force-delete', [OperatorInfografisController::class, 'forceDelete'])->name('infografis.force-delete');

    // Halaman
    Route::resource('pages', OperatorPageController::class)->except(['show']);
    Route::patch('/pages/{page}/restore', [OperatorPageController::class, 'restore'])->name('pages.restore');
    Route::delete('/pages/{page}/force-delete', [OperatorPageController::class, 'forceDelete'])->name('pages.force-delete');

    // Hero Beranda
    Route::resource('hero', OperatorHeroController::class)->except(['show']);
    Route::patch('/hero/{hero}/restore', [OperatorHeroController::class, 'restore'])->name('hero.restore');
    Route::delete('/hero/{hero}/force-delete', [OperatorHeroController::class, 'forceDelete'])->name('hero.force-delete');

    // Galeri Foto & Video
    Route::resource('foto', OperatorPhotoController::class)->except(['show']);
    Route::patch('/foto/{foto}/restore', [OperatorPhotoController::class, 'restore'])->name('foto.restore');
    Route::delete('/foto/{foto}/force-delete', [OperatorPhotoController::class, 'forceDelete'])->name('foto.force-delete');

    Route::resource('video', OperatorVideoController::class)->except(['show']);
    Route::patch('/video/{video}/restore', [OperatorVideoController::class, 'restore'])->name('video.restore');
    Route::delete('/video/{video}/force-delete', [OperatorVideoController::class, 'forceDelete'])->name('video.force-delete');

    // Pengaturan Situs
    Route::get('/pengaturan-situs', [OperatorPengaturanSitusController::class, 'edit'])->name('pengaturan-situs.edit');
    Route::put('/pengaturan-situs', [OperatorPengaturanSitusController::class, 'update'])->name('pengaturan-situs.update');
});
