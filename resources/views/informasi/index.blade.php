@extends('layouts.visitor')

@section('title', 'Berita & Informasi - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', 'Berita & Informasi - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-description', 'Kumpulan berita dan informasi terbaru ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))

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
            'name' => 'Informasi'
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
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Berita & Informasi</h1>
    </div>
</section>

{{-- Konten Utama --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Bar Pencarian (Bagian Atas) --}}
        <div class="mb-10 max-w-2xl mx-auto">
            <form action="{{ route('informasi.index') }}" method="GET" class="flex items-center gap-2">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative w-full">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ request('q') }}" 
                        placeholder="Cari berita atau informasi..." 
                        class="w-full pl-10 pr-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent text-sm bg-white shadow-sm"
                    >
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <button type="submit" class="px-6 py-3 bg-primary-700 hover:bg-primary-800 text-white font-medium text-sm rounded-lg transition shadow-sm whitespace-nowrap">
                    Cari
                </button>
                @if(request('q') || request('category'))
                    <a href="{{ route('informasi.index') }}" class="px-4 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium text-sm rounded-lg transition whitespace-nowrap">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Layout Utama Grid 12 Kolom --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- Kolom Utama: Daftar Informasi (8 Kolom) --}}
            <div class="lg:col-span-8">
                
                @if(request('q') || request('category'))
                    <div class="mb-6 p-4 bg-white rounded-lg border border-slate-200 text-sm text-slate-600 flex items-center justify-between shadow-sm">
                        <div>
                            Menampilkan hasil untuk:
                            @if(request('q'))
                                <span class="font-semibold text-slate-900">"{{ request('q') }}"</span>
                            @endif
                            @if(request('category'))
                                <span class="font-semibold text-primary-700"> [Kategori: {{ request('category') }}]</span>
                            @endif
                        </div>
                        <a href="{{ route('informasi.index') }}" class="text-xs text-rose-600 hover:underline">Hapus Filter</a>
                    </div>
                @endif

                @if($informasi->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-stretch">
                        @foreach($informasi as $item)
                            <article class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden flex flex-col hover:shadow-md transition group">
                                
                                {{-- Thumbnail Gambar --}}
                                <a href="{{ route('informasi.show', $item->slug) }}" class="block relative aspect-video bg-slate-100 overflow-hidden">
                                    @if($item->image)
                                        <img src="{{ $item->gambar }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-400">
                                            <i class="fa-regular fa-newspaper text-4xl mb-2"></i>
                                            <span class="text-xs">Tidak Ada Gambar</span>
                                        </div>
                                    @endif
                                </a>

                                {{-- Isi Konten --}}
                                <div class="p-5 flex-1 flex flex-col">
                                    <div class="flex items-center justify-between text-xs text-slate-500 mb-3">
                                        <span class="flex items-center gap-1.5">
                                            <i class="fa-regular fa-calendar text-primary-600"></i>
                                            {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}
                                        </span>
                                        <span class="px-2 py-0.5 text-[10px] bg-primary-50 text-primary-700 rounded font-medium">
                                            {{ $item->category }}
                                        </span>
                                    </div>

                                    <h2 class="text-base font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-primary-700 transition">
                                        <a href="{{ route('informasi.show', $item->slug) }}">
                                            {{ $item->title }}
                                        </a>
                                    </h2>

                                    <p class="text-xs text-slate-600 line-clamp-3 mb-4 flex-1">
                                        {{ Str::limit(strip_tags($item->content), 100) }}
                                    </p>
                                </div>

                            </article>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $informasi->links() }}
                    </div>
                @else
                    <div class="text-center py-16 bg-white rounded-xl border border-slate-100 shadow-sm">
                        <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Informasi Tidak Ditemukan</h3>
                        <p class="text-sm text-slate-500 mb-6">
                            Tidak ada informasi yang sesuai dengan pencarian Anda.
                        </p>
                        <a href="{{ route('informasi.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-700 hover:bg-primary-800 text-white text-sm font-medium rounded-lg transition">
                            <i class="fa-solid fa-rotate-left text-xs"></i>
                            <span>Tampilkan Semua Informasi</span>
                        </a>
                    </div>
                @endif

            </div>

            {{-- Sidebar Kanan: Daftar Kategori & Edge Counter (4 Kolom) --}}
            <aside class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-6 sticky top-6">
                    <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-primary-600"></i>
                        <span>Kategori Informasi</span>
                    </h3>

                    @php
                        $enumCategories = ['Berita', 'Pengumuman', 'Agenda', 'Infografis'];
                    @endphp

                    <ul class="space-y-1.5 text-sm">
                        {{-- All Categories --}}
                        <li>
                            <a href="{{ route('informasi.index', array_filter(['q' => request('q')])) }}" 
                               class="flex items-center justify-between px-3 py-2 rounded-lg transition font-medium {{ !request('category') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                <span>Semua Kategori</span>
                                <span class="px-2 py-0.5 text-xs rounded-full shrink-0 {{ !request('category') ? 'bg-primary-700 text-white' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $totalAll }}
                                </span>
                            </a>
                        </li>

                        {{-- Enum Item Categories --}}
                        @foreach($enumCategories as $cat)
                            @php
                                $count = $categories[$cat] ?? 0;
                            @endphp
                            <li>
                                <a href="{{ route('informasi.index', array_filter(['q' => request('q'), 'category' => $cat])) }}" 
                                   class="flex items-center justify-between px-3 py-2 rounded-lg transition {{ request('category') == $cat ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <span class="truncate pr-2">{{ $cat }}</span>
                                    <span class="px-2 py-0.5 text-xs rounded-full shrink-0 {{ request('category') == $cat ? 'bg-primary-700 text-white' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

        </div>

    </div>
</section>

@endsection