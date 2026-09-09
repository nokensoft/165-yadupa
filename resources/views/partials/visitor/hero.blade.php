@php
    /**
     * Hero utama YADUPA.
     * Dipindahkan keluar dari layouts/visitor.blade.php agar hanya tampil di Beranda.
     * Sertakan lewat @section('hero') pada halaman yang membutuhkannya.
     *
     * Background slider disinkronkan dengan data pada tabel `heroes`
     * (dikelola operator lewat menu Hero Beranda). Judul yang diisi operator
     * ditampilkan sebagai caption kecil di setiap slide. Bila belum ada data
     * hero aktif, tampilkan satu slide fallback memakai bg2.jpeg.
     */
    $heroSlides = (isset($heroes) && $heroes->isNotEmpty())
        ? $heroes->map(fn ($hero) => ['title' => $hero->title, 'image' => $hero->gambar])->values()
        : collect([['title' => 'YADUPA - Yayasan Anak Dusun Papua', 'image' => asset('bg2.jpeg')]]);
@endphp

<header class="relative min-h-screen overflow-hidden bg-stone-900"
        x-data="{
            active: 0,
            slides: {{ $heroSlides->toJson() }},
            init() {
                if (this.slides.length > 1) {
                    setInterval(() => { this.active = (this.active + 1) % this.slides.length; }, 6000);
                }
            }
        }">

    {{-- Background slider --}}
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="active === index"
             x-transition:enter="transition-opacity ease-out duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-700"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 w-full h-full bg-cover bg-center hero-slide-zoom"
             :style="`background-image: url('${slide.image}');`">
        </div>
    </template>

    {{-- Overlay gelap untuk keterbacaan teks --}}
    <div class="absolute inset-0 bg-black/30"></div>

    <div class="relative z-10 flex flex-col min-h-screen">
        <div class="container mx-auto px-6 flex-grow flex items-center pt-28 pb-32 md:pt-36 md:pb-48">
            <div class="max-w-3xl">

                {{-- Garis aksen merah --}}
                <div class="w-24 h-2 bg-red-600 mb-8 rounded-full shadow-inner"></div>

                <h1 class="space-y-4">
                    <span class="block text-3xl md:text-6xl lg:text-7xl font-extrabold text-white bg-black/60 px-6 py-4 inline-block rounded-xl tracking-tight leading-tight shadow-lg">
                        <span class="text-red-500">YAYASAN</span> ANAK DUSUN PAPUA
                    </span>

                    <span class="block text-lg md:text-2xl font-semibold text-white bg-black/60 px-6 py-4 inline-block rounded-xl leading-relaxed tracking-wide shadow-lg">
                        Lembaga Swadaya Masyarakat (LSM) yang Mendapatkan Mandate Untuk Bekerja Sebagai Penguatan Masyarakat Adat Papua Secara Khusus Generasi Muda Papua.
                    </span>
                </h1>

                <p class="text-lg text-white/90 mt-8 max-w-2xl bg-black/30 p-4 rounded-xl backdrop-blur-sm border border-white/10">
                    Berdedikasi untuk memberikan akses pendidikan yang layak dan berkelanjutan bagi anak-anak muda di Tanah Papua. Bersama kita wujudkan mimpi mereka.
                </p>

                <div class="mt-10 flex flex-col sm:flex-row gap-5">
                    <a href="{{ route('kontak') }}"
                       class="px-8 py-4 bg-red-600 text-white font-semibold rounded-xl text-center hover:bg-red-700 transition shadow-xl shadow-red-950/40 flex items-center justify-center gap-3 text-base uppercase">
                        <i class="fas fa-envelope"></i>
                        Kontak &amp; Kolaborasi
                    </a>
                    <a href="{{ route('profil.program-utama') }}"
                       class="px-8 py-4 bg-white/90 backdrop-blur-md text-stone-950 font-semibold rounded-xl text-center hover:bg-white transition shadow-xl flex items-center justify-center gap-3 text-base uppercase">
                        Program &amp; Kegiatan
                    </a>
                </div>

            </div>
        </div>

        {{-- Caption dokumentasi kegiatan (judul per-slide dari admin) & indikator slider --}}
        <template x-if="slides.length > 1">
            <div class="relative z-10 container mx-auto px-6 pb-8 flex items-center justify-between gap-4">
                <template x-for="(slide, index) in slides" :key="'caption-' + index">
                    <p x-show="active === index" x-transition.opacity
                       class="text-xs md:text-sm text-white/80 font-medium max-w-md truncate"
                       x-text="slide.title"></p>
                </template>

                <div class="flex space-x-2 shrink-0">
                    <template x-for="(slide, index) in slides" :key="'dot-' + index">
                        <button @click="active = index"
                                class="h-2 rounded-full transition-all duration-300"
                                :class="active === index ? 'w-8 bg-red-500' : 'w-2 bg-white/50'"
                                :aria-label="'Slide ' + (index + 1)"></button>
                    </template>
                </div>
            </div>
        </template>
    </div>
</header>

<style>
    @keyframes heroKenBurns {
        0% { transform: scale(1); }
        100% { transform: scale(1.08); }
    }
    .hero-slide-zoom {
        animation: heroKenBurns 7s ease-in-out forwards;
    }
</style>
