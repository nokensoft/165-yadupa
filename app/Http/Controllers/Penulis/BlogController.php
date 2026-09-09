<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\KategoriBlog;
use App\Models\Media;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['kategori', 'media']);

        if ($request->filled('cari')) {
            $query->where('judul', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $blog = $query->latest()->paginate(10)->withQueryString();

        return view('penulis.berita.index', compact('blog'));
    }

    public function create()
    {
        $kategori = KategoriBlog::orderBy('nama')->get();
        $media = Media::where('tipe', 'foto')->orderBy('judul')->get();

        return view('penulis.berita.form', compact('kategori', 'media') + ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_blog_id' => 'required|exists:kategori_berita,id',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string',
            'media_id' => 'nullable|exists:media,id',
            'status' => 'nullable|in:draft,terbit',
            'tanggal_terbit' => 'nullable|date',
            'sumber_nama' => 'nullable|string|max:255',
            'sumber_link' => 'nullable|url|max:500',
        ]);

        Blog::create([
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'konten' => $request->konten,
            'kategori_blog_id' => $request->kategori_blog_id,
            'media_id' => $request->media_id,
            'user_id' => session('user.id'),
            'status' => $request->status ?? 'draft',
            'tanggal_terbit' => $request->tanggal_terbit,
            'sumber_nama' => $request->sumber_nama,
            'sumber_link' => $request->sumber_link,
        ]);

        return redirect()->route('penulis.blog.index')->with('success', 'Blog berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $kategori = KategoriBlog::orderBy('nama')->get();
        $media = Media::where('tipe', 'foto')->orderBy('judul')->get();

        return view('penulis.berita.form', compact('blog', 'kategori', 'media') + ['editMode' => true]);
    }

    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_blog_id' => 'required|exists:kategori_berita,id',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string',
            'media_id' => 'nullable|exists:media,id',
            'status' => 'nullable|in:draft,terbit',
            'tanggal_terbit' => 'nullable|date',
            'sumber_nama' => 'nullable|string|max:255',
            'sumber_link' => 'nullable|url|max:500',
        ]);

        $blog->update([
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'konten' => $request->konten,
            'kategori_blog_id' => $request->kategori_blog_id,
            'media_id' => $request->media_id,
            'status' => $request->status ?? $blog->status,
            'tanggal_terbit' => $request->tanggal_terbit,
            'sumber_nama' => $request->sumber_nama,
            'sumber_link' => $request->sumber_link,
        ]);

        return redirect()->route('penulis.blog.index')->with('success', 'Blog berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('penulis.blog.index')->with('success', 'Blog berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        return redirect()->route('penulis.blog.index')->with('success', 'Blog berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->forceDelete();

        return redirect()->route('penulis.blog.index', ['status' => 'terhapus'])->with('success', 'Blog berhasil dihapus permanen.');
    }
}
