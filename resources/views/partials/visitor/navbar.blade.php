@php
    /**
     * Navigasi utama visitor.
     *
     * @var bool $hasHero Saat true, navigasi tampil transparan di puncak halaman
     *                    lalu berubah solid ketika di-scroll. Saat false,
     *                    navigasi selalu solid.
     */
    $hasHero = $hasHero ?? false;

    $navLinks = [
        ['label' => 'Beranda',           'url' => route('beranda'),               'active' => request()->routeIs('beranda')],
        ['label' => 'Yang Kami Lakukan', 'url' => route('profil.program-utama'),  'active' => request()->routeIs('profil.program-utama')],
        ['label' => 'Mitra/Jaringan',    'url' => route('profil.mitra'),          'active' => request()->routeIs('profil.mitra')],
    ];

    $siapaKamiLinks = [
        ['label' => 'Sejarah & Tujuan Pendirian', 'icon' => 'fa-landmark',       'url' => route('profil.tentang'),              'active' => request()->routeIs('profil.tentang')],
        ['label' => 'Prinsip & Bidang Kerja',      'icon' => 'fa-balance-scale', 'url' => route('profil.prinsip-bidang-kerja'), 'active' => request()->routeIs('profil.prinsip-bidang-kerja')],
    ];
    $siapaKamiActive = collect($siapaKamiLinks)->contains('active', true);

    $mediaLinks = [
        ['label' => 'Berita & Informasi', 'icon' => 'fa-newspaper', 'url' => route('informasi.index'), 'active' => request()->routeIs('informasi.index', 'informasi.show')],
        ['label' => 'Galeri Foto',        'icon' => 'fa-images',    'url' => route('foto.index'),      'active' => request()->routeIs('foto.*')],
        ['label' => 'Galeri Video',       'icon' => 'fa-video',     'url' => route('video.index'),     'active' => request()->routeIs('video.*')],
    ];

    $mediaActive = collect($mediaLinks)->contains('active', true);
@endphp

<nav x-data="{ open: false, solid: {{ $hasHero ? 'false' : 'true' }} }"
     @if ($hasHero) @scroll.window="solid = (window.pageYOffset > 50)" @endif
     class="fixed top-0 left-0 right-0 z-50 px-6 py-4 pointer-events-none">

    <div class="container mx-auto">
        {{-- Kotak Navigasi --}}
        <div :class="solid ? 'bg-white/90 backdrop-blur-md shadow-xl border-stone-200' : 'bg-white/10 backdrop-blur-md border-white/20'"
             class="flex flex-col border px-6 py-3 rounded-2xl transition-all duration-300 pointer-events-auto">

            <div class="flex items-center justify-between w-full">
                {{-- Logo YADUPA --}}
                <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('logo-yadupa-transparant.png') }}" alt="YADUPA Logo" class="h-10 w-auto">
                    <div :class="solid ? 'text-stone-900' : 'text-white'" class="text-xl font-bold transition-colors duration-300">
                        <span class="block text-2xl">YADUPA</span>
                        <span class="block text-xs font-medium -mt-1 tracking-wider opacity-90">Yayasan Anak Dusun Papua</span>
                    </div>
                </a>

                {{-- Tombol Menu Mobile --}}
                <button @click="open = !open"
                        :class="solid ? 'text-stone-800' : 'text-white'"
                        class="md:hidden focus:outline-none transition-colors duration-300"
                        aria-label="Buka menu navigasi">
                    <i :class="open ? 'fas fa-times' : 'fas fa-bars'" class="text-2xl"></i>
                </button>

                {{-- Tautan Desktop --}}
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ $navLinks[0]['url'] }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition duration-300"
                       :class="solid
                           ? '{{ $navLinks[0]['active'] ? 'text-stone-900 bg-stone-100' : 'text-stone-700 hover:bg-stone-100' }}'
                           : '{{ $navLinks[0]['active'] ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }}'">
                        {{ $navLinks[0]['label'] }}
                    </a>

                    {{-- Dropdown Siapa Kami --}}
                    <div class="relative" x-data="{ siapaKamiOpen: false }" @click.outside="siapaKamiOpen = false">
                        <button @click="siapaKamiOpen = !siapaKamiOpen"
                                class="px-4 py-2 rounded-full text-sm font-medium transition duration-300 flex items-center gap-2"
                                :class="solid
                                    ? '{{ $siapaKamiActive ? 'text-stone-900 bg-stone-100' : 'text-stone-700 hover:bg-stone-100' }}'
                                    : '{{ $siapaKamiActive ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }}'">
                            Siapa Kami
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-200" :class="siapaKamiOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="siapaKamiOpen" x-transition x-cloak
                             class="absolute left-0 top-full mt-3 w-64 bg-white border border-stone-200 rounded-2xl shadow-xl overflow-hidden py-2">
                            @foreach ($siapaKamiLinks as $item)
                                <a href="{{ $item['url'] }}"
                                   @class([
                                       'flex items-center gap-3 px-4 py-2.5 text-sm font-medium transition-colors',
                                       'text-red-600 bg-red-50' => $item['active'],
                                       'text-stone-700 hover:bg-stone-100' => ! $item['active'],
                                   ])>
                                    <i class="fas {{ $item['icon'] }} w-4 text-center text-red-600"></i>
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @foreach (array_slice($navLinks, 1) as $link)
                        <a href="{{ $link['url'] }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition duration-300"
                           :class="solid
                               ? '{{ $link['active'] ? 'text-stone-900 bg-stone-100' : 'text-stone-700 hover:bg-stone-100' }}'
                               : '{{ $link['active'] ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }}'">
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    {{-- Dropdown Media --}}
                    <div class="relative" x-data="{ mediaOpen: false }" @click.outside="mediaOpen = false">
                        <button @click="mediaOpen = !mediaOpen"
                                class="px-4 py-2 rounded-full text-sm font-medium transition duration-300 flex items-center gap-2"
                                :class="solid
                                    ? '{{ $mediaActive ? 'text-stone-900 bg-stone-100' : 'text-stone-700 hover:bg-stone-100' }}'
                                    : '{{ $mediaActive ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }}'">
                            Media
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-200" :class="mediaOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="mediaOpen" x-transition x-cloak
                             class="absolute right-0 top-full mt-3 w-60 bg-white border border-stone-200 rounded-2xl shadow-xl overflow-hidden py-2">
                            @foreach ($mediaLinks as $media)
                                <a href="{{ $media['url'] }}"
                                   @class([
                                       'flex items-center gap-3 px-4 py-2.5 text-sm font-medium transition-colors',
                                       'text-red-600 bg-red-50' => $media['active'],
                                       'text-stone-700 hover:bg-stone-100' => ! $media['active'],
                                   ])>
                                    <i class="fas {{ $media['icon'] }} w-4 text-center text-red-600"></i>
                                    {{ $media['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div :class="solid ? 'bg-stone-200' : 'bg-white/20'" class="h-6 w-px mx-2 transition-colors duration-300"></div>

                    <a href="{{ route('kontak') }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold bg-red-600 text-white hover:bg-red-700 transition duration-300 shadow-lg shadow-red-950/20">
                        Kontak &amp; Kolaborasi
                    </a>
                </div>
            </div>

            {{-- Menu Mobile --}}
            <div x-show="open" x-transition x-cloak
                 class="md:hidden pt-4 pb-2 mt-3 space-y-1"
                 :class="solid ? 'border-t border-stone-200' : 'border-t border-white/20'">

                <a href="{{ $navLinks[0]['url'] }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-medium transition duration-300"
                   :class="solid
                       ? '{{ $navLinks[0]['active'] ? 'text-stone-900 bg-stone-100' : 'text-stone-700 hover:bg-stone-100' }}'
                       : '{{ $navLinks[0]['active'] ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }}'">
                    {{ $navLinks[0]['label'] }}
                </a>

                <p class="px-4 pt-2 pb-1 text-[11px] font-bold uppercase tracking-wider" :class="solid ? 'text-stone-400' : 'text-white/60'">Siapa Kami</p>
                @foreach ($siapaKamiLinks as $item)
                    <a href="{{ $item['url'] }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-300"
                       :class="solid
                           ? '{{ $item['active'] ? 'text-stone-900 bg-stone-100' : 'text-stone-700 hover:bg-stone-100' }}'
                           : '{{ $item['active'] ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }}'">
                        <i class="fas {{ $item['icon'] }} w-4 text-center"></i>
                        {{ $item['label'] }}
                    </a>
                @endforeach

                @foreach (array_slice($navLinks, 1) as $link)
                    <a href="{{ $link['url'] }}"
                       class="block px-4 py-2.5 rounded-xl text-sm font-medium transition duration-300"
                       :class="solid
                           ? '{{ $link['active'] ? 'text-stone-900 bg-stone-100' : 'text-stone-700 hover:bg-stone-100' }}'
                           : '{{ $link['active'] ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }}'">
                        {{ $link['label'] }}
                    </a>
                @endforeach

                @foreach ($mediaLinks as $media)
                    <a href="{{ $media['url'] }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-300"
                       :class="solid
                           ? '{{ $media['active'] ? 'text-stone-900 bg-stone-100' : 'text-stone-700 hover:bg-stone-100' }}'
                           : '{{ $media['active'] ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }}'">
                        <i class="fas {{ $media['icon'] }} w-4 text-center"></i>
                        {{ $media['label'] }}
                    </a>
                @endforeach

                <a href="{{ route('kontak') }}"
                   class="block mt-2 px-4 py-3 rounded-xl text-sm font-semibold text-center bg-red-600 text-white hover:bg-red-700 transition duration-300">
                    Kontak &amp; Kolaborasi
                </a>
            </div>

        </div>
    </div>
</nav>
