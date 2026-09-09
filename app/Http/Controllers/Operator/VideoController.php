<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Support\ImageCoverProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VideoController extends Controller
{
    // Samakan dengan ukuran gambar pada data Foto.
    private const WIDTH = 1720;
    private const HEIGHT = 1080;

    public const CATEGORIES = ['Prestasi', 'Sarana & Prasarana', 'Ujian', 'Pertemuan', 'HUT RI', 'Kegiatan Dinas', 'KOMINFO'];

    public function index(Request $request)
    {
        $query = Video::query();

        if ($request->filled('cari')) {
            $query->where('title', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $videos = $query->latest()->paginate(10)->withQueryString();

        return view('operator.video.index', compact('videos'));
    }

    public function create()
    {
        return view('operator.video.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        Video::create([
            'user_id' => session('user.id'),
            'title' => $data['title'],
            'slug' => $data['slug'],
            'cover' => $request->hasFile('gambar_file')
                ? ImageCoverProcessor::toWebp($request->file('gambar_file'), self::WIDTH, self::HEIGHT, 'video', 'gambar_file')
                : null,
            'youtube_url' => $data['youtube_url'],
            'category' => $data['category'],
            'keterangan' => $data['keterangan'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('operator.video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $video = Video::findOrFail($id);

        return view('operator.video.form', compact('video') + ['editMode' => true]);
    }

    public function update(Request $request, string $id)
    {
        $video = Video::findOrFail($id);
        $data = $this->validated($request, $video);

        $cover = $video->cover;
        if ($request->hasFile('gambar_file')) {
            $cover = ImageCoverProcessor::toWebp($request->file('gambar_file'), self::WIDTH, self::HEIGHT, 'video', 'gambar_file');
            $this->deleteUploadedImage($video->cover);
        }

        $video->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'cover' => $cover,
            'youtube_url' => $data['youtube_url'],
            'category' => $data['category'],
            'keterangan' => $data['keterangan'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('operator.video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('operator.video.index')->with('success', 'Video berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $video = Video::onlyTrashed()->findOrFail($id);
        $video->restore();

        return redirect()->route('operator.video.index')->with('success', 'Video berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $video = Video::onlyTrashed()->findOrFail($id);
        $this->deleteUploadedImage($video->cover);
        $video->forceDelete();

        return redirect()->route('operator.video.index', ['status' => 'terhapus'])->with('success', 'Video berhasil dihapus permanen.');
    }

    protected function validated(Request $request, ?Video $ignoring = null): array
    {
        $request->merge([
            'slug' => Str::slug($request->filled('slug') ? $request->input('slug') : $request->input('title')),
        ]);

        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required', 'string', 'max:255',
                Rule::unique('videos', 'slug')->ignore($ignoring?->id),
            ],
            'category' => ['required', Rule::in(self::CATEGORIES)],
            'youtube_url' => 'required|url|max:500',
            'keterangan' => 'nullable|string',
            'gambar_file' => 'nullable|image|max:5120',
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
