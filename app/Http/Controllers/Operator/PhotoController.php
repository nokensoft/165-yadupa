<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Support\ImageCoverProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PhotoController extends Controller
{
    // Ukuran seragam untuk foto galeri.
    private const WIDTH = 1720;
    private const HEIGHT = 1080;

    public const CATEGORIES = ['Pelatihan', 'Lokakarya & Pemetaan', 'Rapat & Pertemuan', 'Lomba & Kompetisi', 'Perencanaan Strategis'];

    public function index(Request $request)
    {
        $query = Photo::query();

        if ($request->filled('cari')) {
            $query->where('title', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $photos = $query->latest()->paginate(10)->withQueryString();

        return view('operator.foto.index', compact('photos'));
    }

    public function create()
    {
        return view('operator.foto.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        Photo::create([
            'user_id' => session('user.id'),
            'title' => $data['title'],
            'slug' => $data['slug'],
            'image' => ImageCoverProcessor::toWebp($request->file('gambar_file'), self::WIDTH, self::HEIGHT, 'foto', 'gambar_file'),
            'category' => $data['category'],
            'keterangan' => $data['keterangan'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('operator.foto.index')->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $photo = Photo::findOrFail($id);

        return view('operator.foto.form', compact('photo') + ['editMode' => true]);
    }

    public function update(Request $request, string $id)
    {
        $photo = Photo::findOrFail($id);
        $data = $this->validated($request, $photo);

        $image = $photo->image;
        if ($request->hasFile('gambar_file')) {
            $image = ImageCoverProcessor::toWebp($request->file('gambar_file'), self::WIDTH, self::HEIGHT, 'foto', 'gambar_file');
            $this->deleteUploadedImage($photo->image);
        }

        $photo->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'image' => $image,
            'category' => $data['category'],
            'keterangan' => $data['keterangan'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('operator.foto.index')->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return redirect()->route('operator.foto.index')->with('success', 'Foto berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $photo = Photo::onlyTrashed()->findOrFail($id);
        $photo->restore();

        return redirect()->route('operator.foto.index')->with('success', 'Foto berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $photo = Photo::onlyTrashed()->findOrFail($id);
        $this->deleteUploadedImage($photo->image);
        $photo->forceDelete();

        return redirect()->route('operator.foto.index', ['status' => 'terhapus'])->with('success', 'Foto berhasil dihapus permanen.');
    }

    protected function validated(Request $request, ?Photo $ignoring = null): array
    {
        $request->merge([
            'slug' => Str::slug($request->filled('slug') ? $request->input('slug') : $request->input('title')),
        ]);

        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required', 'string', 'max:255',
                Rule::unique('photos', 'slug')->ignore($ignoring?->id),
            ],
            'category' => ['required', Rule::in(self::CATEGORIES)],
            'keterangan' => 'nullable|string',
            'gambar_file' => [$ignoring ? 'nullable' : 'required', 'image', 'max:5120'],
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
