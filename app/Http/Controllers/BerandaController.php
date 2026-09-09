<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Informasi;
use App\Models\Photo;
use App\Models\Video;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil banner hero yang aktif & sudah waktunya tampil (mendukung
        // penjadwalan lewat field "Tanggal Publikasi" di form admin).
        $heroes = Hero::where('status', true)
            ->where(function ($query) {
                $query->whereNull('published_at')->orWhere('published_at', '<=', now());
            })
            ->orderBy('priority')
            ->latest('published_at')
            ->get();

        // Mengambil semua jenis informasi (Berita, Pengumuman, Agenda, Infografis) terbaru
        $informasis = Informasi::published()
            ->with('user')
            ->latest('published_at')
            ->take(6) // Ambil 6 item untuk satu section
            ->get();

        // Mengambil 1 foto terbaru
        $photoTerbaru = Photo::published()
            ->latest()
            ->first();

        // Mengambil 1 video terbaru
        $videoTerbaru = Video::published()
            ->latest()
            ->first();

        return view('beranda.index', compact('heroes', 'informasis', 'photoTerbaru', 'videoTerbaru'));
    }
}