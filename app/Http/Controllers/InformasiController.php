<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Menampilkan daftar informasi dengan pencarian, filter kategori, dan sidebar agregasi.
     */
    public function index(Request $request)
    {
        $search = $request->input('q');
        $category = $request->input('category');

        $informasi = Informasi::published()
            ->with('user')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        // Agregasi daftar kategori enum & total data terpublikasi
        $categories = Informasi::published()
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        $totalAll = Informasi::published()->count();

        return view('informasi.index', compact('informasi', 'search', 'category', 'categories', 'totalAll'));
    }

    /**
     * Menampilkan detail informasi berdasarkan slug.
     */
    public function show(string $slug)
    {
        $informasi = Informasi::published()
            ->with('user')
            ->where('slug', $slug)
            ->firstOrFail();

        $informasiTerkait = Informasi::published()
            ->where('id', '!=', $informasi->id)
            ->when($informasi->category, function ($q) use ($informasi) {
                return $q->where('category', $informasi->category);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('informasi.show', compact('informasi', 'informasiTerkait'));
    }
}