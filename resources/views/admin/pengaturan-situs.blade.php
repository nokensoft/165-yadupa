@extends('layouts.dashboard')
@section('title', 'Pengaturan Situs')
@section('page-title', 'Pengaturan Situs')

@section('content')
    <div class="flex gap-8" x-data="sectionNav()">
    {{-- Main Content --}}
    <form action="{{ route('admin.pengaturan-situs.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 flex-1 min-w-0">
        @csrf
        @method('PUT')

        {{-- Informasi Umum --}}
        <div id="informasi-umum" class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
                <i class="fas fa-cog mr-2 text-primary"></i> Informasi Umum
            </h3>
            <div class="space-y-6 max-w-2xl">
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Nama Situs / Nama Organisasi</label>
                    <input type="text" name="nama_situs" value="{{ $settings['nama_situs'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round">
                </div>
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Nama Organisasi (Bahasa Inggris)</label>
                    <input type="text" name="nama_situs_en" value="{{ $settings['nama_situs_en'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="Papua Environmental Foundation">
                </div>
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Deskripsi Situs</label>
                    <textarea name="deskripsi_situs" rows="3" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round resize-none">{{ $settings['deskripsi_situs'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        {{-- Kontak --}}
        <div id="kontak" class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
                <i class="fas fa-address-book mr-2 text-primary"></i> Kontak
            </h3>
            <div class="space-y-6 max-w-2xl">
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Alamat Lengkap</label>
                    <input type="text" name="alamat" value="{{ $settings['alamat'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Telepon Kantor</label>
                        <input type="text" name="telepon" value="{{ $settings['telepon'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="+62 823-1221-1707">
                    </div>
                    <div>
                        <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Fax</label>
                        <input type="text" name="fax" value="{{ $settings['fax'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="+62 823-1221-1707">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-lg font-bold uppercase text-gray-500 block mb-2">WhatsApp Direktur</label>
                        <input type="text" name="whatsapp_direktur" value="{{ $settings['whatsapp_direktur'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="6282312211707">
                    </div>
                    <div>
                        <label class="text-lg font-bold uppercase text-gray-500 block mb-2">WhatsApp Ketua</label>
                        <input type="text" name="whatsapp_ketua" value="{{ $settings['whatsapp_ketua'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="6282312211707">
                    </div>
                </div>
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Email Organisasi</label>
                    <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="info@yalipapua.or.id">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Email Direktur</label>
                        <input type="email" name="email_direktur" value="{{ $settings['email_direktur'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="kemitraan@yalipapua.or.id">
                    </div>
                    <div>
                        <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Email Ketua</label>
                        <input type="email" name="email_ketua" value="{{ $settings['email_ketua'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="info@yalipapua.or.id">
                    </div>
                </div>
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Website</label>
                    <input type="text" name="website" value="{{ $settings['website'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="https://yalipapua.org">
                </div>
            </div>
        </div>

        {{-- Peta / Google Maps --}}
        <div id="peta" class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
                <i class="fas fa-map-marker-alt mr-2 text-primary"></i> Peta & Lokasi
            </h3>
            <div class="space-y-6 max-w-2xl">
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Titik Koordinat</label>
                    <input type="text" name="koordinat_maps" value="{{ $settings['koordinat_maps'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="-2.594368° LS, 140.675205° BT">
                </div>
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Link Google Maps</label>
                    <input type="url" name="google_maps_link" value="{{ $settings['google_maps_link'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="https://maps.google.com/?q=Kantor+YALI+PAPUA+Jayapura">
                    <p class="text-lg text-gray-400 mt-1">Link pendek Google Maps untuk tombol "Buka di Google Maps".</p>
                </div>
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Google Maps Embed URL</label>
                    <textarea name="google_maps_embed" rows="3" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round resize-none font-mono text-sm">{{ $settings['google_maps_embed'] ?? '' }}</textarea>
                    <p class="text-lg text-gray-400 mt-1">Salin URL src dari kode embed Google Maps (bukan seluruh tag &lt;iframe&gt;). Contoh: <code class="bg-gray-100 px-1">https://www.google.com/maps/embed?pb=...</code></p>
                    @if (!empty($settings['google_maps_embed']))
                    <div class="mt-4">
                        <p class="text-lg font-semibold text-gray-500 mb-2">Preview Peta:</p>
                        <iframe src="{{ $settings['google_maps_embed'] }}" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full"></iframe>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Logo Situs --}}
        <div id="logo-situs" class="bg-white shadow-sm p-6" x-data="logoPreview('{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : '' }}')">
            <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
                <i class="fas fa-image mr-2 text-primary"></i> Logo Situs
            </h3>
            <div class="max-w-2xl">
                <div class="flex items-start gap-6">
                    {{-- Preview --}}
                    <div class="shrink-0">
                        <div class="w-40 h-40 border-2 border-dashed border-gray-300 flex items-center justify-center bg-gray-50 overflow-hidden">
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-contain" alt="Preview Logo">
                            </template>
                            <template x-if="!preview">
                                <div class="text-center text-gray-400">
                                    <i class="fas fa-image text-3xl mb-1 block"></i>
                                    <span class="text-lg">Belum ada logo</span>
                                </div>
                            </template>
                        </div>
                    </div>
                    {{-- Upload --}}
                    <div class="flex-1 space-y-3">
                        <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Upload Logo Baru</label>
                        <input type="file" name="logo" accept="image/*" @change="onFileChange($event)" class="w-full border border-gray-300 p-3 text-lg no-round">
                        <p class="text-lg text-gray-400">Format: JPG, PNG, SVG. Rekomendasi: transparan background.</p>
                        <template x-if="hasNewFile">
                            <button type="button" @click="clearFile()" class="text-lg text-red-500 hover:text-red-700 transition">
                                <i class="fas fa-times mr-1"></i> Batalkan pilihan
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        {{-- Media Sosial --}}
        <div id="media-sosial" class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
                <i class="fas fa-share-alt mr-2 text-primary"></i> Media Sosial
            </h3>
            <div class="space-y-5 max-w-2xl">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-600 text-white flex items-center justify-center shrink-0">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </div>
                    <input type="url" name="sosmed_facebook" value="{{ $settings['sosmed_facebook'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="https://facebook.com/namaakun">
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-500 text-white flex items-center justify-center shrink-0">
                        <i class="fab fa-instagram text-xl"></i>
                    </div>
                    <input type="url" name="sosmed_instagram" value="{{ $settings['sosmed_instagram'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="https://instagram.com/namaakun">
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-600 text-white flex items-center justify-center shrink-0">
                        <i class="fab fa-youtube text-xl"></i>
                    </div>
                    <input type="url" name="sosmed_youtube" value="{{ $settings['sosmed_youtube'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="https://youtube.com/@namaakun">
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-sky-500 text-white flex items-center justify-center shrink-0">
                        <i class="fab fa-twitter text-xl"></i>
                    </div>
                    <input type="url" name="sosmed_twitter" value="{{ $settings['sosmed_twitter'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="https://x.com/namaakun">
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-black text-white flex items-center justify-center shrink-0">
                        <i class="fab fa-tiktok text-xl"></i>
                    </div>
                    <input type="url" name="sosmed_tiktok" value="{{ $settings['sosmed_tiktok'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="https://tiktok.com/@namaakun">
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-[#25D366] text-white flex items-center justify-center shrink-0">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </div>
                    <input type="text" name="sosmed_whatsapp" value="{{ $settings['sosmed_whatsapp'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="6281234567890 (format internasional tanpa +)">
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div id="seo" class="bg-white shadow-sm p-6" x-data="logoPreview('{{ !empty($settings['seo_og_image']) ? asset('storage/' . $settings['seo_og_image']) : '' }}')">
            <h3 class="text-lg font-extrabold uppercase text-dark tracking-wide mb-6 pb-3 border-b-2 border-primary">
                <i class="fas fa-search mr-2 text-primary"></i> SEO (Search Engine Optimization)
            </h3>
            <div class="space-y-6 max-w-2xl">
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Meta Keywords</label>
                    <input type="text" name="seo_meta_keywords" value="{{ $settings['seo_meta_keywords'] ?? '' }}" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round" placeholder="YADUPA - Yayasan Anak Dusun Papua, yayasan lingkungan hidup papua, konservasi papua">
                    <p class="text-lg text-gray-400 mt-1">Pisahkan dengan koma.</p>
                </div>
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Meta Description</label>
                    <textarea name="seo_meta_description" rows="3" maxlength="160" class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round resize-none" placeholder="Deskripsi singkat untuk mesin pencari (maks 160 karakter)">{{ $settings['seo_meta_description'] ?? '' }}</textarea>
                    <p class="text-lg text-gray-400 mt-1">Maksimal 160 karakter. Deskripsi ini muncul di hasil pencarian Google.</p>
                </div>
                <div>
                    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">OG Image (Open Graph)</label>
                    <div class="flex items-start gap-6">
                        <div class="shrink-0">
                            <div class="w-48 h-28 border-2 border-dashed border-gray-300 flex items-center justify-center bg-gray-50 overflow-hidden">
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover" alt="OG Image Preview">
                                </template>
                                <template x-if="!preview">
                                    <div class="text-center text-gray-400">
                                        <i class="fas fa-image text-2xl mb-1 block"></i>
                                        <span class="text-lg">1200 x 630 px</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="seo_og_image" accept="image/*" @change="onFileChange($event)" class="w-full border border-gray-300 p-3 text-lg no-round">
                            <p class="text-lg text-gray-400 mt-1">Gambar yang tampil saat link di-share di media sosial. Rekomendasi: 1200x630 px.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div id="simpan" class="flex">
            <button type="submit" class="bg-primary text-white px-10 py-4 font-bold hover:bg-red-700 transition uppercase text-lg tracking-wide no-round">
                <i class="fas fa-save mr-2"></i> Simpan Semua Pengaturan
            </button>
        </div>
    </form>

    {{-- Floating Sidebar Navigation --}}
    <aside class="hidden lg:block w-56 shrink-0">
        <nav class="sticky top-24 bg-white shadow-sm p-4 space-y-1">
            <p class="text-lg font-extrabold uppercase text-gray-400 tracking-wider mb-3 px-3">Navigasi</p>
            <template x-for="item in sections" :key="item.id">
                <a :href="'#' + item.id" @click.prevent="scrollTo(item.id)"
                   class="flex items-center gap-2.5 px-3 py-2.5 text-lg font-semibold transition-all"
                   :class="active === item.id ? 'text-primary bg-red-50 border-l-3 border-primary' : 'text-gray-500 hover:text-dark hover:bg-gray-50 border-l-3 border-transparent'">
                    <i :class="item.icon" class="w-4 text-center text-lg"></i>
                    <span x-text="item.label"></span>
                </a>
            </template>
        </nav>
    </aside>
    </div>

    @push('scripts')
    <script>
        function sectionNav() {
            return {
                active: 'informasi-umum',
                sections: [
                    { id: 'informasi-umum', label: 'Informasi Umum', icon: 'fas fa-cog' },
                    { id: 'kontak', label: 'Kontak', icon: 'fas fa-address-book' },
                    { id: 'peta', label: 'Peta & Lokasi', icon: 'fas fa-map-marker-alt' },
                    { id: 'logo-situs', label: 'Logo Situs', icon: 'fas fa-image' },
                    { id: 'media-sosial', label: 'Media Sosial', icon: 'fas fa-share-alt' },
                    { id: 'seo', label: 'SEO', icon: 'fas fa-search' },
                    { id: 'simpan', label: 'Simpan', icon: 'fas fa-save' },
                ],
                init() {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                this.active = entry.target.id;
                            }
                        });
                    }, { rootMargin: '-20% 0px -60% 0px' });

                    this.sections.forEach(s => {
                        const el = document.getElementById(s.id);
                        if (el) observer.observe(el);
                    });
                },
                scrollTo(id) {
                    const el = document.getElementById(id);
                    if (el) {
                        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        this.active = id;
                    }
                }
            }
        }

        function logoPreview(initialUrl) {
            return {
                preview: initialUrl || null,
                originalPreview: initialUrl || null,
                hasNewFile: false,
                fileInput: null,
                onFileChange(event) {
                    this.fileInput = event.target;
                    const file = event.target.files[0];
                    if (file) {
                        this.hasNewFile = true;
                        const reader = new FileReader();
                        reader.onload = (e) => { this.preview = e.target.result; };
                        reader.readAsDataURL(file);
                    }
                },
                clearFile() {
                    this.preview = this.originalPreview;
                    this.hasNewFile = false;
                    if (this.fileInput) this.fileInput.value = '';
                }
            }
        }
    </script>
    @endpush
@endsection
