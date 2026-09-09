<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\KategoriBlog;
use Illuminate\Http\Request;

class KategoriBlogController extends Controller
{
    public function index(Request $request)
    {
        $query = KategoriBlog::withCount('blog');

        if ($request->filled('cari')) {
            $query->where('nama', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $kategori = $query->latest()->paginate(10)->withQueryString();

        return view('penulis.kategori-berita.index', compact('kategori'));
    }

    public function create()
    {
        return view('penulis.kategori-berita.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_berita,nama',
        ]);

        KategoriBlog::create(['nama' => $request->nama]);

        return redirect()->route('penulis.kategori-blog.index')->with('success', 'Kategori blog berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $kategoriBlog = KategoriBlog::findOrFail($id);
        return view('penulis.kategori-berita.form', ['editMode' => true, 'kategoriBlog' => $kategoriBlog]);
    }

    public function update(Request $request, string $id)
    {
        $kategoriBlog = KategoriBlog::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_berita,nama,' . $id,
        ]);

        $kategoriBlog->update(['nama' => $request->nama]);

        return redirect()->route('penulis.kategori-blog.index')->with('success', 'Kategori blog berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kategoriBlog = KategoriBlog::findOrFail($id);
        $kategoriBlog->delete();

        return redirect()->route('penulis.kategori-blog.index')->with('success', 'Kategori blog berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $kategoriBlog = KategoriBlog::onlyTrashed()->findOrFail($id);
        $kategoriBlog->restore();

        return redirect()->route('penulis.kategori-blog.index')->with('success', 'Kategori blog berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $kategoriBlog = KategoriBlog::onlyTrashed()->findOrFail($id);
        $kategoriBlog->forceDelete();

        return redirect()->route('penulis.kategori-blog.index', ['status' => 'terhapus'])->with('success', 'Kategori blog berhasil dihapus permanen.');
    }
}
