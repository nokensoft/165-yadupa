<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\KategoriBlog;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    

/**
     * Halaman Beranda
     */
    public function beranda(Request $request)
    {
        $query = Blog::with('kategoriBlog')
            ->where('status', 'terbit');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategoriBlog', function ($q) use ($request) {
                $q->where('slug', $request->kategori)
                  ->orWhere('id', $request->kategori);
            });
        }

        $berita = $query->orderByDesc('tanggal_terbit')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        $kategoriList = KategoriBlog::all();

        return view('visitor.beranda', compact('berita', 'kategoriList'));
    }

    /**
     * Halaman Daftar Berita
     */
    public function beritaIndex(Request $request)
    {
        $query = Blog::with('kategoriBlog')
            ->where('status', 'terbit');

        if ($request->has('q') && $request->q != '') {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->q . '%')
                  ->orWhere('konten', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategoriBlog', function ($q) use ($request) {
                $q->where('slug', $request->kategori)
                  ->orWhere('id', $request->kategori);
            });
        }

        $beritaList = $query->orderByDesc('tanggal_terbit')
            ->orderByDesc('id')
            ->paginate(6);

        $beritaTerkait = Blog::where('status', 'terbit')
            ->orderByDesc('tanggal_terbit')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('visitor.blog.berita.index', compact('beritaList', 'beritaTerkait'));
    }

    /**
     * Halaman Detail Berita berdasarkan Slug
     */
    public function beritaShow($slug)
    {
        $berita = Blog::with(['kategoriBlog', 'user'])
            ->where('slug', $slug)
            ->where('status', 'terbit')
            ->firstOrFail();

        // Increment jumlah pembaca
        $berita->increment('jumlah_dibaca');

        // Rekomendasi berita terkait berdasarkan kategori_blog_id yang sama
        $beritaTerkait = Blog::where('kategori_blog_id', $berita->kategori_blog_id)
            ->where('status', 'terbit')
            ->where('id', '!=', $berita->id)
            ->orderByDesc('tanggal_terbit')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        return view('visitor.blog.berita.show', compact('berita', 'beritaTerkait'));
    }


}