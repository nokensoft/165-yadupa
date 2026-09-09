@extends('layouts.visitor')
@section('title', $video->title . ' - Galeri Video')
@section('seo-title', $video->title . ' - YADUPA - Yayasan Anak Dusun Papua')
@section('seo-description', Str::limit(strip_tags($video->keterangan ?? $video->title), 160))

@section('json-ld')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'VideoObject',
    'name' => $video->title,
    'description' => $video->keterangan ?? $video->title,
    'thumbnailUrl' => $video->gambar,
    'uploadDate' => $video->created_at ? $video->created_at->toIso8601String() : now()->toIso8601String(),
    'embedUrl' => $video->youtube_embed_url
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')

{{-- Header Banner --}}
<section class="relative bg-gradient-to-br from-primary-800 via-primary-900 to-secondary-900 h-[120px] flex items-center justify-center overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight line-clamp-1">Galeri Video</h1>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Kolom Utama: Embed Video & Detail --}}
            <div class="lg:col-span-2 bg-white border border-gray-200 p-6">
                {{-- Breadcrumb --}}
                <div class="text-xs text-gray-500 mb-4 flex items-center gap-2">
                    <a href="{{ route('beranda') }}" class="hover:underline">Beranda</a>
                    <span>&rsaquo;</span>
                    <a href="{{ route('video.index') }}" class="hover:underline">Video</a>
                    <span>&rsaquo;</span>
                    <span class="text-gray-900 font-semibold line-clamp-1">{{ $video->title }}</span>
                </div>

                {{-- Judul Video --}}
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-3 leading-tight">
                    {{ $video->title }}
                </h1>

                {{-- Meta Info --}}
                <div class="flex items-center gap-4 text-xs text-gray-500 mb-6 pb-4 border-b border-gray-200">
                    <span class="bg-primary-900 text-white font-bold px-2.5 py-0.5 uppercase tracking-wider">
                        {{ $video->category }}
                    </span>
                    <span>{{ $video->created_at ? $video->created_at->translatedFormat('d F Y') : '-' }}</span>
                </div>

                {{-- Iframe Embed YouTube Responsive --}}
                <div class="relative w-full aspect-video bg-black mb-6">
                    @if($video->youtube_embed_url)
                        <iframe 
                            src="{{ $video->youtube_embed_url }}" 
                            title="{{ $video->title }}"
                            class="absolute top-0 left-0 w-full h-full border-0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen>
                        </iframe>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white text-sm">
                            URL Video YouTube tidak valid atau tidak tersedia.
                        </div>
                    @endif
                </div>

                {{-- Deskripsi/Keterangan --}}
                @if($video->keterangan)
                    <div class="prose max-w-none text-gray-700 text-sm leading-relaxed">
                        <h3 class="text-base font-bold text-gray-900 mb-2 uppercase tracking-wider">Keterangan</h3>
                        <p>{{ $video->keterangan }}</p>
                    </div>
                @endif

                {{-- Tombol Kembali & Tonton di YouTube --}}
                <div class="mt-8 pt-4 border-t border-gray-200 flex items-center justify-between">
                    <a href="{{ route('video.index') }}" class="inline-flex items-center text-sm font-bold text-primary-900 hover:underline">
                        &larr; Kembali ke Galeri Video
                    </a>
                    <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer" class="bg-red-600 text-white px-4 py-2 text-xs font-bold hover:bg-red-700 flex items-center gap-2">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        Buka di YouTube
                    </a>
                </div>
            </div>

            {{-- Sidebar: Video Terkait --}}
            <div class="space-y-6">
                <div class="bg-white border border-gray-200 p-4">
                    <h3 class="text-base font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200 uppercase tracking-wider">
                        Video Terkait
                    </h3>

                    @if($videoTerkait->count() > 0)
                        <div class="space-y-4">
                            @foreach($videoTerkait as $item)
                                <a href="{{ route('video.show', $item->slug) }}" class="flex gap-3 group">
                                    <div class="relative w-28 aspect-video bg-gray-100 flex-shrink-0 overflow-hidden">
                                        <img 
                                            src="{{ $item->gambar }}" 
                                            alt="{{ $item->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200" 
                                        />
                                        <div class="absolute inset-0 bg-black/20 flex items-center justify-center">
                                            <div class="w-6 h-6 bg-red-600 text-white rounded-full flex items-center justify-center">
                                                <svg class="w-3 h-3 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-xs font-bold text-gray-900 group-hover:text-primary-800 line-clamp-2 leading-snug">
                                            {{ $item->title }}
                                        </h4>
                                        <p class="text-[10px] text-gray-500 mt-1">
                                            {{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '-' }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-500">Tidak ada video terkait lainnya saat ini.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

@endsection