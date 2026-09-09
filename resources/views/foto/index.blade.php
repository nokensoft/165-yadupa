@extends('layouts.visitor')
@section('title', 'Galeri Foto - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', 'Galeri Foto - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-description', 'Dokumentasi foto kegiatan, sarana prasarana, dan agenda YADUPA - Yayasan Anak Dusun Papua.')

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
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">Galeri Foto</h1>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Kolom Kiri: Grid Foto --}}
            <div class="lg:col-span-2">
                @if($photos->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($photos as $photo)
                            <div class="bg-white border border-gray-200 overflow-hidden flex flex-col transition-all duration-200 hover:border-gray-400">
                                {{-- Container Gambar --}}
                                <a href="{{ route('foto.show', $photo->slug) }}" class="relative w-full aspect-video bg-gray-100 overflow-hidden group">
                                    <img 
                                        src="{{ $photo->gambar }}" 
                                        alt="{{ $photo->title }}" 
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        loading="lazy"
                                    />
                                    <span class="absolute top-2 right-2 bg-primary-900 text-white text-[10px] font-bold px-2 py-0.5 uppercase tracking-wider">
                                        {{ $photo->category }}
                                    </span>
                                </a>

                                {{-- Caption & Info --}}
                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <a href="{{ route('foto.show', $photo->slug) }}" class="hover:text-primary-800 transition-colors">
                                        <h3 class="text-sm font-bold text-gray-900 leading-snug line-clamp-2">
                                            {{ $photo->title }}
                                        </h3>
                                    </a>
                                    @if($photo->keterangan)
                                        <p class="text-xs text-gray-600 mt-2 line-clamp-2">
                                            {{ $photo->keterangan }}
                                        </p>
                                    @endif
                                    <div class="mt-3 pt-2 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ $photo->created_at ? $photo->created_at->translatedFormat('d M Y') : '-' }}</span>
                                        <a href="{{ route('foto.show', $photo->slug) }}" class="font-semibold text-primary-900 hover:underline">
                                            Lihat Foto &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Paginasi Laravel --}}
                    <div class="mt-8">
                        {{ $photos->links() }}
                    </div>
                @else
                    <div class="bg-white border border-gray-200 p-8 text-center text-gray-500">
                        Belum ada foto yang tersedia untuk kategori ini.
                    </div>
                @endif
            </div>

            {{-- Kolom Kanan: Sidebar Kategori Foto & Form Pencarian --}}
            <div class="space-y-6">
                {{-- Form Pencarian --}}
                <div class="bg-white border border-gray-200 p-4">
                    <h3 class="text-base font-bold text-gray-900 mb-3 pb-2 border-b border-gray-200 uppercase tracking-wider">
                        Cari Foto
                    </h3>
                    <form action="{{ route('foto.index') }}" method="GET" class="flex gap-2">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ request('q') }}" 
                            placeholder="Kata kunci..." 
                            class="w-full text-sm border-gray-300 focus:border-primary-900 focus:ring-0"
                        />
                        <button type="submit" class="bg-primary-900 text-white px-4 py-2 text-sm font-bold hover:bg-primary-800">
                            Cari
                        </button>
                    </form>
                </div>

                {{-- Filter Kategori --}}
                <div class="bg-white border border-gray-200 p-4">
                    <h3 class="text-base font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200 uppercase tracking-wider">
                        Kategori Foto
                    </h3>

                    <div class="flex flex-col gap-2">
                        <a 
                            href="{{ route('foto.index', array_filter(['q' => request('q')])) }}"
                            class="w-full text-left p-3 border transition-all duration-150 flex items-center justify-between {{ !request('category') ? 'bg-primary-900 text-white border-primary-900' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 border-gray-200' }}">
                            <span class="text-sm font-semibold">Semua Kategori</span>
                        </a>

                        @foreach($categories as $cat)
                            <a 
                                href="{{ route('foto.index', array_filter(['category' => $cat, 'q' => request('q')])) }}"
                                class="w-full text-left p-3 border transition-all duration-150 flex items-center justify-between {{ request('category') === $cat ? 'bg-primary-900 text-white border-primary-900' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 border-gray-200' }}">
                                <span class="text-sm font-semibold">{{ $cat }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection