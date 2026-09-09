@extends('layouts.dashboard')
@section('title', 'Pengaturan Situs')
@section('page-title', 'Pengaturan Situs')
@section('content')
    <form action="{{ route('operator.pengaturan-situs.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- LEFT COLUMN --}}
            <div class="flex-1 space-y-6">

                <x-operator.card title="Informasi Umum">
                    <div class="space-y-4">
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Nama Situs <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_situs" value="{{ old('nama_situs', $situs['nama_situs'] ?? '') }}" required
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('nama_situs') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Nama Situs (Inggris)</label>
                            <input type="text" name="nama_situs_en" value="{{ old('nama_situs_en', $situs['nama_situs_en'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Deskripsi Situs</label>
                            <textarea name="deskripsi_situs" rows="3"
                                      class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round resize-none">{{ old('deskripsi_situs', $situs['deskripsi_situs'] ?? '') }}</textarea>
                        </div>
                    </div>
                </x-operator.card>

                <x-operator.card title="Kontak">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Email Umum</label>
                            <input type="email" name="email" value="{{ old('email', $situs['email'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('email') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Telepon</label>
                            <input type="text" name="telepon" value="{{ old('telepon', $situs['telepon'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Email Direktur/Sekretariat</label>
                            <input type="email" name="email_direktur" value="{{ old('email_direktur', $situs['email_direktur'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('email_direktur') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Email Kepala Dinas</label>
                            <input type="email" name="email_ketua" value="{{ old('email_ketua', $situs['email_ketua'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('email_ketua') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">WhatsApp Sekretariat</label>
                            <input type="text" name="whatsapp_direktur" value="{{ old('whatsapp_direktur', $situs['whatsapp_direktur'] ?? '') }}"
                                   placeholder="62812xxxxxxx"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">WhatsApp Kepala Dinas</label>
                            <input type="text" name="whatsapp_ketua" value="{{ old('whatsapp_ketua', $situs['whatsapp_ketua'] ?? '') }}"
                                   placeholder="62812xxxxxxx"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Fax</label>
                            <input type="text" name="fax" value="{{ old('fax', $situs['fax'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Website</label>
                            <input type="url" name="website" value="{{ old('website', $situs['website'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('website') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-lg text-gray-500 block mb-1">Alamat</label>
                            <textarea name="alamat" rows="2"
                                      class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round resize-none">{{ old('alamat', $situs['alamat'] ?? '') }}</textarea>
                        </div>
                    </div>
                </x-operator.card>

                <x-operator.card title="Lokasi & Peta">
                    <div class="space-y-4">
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Koordinat</label>
                            <input type="text" name="koordinat_maps" value="{{ old('koordinat_maps', $situs['koordinat_maps'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Link Google Maps</label>
                            <input type="url" name="google_maps_link" value="{{ old('google_maps_link', $situs['google_maps_link'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('google_maps_link') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">URL Embed Google Maps</label>
                            <textarea name="google_maps_embed" rows="2"
                                      class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round resize-none">{{ old('google_maps_embed', $situs['google_maps_embed'] ?? '') }}</textarea>
                        </div>
                    </div>
                </x-operator.card>

                <x-operator.card title="Media Sosial">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-lg text-gray-500 block mb-1"><i class="fa-brands fa-facebook mr-1"></i> Facebook</label>
                            <input type="url" name="sosmed_facebook" value="{{ old('sosmed_facebook', $situs['sosmed_facebook'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('sosmed_facebook') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1"><i class="fa-brands fa-instagram mr-1"></i> Instagram</label>
                            <input type="url" name="sosmed_instagram" value="{{ old('sosmed_instagram', $situs['sosmed_instagram'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('sosmed_instagram') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1"><i class="fa-brands fa-youtube mr-1"></i> YouTube</label>
                            <input type="url" name="sosmed_youtube" value="{{ old('sosmed_youtube', $situs['sosmed_youtube'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('sosmed_youtube') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1"><i class="fa-brands fa-x-twitter mr-1"></i> Twitter / X</label>
                            <input type="url" name="sosmed_twitter" value="{{ old('sosmed_twitter', $situs['sosmed_twitter'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('sosmed_twitter') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1"><i class="fa-brands fa-tiktok mr-1"></i> TikTok</label>
                            <input type="url" name="sosmed_tiktok" value="{{ old('sosmed_tiktok', $situs['sosmed_tiktok'] ?? '') }}"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                            @error('sosmed_tiktok') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1"><i class="fa-brands fa-whatsapp mr-1"></i> WhatsApp CS</label>
                            <input type="text" name="sosmed_whatsapp" value="{{ old('sosmed_whatsapp', $situs['sosmed_whatsapp'] ?? '') }}"
                                   placeholder="62812xxxxxxx"
                                   class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                        </div>
                    </div>
                </x-operator.card>

                <x-operator.card title="SEO">
                    <div class="space-y-4">
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Meta Keywords</label>
                            <textarea name="seo_meta_keywords" rows="2"
                                      class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round resize-none"
                                      placeholder="Pisahkan dengan koma">{{ old('seo_meta_keywords', $situs['seo_meta_keywords'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="text-lg text-gray-500 block mb-1">Meta Description</label>
                            <textarea name="seo_meta_description" rows="3"
                                      class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round resize-none">{{ old('seo_meta_description', $situs['seo_meta_description'] ?? '') }}</textarea>
                        </div>
                    </div>
                </x-operator.card>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="w-full lg:w-80 space-y-6">
                <div class="bg-white shadow-sm p-6">
                    <button type="submit" class="w-full bg-primary text-white px-4 py-3 font-bold hover:bg-red-700 transition uppercase text-lg tracking-wide no-round text-center">
                        <i class="fas fa-save mr-1"></i> Simpan Pengaturan
                    </button>
                </div>

                <x-operator.image-upload
                    label="Logo Situs"
                    name="logo_file"
                    aspect="aspect-square"
                    :preview="!empty($situs['logo']) ? (str_starts_with($situs['logo'], 'http') ? $situs['logo'] : asset('storage/' . $situs['logo'])) : null"
                    help="Kosongkan untuk mempertahankan logo saat ini."
                />

                <x-operator.image-upload
                    label="Gambar OG (Share Sosial Media)"
                    name="seo_og_image_file"
                    aspect="aspect-video"
                    :preview="!empty($situs['seo_og_image']) ? (str_starts_with($situs['seo_og_image'], 'http') ? $situs['seo_og_image'] : asset('storage/' . $situs['seo_og_image'])) : null"
                    help="Ditampilkan saat link situs dibagikan ke media sosial. Kosongkan untuk mempertahankan gambar saat ini."
                />
            </div>
        </div>
    </form>
@endsection
