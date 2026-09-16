<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Hero;

class DashboardController extends Controller
{
    public function index()
    {
        // tambah stats untu: foto, video, hero yang berstatus  bolen true/false, dan berita/pengumuman/agenda/infografis
        $stats = [
            // Hitung berdasarkan enum category pada tabel informasis
            // 'berita'     => Informasi::where('category', 'Berita')->count(),
            // 'pengumuman' => Informasi::where('category', 'Pengumuman')->count(),
            // 'agenda'     => Informasi::where('category', 'Agenda')->count(),
            // 'infografis' => Informasi::where('category', 'Infografis')->count(),

            // Stats dengan filter status boolean
            'foto'       => Photo::where('status', true)->count(),
            'video'      => Video::where('status', true)->count(),
            'hero'       => Hero::where('status', true)->count(),
        ];

        $informasiTerbaru = Informasi::with('user')->latest()->take(5)->get();
        $fotoTerbaru = Photo::latest()->take(5)->get();
        $videoTerbaru = Video::latest()->take(5)->get();
        $heroTerbaru = Hero::latest()->take(5)->get();

        return view(
            'operator.dashboard.index', 
            compact(
                'stats', 
                'informasiTerbaru', 
                'fotoTerbaru', 
                'videoTerbaru', 
                'heroTerbaru'
                )
        );
    }
}
