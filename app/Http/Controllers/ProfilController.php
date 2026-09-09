<?php

namespace App\Http\Controllers;

use App\Models\Page;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil generik berdasarkan slug (mis. halaman baru
     * yang dibuat operator lewat menu Halaman, tanpa perlu route khusus).
     */
    public function show(string $slug)
    {
        return $this->render($slug);
    }

    /**
     * Nav "Siapa Kami" > Sejarah & Tujuan Pendirian.
     */
    public function tentang()
    {
        return $this->render('sejarah-tujuan-pendirian');
    }

    /**
     * Nav "Siapa Kami" > Prinsip & Bidang Kerja.
     */
    public function prinsipBidangKerja()
    {
        return $this->render('prinsip-bidang-kerja');
    }

    /**
     * Nav "Yang Kami Lakukan" > Program Kerja & Implementasi Lapangan.
     */
    public function programUtama()
    {
        return $this->render('program-kerja-implementasi-lapangan');
    }

    /**
     * Nav "Mitra & Jaringan".
     */
    public function mitra()
    {
        return $this->render('mitra-jaringan');
    }

    /**
     * Helper bersama: ambil Page aktif berdasarkan slug lalu render lewat
     * template dinamis profil.show. Digunakan oleh seluruh halaman statis
     * yang telah dikonversi menjadi halaman berbasis konten (pages table).
     */
    private function render(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('profil.show', compact('page'));
    }
}
