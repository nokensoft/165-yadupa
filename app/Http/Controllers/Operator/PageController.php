<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\ImageCoverProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    // Rasio banner cover halaman (selaras dengan tampilan profil.show).
    private const WIDTH = 1600;
    private const HEIGHT = 900;

    public function index(Request $request)
    {
        $query = Page::query();

        if ($request->filled('cari')) {
            $query->where('title', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $pages = $query->orderBy('title')->paginate(10)->withQueryString();

        return view('operator.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('operator.pages.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        Page::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'cover' => $request->hasFile('gambar_file')
                ? ImageCoverProcessor::toWebp($request->file('gambar_file'), self::WIDTH, self::HEIGHT, 'pages', 'gambar_file')
                : null,
            'content' => $data['content'],
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('operator.pages.index')->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $page = Page::findOrFail($id);

        return view('operator.pages.form', compact('page') + ['editMode' => true]);
    }

    public function update(Request $request, string $id)
    {
        $page = Page::findOrFail($id);
        $data = $this->validated($request, $page);

        $cover = $page->cover;
        if ($request->hasFile('gambar_file')) {
            $cover = ImageCoverProcessor::toWebp($request->file('gambar_file'), self::WIDTH, self::HEIGHT, 'pages', 'gambar_file');
            $this->deleteUploadedImage($page->cover);
        }

        $page->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'cover' => $cover,
            'content' => $data['content'],
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('operator.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('operator.pages.index')->with('success', 'Halaman berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        $page->restore();

        return redirect()->route('operator.pages.index')->with('success', 'Halaman berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        $this->deleteUploadedImage($page->cover);
        $page->forceDelete();

        return redirect()->route('operator.pages.index', ['status' => 'terhapus'])->with('success', 'Halaman berhasil dihapus permanen.');
    }

    /**
     * Hanya hapus file hasil upload operator (di storage/), jangan sentuh aset seeder di public/img/.
     */
    private function deleteUploadedImage(?string $cover): void
    {
        if (!$cover || str_starts_with($cover, 'img/') || str_starts_with($cover, 'http')) {
            return;
        }

        Storage::disk('public')->delete($cover);
    }

    protected function validated(Request $request, ?Page $ignoring = null): array
    {
        // Normalisasi slug (dari input manual atau fallback ke judul) SEBELUM dicek keunikannya.
        $request->merge([
            'slug' => Str::slug($request->filled('slug') ? $request->input('slug') : $request->input('title')),
        ]);

        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required', 'string', 'max:255',
                Rule::unique('pages', 'slug')->ignore($ignoring?->id),
            ],
            'content' => 'required|string',
            'gambar_file' => 'nullable|image|max:5120',
        ], [
            'slug.unique' => 'Slug sudah digunakan, silakan gunakan slug lain.',
        ]);
    }
}
