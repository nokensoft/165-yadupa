@extends('layouts.visitor')

@section('title', 'Layanan - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', 'Layanan - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-description', 'Akses tautan portal layanan dan sistem informasi resmi di lingkungan YADUPA - Yayasan Anak Dusun Papua.')

@section('json-ld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Beranda',
            'item' => route('beranda')
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Layanan'
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')

{{-- Header Banner --}}
<section class="relative bg-gradient-to-br from-primary-800 via-primary-900 to-secondary-900 h-[150px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-secondary-400 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Layanan & Portal Terkait</h1>
    </div>
</section>

{{-- Grid Layanan 3 Kolom Rasio 1:1 --}}
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Item 1: SIKORA --}}
            <article class="bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                <a href="https://sikora.wondamakab.go.id" target="_blank" rel="noopener noreferrer" class="block w-full aspect-square bg-slate-900 overflow-hidden relative">
                    <img 
                        src="{{ asset('img/layanan/logo-tutwuri-handayani.jpg') }}" 
                        alt="SIKORA - Sistem Informasi Pendidikan Disdikpora Teluk Wondama" 
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                        loading="lazy"
                    />
                </a>
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <div>
                        <span class="text-xs font-bold text-red-600 uppercase tracking-wider mb-2 block">Sistem Informasi Disdikpora</span>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-red-600 transition">
                            <a href="{{ route('layanan.sikora') }}" target="_blank" rel="noopener noreferrer">SIKORA</a>
                        </h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-4">
                            Sistem Informasi Pendidikan resmi Dinas Pendidikan, Pemuda, dan Olahraga Kabupaten Teluk Wondama.
                        </p>
                    </div>
                    <a 
                        href="{{ route('layanan.sikora') }}" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center justify-between w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold text-xs rounded-xl transition"
                    >
                        <span>Pelajari Tentang SIKORA</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </a>
                </div>
            </article>

            {{-- Item 2: Portal Pemkab Teluk Wondama --}}
            <article class="bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                <a href="https://www.wondamakab.go.id" target="_blank" rel="noopener noreferrer" class="block w-full aspect-square bg-slate-900 overflow-hidden relative">
                    <img 
                        src="{{ asset('img/layanan/mockup-web-teluk-wondama.jpg') }}" 
                        alt="Portal Pemerintah Kabupaten Teluk Wondama" 
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                        loading="lazy"
                    />
                </a>
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <div>
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2 block">Pemerintah Daerah</span>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                            <a href="https://www.wondamakab.go.id" target="_blank" rel="noopener noreferrer">Portal Pemkab Teluk Wondama</a>
                        </h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-4">
                            Portal resmi informasi publik dan layanan pemerintahan Kabupaten Teluk Wondama, Papua Barat.
                        </p>
                    </div>
                    <a 
                        href="https://www.wondamakab.go.id" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center justify-between w-full px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs rounded-xl transition"
                    >
                        <span>Kunjungi wondamakab.go.id</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </a>
                </div>
            </article>

            {{-- Item 3: Portal Provinsi Papua Barat --}}
            <article class="bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                <a href="https://www.papuabaratprov.go.id" target="_blank" rel="noopener noreferrer" class="block w-full aspect-square bg-slate-900 overflow-hidden relative">
                    <img 
                        src="{{ asset('img/layanan/mockup-web-papua-barat.jpg') }}" 
                        alt="Portal Pemerintah Provinsi Papua Barat" 
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                        loading="lazy"
                    />
                </a>
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <div>
                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-2 block">Pemerintah Provinsi</span>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-emerald-600 transition">
                            <a href="https://www.papuabaratprov.go.id" target="_blank" rel="noopener noreferrer">Portal Provinsi Papua Barat</a>
                        </h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-4">
                            Portal resmi terpadu Pemerintah Provinsi Papua Barat untuk informasi publik dan pembangunan daerah.
                        </p>
                    </div>
                    <a 
                        href="https://www.papuabaratprov.go.id" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center justify-between w-full px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs rounded-xl transition"
                    >
                        <span>Kunjungi papuabaratprov.go.id</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </a>
                </div>
            </article>

        </div>
    </div>
</section>

@endsection