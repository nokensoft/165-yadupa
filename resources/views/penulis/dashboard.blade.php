@extends('layouts.dashboard')
@section('title', 'Dasbor Penulis')
@section('page-title', 'Dasbor')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach ($stats as $stat)
            <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
                <div class="w-14 h-14 {{ $stat['color'] }} text-white flex items-center justify-center shrink-0">
                    <i class="fas {{ $stat['icon'] }} text-xl"></i>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-dark">{{ $stat['value'] }}</p>
                    <p class="text-lg text-gray-500">{{ $stat['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <div class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">Blog Terbaru</h3>
            @if ($blogTerbaru->count() > 0)
                <div class="space-y-0">
                    @foreach ($blogTerbaru as $b)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <div class="flex-1 min-w-0 mr-4">
                                <p class="text-lg font-medium truncate">{{ $b->judul }}</p>
                                <p class="text-lg text-gray-400">{{ $b->kategori?->nama ?? '-' }} &middot; {{ $b->created_at->format('d M Y') }} &middot; {{ number_format($b->jumlah_dibaca ?? 0) }} dibaca</p>
                            </div>
                            <span class="text-lg font-bold px-3 py-1 shrink-0 {{ $b->status === 'terbit' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($b->status) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-4">Belum ada blog. <a href="{{ route('penulis.blog.create') }}" class="text-primary underline">Tulis blog pertama</a></p>
            @endif
            <div class="pt-4 mt-4 border-t border-gray-100">
                <a href="{{ route('penulis.blog.index') }}" class="inline-block bg-primary text-white px-4 py-2 text-sm font-bold hover:bg-red-700 transition uppercase">
                    Kelolah Blog
                </a>
            </div>
        </div>

        <div class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">Foto Bercerita Terbaru</h3>
            @if ($fotoBerceritaTerbaru->count() > 0)
                <div class="space-y-0">
                    @foreach ($fotoBerceritaTerbaru as $foto)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <div class="flex-1 min-w-0 mr-4">
                                <p class="text-lg font-medium truncate">{{ $foto->judul }}</p>
                                <p class="text-lg text-gray-400">{{ $foto->media_count }} item &middot; {{ $foto->created_at->format('d M Y') }} &middot; {{ number_format($foto->jumlah_dibaca ?? 0) }} dibaca</p>
                            </div>
                            <span class="text-lg font-bold px-3 py-1 shrink-0 {{ $foto->is_publik ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $foto->is_publik ? 'Publik' : 'Private' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-4">Belum ada foto bercerita.</p>
            @endif
            <div class="pt-4 mt-4 border-t border-gray-100">
                <a href="{{ route('penulis.foto-bercerita.index') }}" class="inline-block bg-primary text-white px-4 py-2 text-sm font-bold hover:bg-red-700 transition uppercase">
                    Kelolah Foto Bercerita
                </a>
            </div>
        </div>
    </div>
@endsection
