<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Menampilkan daftar galeri video dengan filter kategori dan pencarian.
     */
    public function index(Request $request)
    {
        $query = Video::published()->latest();

        // Filter berdasarkan pencarian judul/keterangan
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $videos = $query->paginate(12)->withQueryString();

        // Daftar opsi kategori sesuai migrasi tabel videos
        $categories = ['Prestasi', 'Sarana & Prasarana', 'Ujian', 'Pertemuan', 'HUT RI', 'Kegiatan Dinas', 'KOMINFO'];

        return view('video.index', compact('videos', 'categories'));
    }

    /**
     * Menampilkan detail item video beserta video terkait.
     */
    public function show($slug)
    {
        $video = Video::published()->where('slug', $slug)->firstOrFail();

        // Mengambil video terkait berdasarkan kategori yang sama
        $videoTerkait = Video::published()
            ->where('category', $video->category)
            ->where('id', '!=', $video->id)
            ->latest()
            ->take(4)
            ->get();

        return view('video.show', compact('video', 'videoTerkait'));
    }
}