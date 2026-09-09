<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Support\ImageCoverProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

abstract class InformasiCategoryController extends Controller
{
    // Rasio 16:9 (aspect-video), sama seperti tampilan galeri di visitor.
    private const WIDTH = 1200;
    private const HEIGHT = 675;

    protected string $category;
    protected string $viewPrefix;
    protected string $routeName;
    protected string $label;

    protected function baseQuery()
    {
        return Informasi::where('category', $this->category);
    }

    public function index(Request $request)
    {
        $query = $this->baseQuery();

        if ($request->filled('cari')) {
            $query->where('title', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $informasi = $query->latest()->paginate(10)->withQueryString();

        return view("{$this->viewPrefix}.index", compact('informasi'));
    }

    public function create()
    {
        return view("{$this->viewPrefix}.form", ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        Informasi::create([
            'user_id' => session('user.id'),
            'title' => $data['title'],
            'slug' => $data['slug'],
            'category' => $this->category,
            'content' => $data['content'],
            'image' => $request->hasFile('gambar_file')
                ? ImageCoverProcessor::toWebp($request->file('gambar_file'), self::WIDTH, self::HEIGHT, 'informasi', 'gambar_file')
                : null,
            'status' => $request->boolean('status'),
            'published_at' => $data['published_at'] ?? now(),
        ]);

        return redirect()->route("{$this->routeName}.index")->with('success', "{$this->label} berhasil ditambahkan.");
    }

    public function edit(string $id)
    {
        $informasi = $this->baseQuery()->findOrFail($id);

        return view("{$this->viewPrefix}.form", compact('informasi') + ['editMode' => true]);
    }

    public function update(Request $request, string $id)
    {
        $informasi = $this->baseQuery()->findOrFail($id);
        $data = $this->validated($request, $informasi);

        $image = $informasi->image;
        if ($request->hasFile('gambar_file')) {
            $image = ImageCoverProcessor::toWebp($request->file('gambar_file'), self::WIDTH, self::HEIGHT, 'informasi', 'gambar_file');
            $this->deleteUploadedImage($informasi->image);
        }

        $informasi->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'image' => $image,
            'status' => $request->boolean('status'),
            'published_at' => $data['published_at'] ?? $informasi->published_at,
        ]);

        return redirect()->route("{$this->routeName}.index")->with('success', "{$this->label} berhasil diperbarui.");
    }

    public function destroy(string $id)
    {
        $informasi = $this->baseQuery()->findOrFail($id);
        $informasi->delete();

        return redirect()->route("{$this->routeName}.index")->with('success', "{$this->label} berhasil dihapus.");
    }

    public function restore(string $id)
    {
        $informasi = $this->baseQuery()->onlyTrashed()->findOrFail($id);
        $informasi->restore();

        return redirect()->route("{$this->routeName}.index")->with('success', "{$this->label} berhasil dipulihkan.");
    }

    public function forceDelete(string $id)
    {
        $informasi = $this->baseQuery()->onlyTrashed()->findOrFail($id);
        $this->deleteUploadedImage($informasi->image);
        $informasi->forceDelete();

        return redirect()->route("{$this->routeName}.index", ['status' => 'terhapus'])->with('success', "{$this->label} berhasil dihapus permanen.");
    }

    protected function validated(Request $request, ?Informasi $ignoring = null): array
    {
        $request->merge([
            'slug' => Str::slug($request->filled('slug') ? $request->input('slug') : $request->input('title')),
        ]);

        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required', 'string', 'max:255',
                Rule::unique('informasis', 'slug')->ignore($ignoring?->id),
            ],
            'content' => 'required|string',
            'gambar_file' => 'nullable|image|max:5120',
            'published_at' => 'nullable|date',
        ], [
            'slug.unique' => 'Slug sudah digunakan, silakan gunakan slug lain.',
        ]);
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
