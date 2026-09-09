<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Galeri;
use App\Models\Media;
use App\Models\KategoriBlog;

class DashboardController extends Controller
{
    public function index()
    {

        $stats = [
            ['icon' => 'fa-newspaper',   'value' => Blog::count(),         'label' => 'Blog',                'color' => 'bg-primary'],
            ['icon' => 'fa-images',      'value' => Galeri::count(),       'label' => 'Total Foto Bercerita','color' => 'bg-purple-600'],
            ['icon' => 'fa-photo-video', 'value' => Media::count(),        'label' => 'Total Media',         'color' => 'bg-orange-500'],
            ['icon' => 'fa-tags',        'value' => KategoriBlog::count(), 'label' => 'Kategori Blog',       'color' => 'bg-pink-600'],
        ];

        $blogTerbaru = Blog::with('kategori')
            ->latest()
            ->take(5)
            ->get();

        $fotoBerceritaTerbaru = Galeri::withCount('media')
            ->latest()
            ->take(5)
            ->get();

        return view('penulis.dashboard', compact('stats', 'blogTerbaru', 'fotoBerceritaTerbaru'));
    }
}
