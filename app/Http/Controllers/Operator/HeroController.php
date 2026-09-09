<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Support\ImageCoverProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    // Rasio 16:9 agar pas sebagai background hero full-screen di beranda visitor.
    private const HERO_WIDTH = 1920;
    private const HERO_HEIGHT = 1080;

    public function index(Request $request)
    {
        $query = Hero::query();

        if ($request->filled('cari')) {
            $query->where('title', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $heroes = $query->orderBy('priority')->latest('published_at')->paginate(10)->withQueryString();

        return view('operator.hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('operator.hero.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'gambar_file' => 'required|image|max:5120',
            'priority' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        Hero::create([
            'title' => $data['title'],
            'image' => ImageCoverProcessor::toWebp($request->file('gambar_file'), self::HERO_WIDTH, self::HERO_HEIGHT, 'hero', 'gambar_file'),
            'priority' => $data['priority'] ?? 0,
            'status' => $request->boolean('status'),
            'published_at' => $data['published_at'] ?? now(),
        ]);

        return redirect()->route('operator.hero.index')->with('success', 'Hero berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $hero = Hero::findOrFail($id);

        return view('operator.hero.form', compact('hero') + ['editMode' => true]);
    }

    public function update(Request $request, string $id)
    {
        $hero = Hero::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'gambar_file' => 'nullable|image|max:5120',
            'priority' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $image = $hero->image;
        if ($request->hasFile('gambar_file')) {
            $image = ImageCoverProcessor::toWebp($request->file('gambar_file'), self::HERO_WIDTH, self::HERO_HEIGHT, 'hero', 'gambar_file');
            $this->deleteUploadedImage($hero->image);
        }

        $hero->update([
            'title' => $data['title'],
            'image' => $image,
            'priority' => $data['priority'] ?? 0,
            'status' => $request->boolean('status'),
            'published_at' => $data['published_at'] ?? $hero->published_at,
        ]);

        return redirect()->route('operator.hero.index')->with('success', 'Hero berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return redirect()->route('operator.hero.index')->with('success', 'Hero berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $hero = Hero::onlyTrashed()->findOrFail($id);
        $hero->restore();

        return redirect()->route('operator.hero.index')->with('success', 'Hero berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $hero = Hero::onlyTrashed()->findOrFail($id);
        $this->deleteUploadedImage($hero->image);
        $hero->forceDelete();

        return redirect()->route('operator.hero.index', ['status' => 'terhapus'])->with('success', 'Hero berhasil dihapus permanen.');
    }

    /**
     * Hanya hapus file hasil upload operator (di storage/), jangan sentuh aset seeder di public/img/.
     */
    private function deleteUploadedImage(?string $image): void
    {
        if (!$image || str_starts_with($image, 'img/') || str_starts_with($image, 'http')) {
            return;
        }

        Storage::disk('public')->delete($image);
    }
}
