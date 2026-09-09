<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSitus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PengaturanSitusController extends Controller
{
    /**
     * Daftar key pengaturan berbasis teks (bukan file) yang boleh diedit lewat form ini.
     */
    private const TEXT_KEYS = [
        'nama_situs', 'nama_situs_en', 'deskripsi_situs',
        'email', 'email_direktur', 'email_ketua', 'telepon', 'fax',
        'whatsapp_direktur', 'whatsapp_ketua', 'alamat', 'website',
        'koordinat_maps', 'google_maps_link', 'google_maps_embed',
        'sosmed_facebook', 'sosmed_instagram', 'sosmed_youtube', 'sosmed_twitter', 'sosmed_tiktok', 'sosmed_whatsapp',
        'seo_meta_keywords', 'seo_meta_description',
    ];

    public function edit()
    {
        $situs = PengaturanSitus::pluck('value', 'key');

        return view('operator.pengaturan-situs.edit', compact('situs'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_situs' => 'required|string|max:255',
            'nama_situs_en' => 'nullable|string|max:255',
            'deskripsi_situs' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'email_direktur' => 'nullable|email|max:255',
            'email_ketua' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'fax' => 'nullable|string|max:50',
            'whatsapp_direktur' => 'nullable|string|max:50',
            'whatsapp_ketua' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'koordinat_maps' => 'nullable|string|max:255',
            'google_maps_link' => 'nullable|url|max:1000',
            'google_maps_embed' => 'nullable|string',
            'sosmed_facebook' => 'nullable|url|max:500',
            'sosmed_instagram' => 'nullable|url|max:500',
            'sosmed_youtube' => 'nullable|url|max:500',
            'sosmed_twitter' => 'nullable|url|max:500',
            'sosmed_tiktok' => 'nullable|url|max:500',
            'sosmed_whatsapp' => 'nullable|string|max:50',
            'seo_meta_keywords' => 'nullable|string',
            'seo_meta_description' => 'nullable|string',
            'logo_file' => 'nullable|image|max:2048',
            'seo_og_image_file' => 'nullable|image|max:2048',
        ]);

        foreach (self::TEXT_KEYS as $key) {
            PengaturanSitus::setValue($key, $data[$key] ?? null);
        }

        if ($request->hasFile('logo_file')) {
            $old = PengaturanSitus::getValue('logo');
            $path = $request->file('logo_file')->store('situs', 'public');
            PengaturanSitus::setValue('logo', $path);
            $this->deleteOldUpload($old);
        }

        if ($request->hasFile('seo_og_image_file')) {
            $old = PengaturanSitus::getValue('seo_og_image');
            $path = $request->file('seo_og_image_file')->store('situs', 'public');
            PengaturanSitus::setValue('seo_og_image', $path);
            $this->deleteOldUpload($old);
        }

        // SitusComposer meng-cache pengaturan situs selama 5 menit, hapus agar perubahan langsung terlihat.
        Cache::forget('pengaturan_situs');

        return redirect()->route('operator.pengaturan-situs.edit')->with('success', 'Pengaturan situs berhasil diperbarui.');
    }

    private function deleteOldUpload(?string $path): void
    {
        if (!$path || str_starts_with($path, 'img/') || str_starts_with($path, 'http')) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
