<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Menampilkan daftar galeri foto dengan filter kategori dan pencarian.
     */
    public function index(Request $request)
    {
        $query = Photo::published()->latest();

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

        $photos = $query->paginate(12)->withQueryString();

        // Daftar opsi kategori untuk filter di view
        $categories = \App\Http\Controllers\Operator\PhotoController::CATEGORIES;

        return view('foto.index', compact('photos', 'categories'));
    }

    /**
     * Menampilkan detail item foto beserta foto terkait.
     */
    public function show($slug)
    {
        $photo = Photo::published()->where('slug', $slug)->firstOrFail();

        // Mengambil foto terkait berdasarkan kategori yang sama
        $fotoTerkait = Photo::published()
            ->where('category', $photo->category)
            ->where('id', '!=', $photo->id)
            ->latest()
            ->take(4)
            ->get();

        return view('foto.show', compact('photo', 'fotoTerkait'));
    }
}