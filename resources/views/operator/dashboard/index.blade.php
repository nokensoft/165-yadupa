@extends('layouts.dashboard')
@section('title', 'Dasbor Operator')
@section('page-title', 'Dasbor')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
            <div class="w-14 h-14 bg-primary text-white flex items-center justify-center shrink-0">
                <i class="fas fa-newspaper text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-dark">{{ $stats['berita'] ?? '' }}</p>
                <p class="text-lg text-gray-500">Berita</p>
            </div>
        </div>

        <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
            <div class="w-14 h-14 bg-primary text-white flex items-center justify-center shrink-0">
                <i class="fas fa-bullhorn text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-dark">{{ $stats['pengumuman'] ?? '' }}</p>
                <p class="text-lg text-gray-500">Pengumuman</p>
            </div>
        </div>

        <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
            <div class="w-14 h-14 bg-primary text-white flex items-center justify-center shrink-0">
                <i class="fas fa-calendar-days text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-dark">{{ $stats['agenda'] ?? '' }}</p>
                <p class="text-lg text-gray-500">Agenda</p>
            </div>
        </div>

        <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
            <div class="w-14 h-14 bg-primary text-white flex items-center justify-center shrink-0">
                <i class="fas fa-chart-simple text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-dark">{{ $stats['infografis'] ?? '' }}</p>
                <p class="text-lg text-gray-500">Infografis</p>
            </div>
        </div>

        <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
            <div class="w-14 h-14 bg-primary text-white flex items-center justify-center shrink-0">
                <i class="fas fa-images text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-dark">{{ $stats['foto'] ?? '' }}</p>
                <p class="text-lg text-gray-500">Foto</p>
            </div>
        </div>

        <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
            <div class="w-14 h-14 bg-primary text-white flex items-center justify-center shrink-0">
                <i class="fas fa-video text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-dark">{{ $stats['video'] ?? '' }}</p>
                <p class="text-lg text-gray-500">Video</p>
            </div>
        </div>

        <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
            <div class="w-14 h-14 bg-primary text-white flex items-center justify-center shrink-0">
                <i class="fas fa-image text-xl"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-dark">{{ $stats['hero'] ?? '' }}</p>
                <p class="text-lg text-gray-500">Hero</p>
            </div>
        </div>

    </div>

    
    

    
 
    



    <div class="bg-white shadow-sm p-6" x-data="{ tab: 'informasi' }">
    <!-- Header & 4 Tab Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-gray-200 mb-4 gap-3">
        <h3 class="text-lg font-bold text-gray-800">Konten Terbaru</h3>
        
        <div class="flex flex-wrap gap-2">
            <button @click="tab = 'informasi'" 
                :class="tab === 'informasi' ? 'bg-primary text-white font-semibold' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                class="px-3 py-1.5 text-sm rounded-lg transition-colors">
                Informasi
            </button>
            <button @click="tab = 'foto'" 
                :class="tab === 'foto' ? 'bg-primary text-white font-semibold' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                class="px-3 py-1.5 text-sm rounded-lg transition-colors">
                Foto
            </button>
            <button @click="tab = 'video'" 
                :class="tab === 'video' ? 'bg-primary text-white font-semibold' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                class="px-3 py-1.5 text-sm rounded-lg transition-colors">
                Video
            </button>
            <button @click="tab = 'hero'" 
                :class="tab === 'hero' ? 'bg-primary text-white font-semibold' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                class="px-3 py-1.5 text-sm rounded-lg transition-colors">
                Hero
            </button>
        </div>
    </div>

    <!-- TAB 1: INFORMASI -->
    <div x-show="tab === 'informasi'">
        @if ($informasiTerbaru->count() > 0)
            <div class="space-y-0">
                @foreach ($informasiTerbaru as $b)
                    <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                        <div class="flex items-center space-x-4 flex-1 min-w-0 mr-4">
                            <div class="w-52 aspect-[4/3] shrink-0 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                @if ($b->image)
                                    <img src="{{ $b->gambar }}" alt="{{ $b->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-lg font-medium truncate">{{ $b->title }}</p>
                                <p class="text-sm text-gray-400">{{ $b->category ?? '-' }} &middot; {{ $b->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold px-3 py-1 rounded-full shrink-0 {{ $b->status === true ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($b->status ? 'terbit' : 'draft') }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-center py-4">Belum ada konten informasi.</p>
        @endif
    </div>

    <!-- TAB 2: FOTO -->
    <div x-show="tab === 'foto'" x-cloak>
        @if ($fotoTerbaru->count() > 0)
            <div class="space-y-0">
                @foreach ($fotoTerbaru as $f)
                    <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                        <div class="flex items-center space-x-4 flex-1 min-w-0 mr-4">
                            <div class="w-52 aspect-[4/3] shrink-0 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                @if ($f->image)
                                    <img src="{{ $f->gambar }}" alt="{{ $f->title ?? 'Foto' }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-lg font-medium truncate">{{ $f->title ?? $f->caption ?? 'Foto Tanpa Judul' }}</p>
                                <p class="text-sm text-gray-400">{{ $f->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold px-3 py-1 rounded-full shrink-0 {{ $f->status === true ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($f->status ? 'aktif' : 'non-aktif') }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-center py-4">Belum ada konten foto.</p>
        @endif
    </div>

    <!-- TAB 3: VIDEO -->
    <div x-show="tab === 'video'" x-cloak>
        @if ($videoTerbaru->count() > 0)
            <div class="space-y-0">
                @foreach ($videoTerbaru as $v)
                    <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                        <div class="flex items-center space-x-4 flex-1 min-w-0 mr-4">
                            <div class="w-52 aspect-[4/3] shrink-0 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                @if ($v->cover)
                                    <img src="{{ $v->gambar }}" alt="{{ $v->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-lg font-medium truncate">{{ $v->title }}</p>
                                <p class="text-sm text-gray-400">{{ $v->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold px-3 py-1 rounded-full shrink-0 {{ $v->status === true ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($v->status ? 'aktif' : 'non-aktif') }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-center py-4">Belum ada konten video.</p>
        @endif
    </div>

    <!-- TAB 4: HERO -->
    <div x-show="tab === 'hero'" x-cloak>
        @if ($heroTerbaru->count() > 0)
            <div class="space-y-0">
                @foreach ($heroTerbaru as $h)
                    <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                        <div class="flex items-center space-x-4 flex-1 min-w-0 mr-4">
                            <div class="w-52 aspect-[4/3] shrink-0 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                @if ($h->image)
                                    <img src="{{ $h->gambar }}" alt="{{ $h->title ?? 'Hero' }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-lg font-medium truncate">{{ $h->title ?? 'Banner Hero' }}</p>
                                <p class="text-sm text-gray-400">{{ $h->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold px-3 py-1 rounded-full shrink-0 {{ $h->status === true ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($h->status ? 'aktif' : 'non-aktif') }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-center py-4">Belum ada konten hero.</p>
        @endif
    </div>
</div>













@endsection
