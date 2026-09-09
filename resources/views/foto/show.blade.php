@extends('layouts.visitor')
@section('title', $photo->title . ' - Galeri Foto')
@section('seo-title', $photo->title . ' - Galeri Foto')
@section('seo-description', Str::limit(strip_tags($photo->keterangan ?? $photo->title), 150))

@section('json-ld')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('beranda')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Foto', 'item' => route('foto.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $photo->title]
    ]
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')

<section class="py-10 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('foto.index') }}" class="inline-flex items-center text-sm font-bold text-primary-900 hover:underline">
                &larr; Kembali ke Galeri Foto
            </a>
        </div>

        <div class="bg-white border border-gray-200 overflow-hidden">
            {{-- Image Viewer --}}
            <div class="w-full bg-black flex items-center justify-center">
                <img 
                    src="{{ $photo->gambar }}" 
                    alt="{{ $photo->title }}" 
                    class="max-h-[600px] w-auto object-contain"
                />
            </div>

            {{-- Detail Informasi --}}
            <div class="p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-3">
                    <span class="bg-primary-900 text-white text-xs font-bold px-2.5 py-1 uppercase tracking-wider">
                        {{ $photo->category }}
                    </span>
                    <span class="text-xs text-gray-500">
                        {{ $photo->created_at ? $photo->created_at->translatedFormat('d F Y') : '-' }}
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-tight mb-4">
                    {{ $photo->title }}
                </h1>

                @if($photo->keterangan)
                    <div class="prose max-w-none text-gray-700 text-sm leading-relaxed border-t border-gray-100 pt-4">
                        <p>{{ $photo->keterangan }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Foto Terkait --}}
        @if(isset($fotoTerkait) && $fotoTerkait->count() > 0)
            <div class="mt-12">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200 uppercase tracking-wider">
                    Foto Terkait dalam Kategori {{ $photo->category }}
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($fotoTerkait as $item)
                        <a href="{{ route('foto.show', $item->slug) }}" class="bg-white border border-gray-200 overflow-hidden group">
                            <div class="aspect-video w-full overflow-hidden bg-gray-100">
                                <img 
                                    src="{{ $item->gambar }}" 
                                    alt="{{ $item->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                                />
                            </div>
                            <div class="p-3">
                                <h4 class="text-xs font-bold text-gray-900 line-clamp-2 group-hover:text-primary-800">
                                    {{ $item->title }}
                                </h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>

@endsection