@extends('layouts.visitor')
@section('title', 'Dokumentasi Foto - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', 'Dokumentasi Foto - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-description', 'Dokumentasi foto dokumentasi kegiatan dan informasi ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Foto']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')

<section class="relative bg-gradient-to-br from-primary-800 via-primary-900 to-secondary-900 h-[150px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-secondary-400 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-5xl sm:text-6xl font-extrabold mb-4">Galeri Foto</h1>
    </div>
</section>

<section class="py-12 bg-gray-50" x-data="{
    activeCategory: 'Semua',
    categories: ['Semua', 'Kegiatan Dinas', 'Ujian Online', 'Olahraga', 'HUT RI'],
    photos: [
        {
            category: 'Kegiatan Dinas',
            image: './galeri/1.jpg',
            caption: 'Musyawarah Perencanaan Pembangunan Kampung Tahun 2026',
        },
        {
            category: 'Kegiatan Dinas',
            image: './galeri/6.jpg',
            caption: 'Apel pagi pegawai di kantor dinas',
        },
        {
            category: 'Ujian Online',
            image: './galeri/2.jpg',
            caption: 'Penyaluran Bantuan Perlengkapan Sekolah untuk Siswa SD',
        },
        {
            category: 'Ujian Online',
            image: './galeri/3.jpg',
            caption: 'Penyaluran Bantuan Perlengkapan Sekolah untuk Siswa SD',
        },
        {
            category: 'Olahraga',
            image: './galeri/4.jpg',
            caption: 'Tinjauan Lapangan Pembangunan Fasilitas Air Bersih',
        },
        {
            category: 'Olahraga',
            image: './galeri/7.jpg',
            caption: 'Aksi Penanaman Pohon Bersama Komunitas Pemuda Adat',
        },
        {
            category: 'HUT RI',
            image: './galeri/5.jpg',
            caption: 'Foto bersama para guru pada HUT RI ke-80 Tahun',
        },
        {
            category: 'HUT RI',
            image: './galeri/9.jpg',
            caption: 'Karnaval Siswa/i pada HUT RI ke-80 Tahun',
        }
    ],
    get filteredPhotos() {
        if (this.activeCategory === 'Semua') {
            return this.photos;
        }
        return this.photos.filter(photo => photo.category === this.activeCategory);
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Kolom Kiri: Grid Foto (2 Kolom x 3 Baris) --}}
            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <template x-for="(photo, index) in filteredPhotos" :key="index">
                        <div class="bg-white border border-gray-200 overflow-hidden shadow-none flex flex-col transition-all duration-200 hover:border-gray-400">
                            {{-- Container Gambar --}}
                            <div class="relative w-full aspect-video bg-gray-100 overflow-hidden">
                                <img 
                                    :src="photo.image" 
                                    :alt="photo.caption" 
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                    loading="lazy"
                                />
                            </div>

                            {{-- Caption & Info --}}
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <h3 class="text-sm font-bold text-gray-900 leading-snug line-clamp-2" x-text="photo.caption"></h3>
                                <div class="mt-3 pt-2 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                                    <span x-text="photo.category"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- State Jika Foto Tidak Ditemukan --}}
                <template x-if="filteredPhotos.length === 0">
                    <div class="bg-white border border-gray-200 p-8 text-center text-gray-500">
                        Belum ada foto untuk kategori ini.
                    </div>
                </template>
            </div>

            {{-- Kolom Kanan: Sidebar Kategori Foto --}}
            <div class="bg-white border border-gray-200 p-4">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200 uppercase tracking-wider">
                    Kategori Foto
                </h3>

                <div class="flex flex-col gap-2">
                    <template x-for="(cat, index) in categories" :key="index">
                        <button 
                            @click="activeCategory = cat"
                            :class="activeCategory === cat 
                                ? 'bg-primary-900 text-white border-primary-900' 
                                : 'bg-gray-50 text-gray-700 hover:bg-gray-100 border-gray-200'"
                            class="w-full text-left p-3 border transition-all duration-150 flex items-center justify-between group">
                            
                            <span class="text-sm font-semibold" x-text="cat"></span>

                            {{-- Jumlah Foto per Kategori --}}
                            <span 
                                :class="activeCategory === cat ? 'bg-secondary-400 text-primary-900' : 'bg-gray-200 text-gray-600'"
                                class="text-xs font-bold px-2 py-0.5 rounded-none"
                                x-text="cat === 'Semua' ? photos.length : photos.filter(p => p.category === cat).length">
                            </span>
                        </button>
                    </template>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection