<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinyMceUploadController extends Controller
{
    /**
     * Menangani upload gambar dari toolbar Image milik TinyMCE.
     * TinyMCE mengirim file lewat field "file" dan mengharapkan
     * respons JSON berbentuk { "location": "<url gambar>" }.
     */
    public function upload(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['error' => 'File tidak valid.'], 400);
        }

        $file = $request->file('file');

        if (!str_starts_with((string) $file->getMimeType(), 'image/')) {
            return response()->json(['error' => 'File harus berupa gambar.'], 400);
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            return response()->json(['error' => 'Ukuran gambar maksimal 5MB.'], 400);
        }

        $path = $file->store('tinymce', 'public');

        return response()->json([
            'location' => asset('storage/' . $path),
        ]);
    }
}
