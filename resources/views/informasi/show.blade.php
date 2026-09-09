@extends('layouts.visitor')

@section('title', $informasi->title . ' - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', $informasi->title . ' - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-description', Str::limit(strip_tags($informasi->content), 150))

@section('json-ld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'NewsArticle',
    'headline' => $informasi->title,
    'datePublished' => $informasi->published_at ? \Carbon\Carbon::parse($informasi->published_at)->toIso8601String() : $informasi->created_at->toIso8601String(),
    'dateModified' => $informasi->updated_at->toIso8601String(),
    'author' => [
        '@type' => 'Person',
        'name' => $informasi->user->name ?? 'Admin Disdik'
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
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Detail Informasi</h1>
    </div>
</section>

{{-- Detail Informasi & Sidebar --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[70vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Navigasi Breadcrumb --}}
        <nav class="flex text-xs text-slate-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li>
                    <a href="{{ route('beranda') }}" class="hover:text-primary-700 transition">Beranda</a>
                </li>
                <li><i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i></li>
                <li>
                    <a href="{{ route('informasi.index') }}" class="hover:text-primary-700 transition">Informasi</a>
                </li>
                <li><i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i></li>
                <li class="text-slate-800 font-medium truncate max-w-[200px] sm:max-w-xs">
                    {{ $informasi->title }}
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

            {{-- Kolom Utama: Konten Artikel --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-100 p-6 sm:p-8">
                
                {{-- Kategori Badge --}}
                <div class="mb-3">
                    <a href="{{ route('informasi.index', ['category' => $informasi->category]) }}" 
                       class="inline-block px-3 py-1 bg-primary-50 hover:bg-primary-100 text-primary-700 text-xs font-semibold rounded-full transition">
                        {{ $informasi->category }}
                    </a>
                </div>

                {{-- Judul Informasi --}}
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight mb-4">
                    {{ $informasi->title }}
                </h1>

                {{-- Meta Info (Tanggal & Penulis) --}}
                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 pb-6 mb-6 border-b border-slate-100">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar text-primary-600"></i>
                        {{ $informasi->published_at ? \Carbon\Carbon::parse($informasi->published_at)->translatedFormat('d F Y') : $informasi->created_at->translatedFormat('d F Y') }}
                    </span>
                </div>

                {{-- Gambar Utama --}}
                <div class="mb-8 rounded-lg overflow-hidden bg-slate-100 max-h-[450px] relative aspect-video">
                    @if($informasi->image)
                        <img 
                            src="{{ $informasi->gambar }}" 
                            alt="{{ $informasi->title }}" 
                            class="w-full h-full object-cover"
                        />
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-400">
                            <i class="fa-regular fa-newspaper text-5xl mb-2"></i>
                            <span class="text-sm font-medium">Tidak Ada Gambar</span>
                        </div>
                    @endif
                </div>

                {{-- Teks Konten --}}
                <div class="prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed">
                    {!! $informasi->content !!}
                </div>

                {{-- Navigasi Kembali --}}
                <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ route('informasi.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-xs rounded-lg transition">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Kembali ke Informasi</span>
                    </a>
                </div>

            </div>

            {{-- Kolom Sidebar: Informasi Terkait --}}
            <aside class="space-y-8">
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 sticky top-6">
                    <h3 class="text-base font-bold text-slate-900 pb-3 mb-4 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-newspaper text-primary-700"></i>
                        <span>Informasi Terkait</span>
                    </h3>

                    @if($informasiTerkait->count() > 0)
                        <div class="space-y-5">
                            @foreach($informasiTerkait as $item)
                                <div class="group flex gap-3 items-start">
                                    <a href="{{ route('informasi.show', $item->slug) }}" class="block w-20 h-16 rounded-md bg-slate-100 overflow-hidden shrink-0">
                                        @if($item->image)
                                            <img src="{{ $item->gambar }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <i class="fa-regular fa-image text-lg"></i>
                                            </div>
                                        @endif
                                    </a>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-xs font-semibold text-slate-800 line-clamp-2 group-hover:text-primary-700 transition mb-1">
                                            <a href="{{ route('informasi.show', $item->slug) }}">
                                                {{ $item->title }}
                                            </a>
                                        </h4>
                                        <span class="text-[10px] text-slate-400 block">
                                            {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-400 italic">Belum ada informasi terkait lainnya.</p>
                    @endif
                </div>
            </aside>

        </div>

    </div>
</section>

@endsection