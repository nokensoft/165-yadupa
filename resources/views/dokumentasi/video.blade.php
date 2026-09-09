@extends('layouts.visitor')
@section('title', 'Dokumentasi Video - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', 'Dokumentasi Video - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-description', 'Dokumentasi video kegiatan dan informasi ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Video']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')

<section class="relative bg-gradient-to-br from-primary-800 via-primary-900 to-secondary-900 h-[150px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-secondary-400 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-5xl sm:text-6xl font-extrabold mb-4">Galeri Video</h1>
    </div>
</section>

<section class="py-12 bg-gray-50" x-data="{
    activeTab: 0,
    videos: [
        {
            id: 'giMHv_5JI7c',
            title: 'Ucapan Selamat Dan Sukses Dinas Pendidikan Pemuda Dan Olahraga',
            author: 'Protokol_KomPim Teluk Wondama',
        },
        {
            id: 'UmNuzUB80CI',
            title: 'Carnaval Dinas Pendididkan 2025',
            author: 'Daniel Torey',
        },
        {
            id: 'MV2XvewW0zs',
            title: 'Diskusi Site Visit Indonesia Mengajar, Tema Sasar Pendidikan Wondama',
            author: 'DISKOMINFO Kab. Teluk Wondama',
        },
        {
            id: 'cCeXmHejtNo',
            title: 'Peresmian SMA Negeri V Wondama',
            author: 'AituMieri Channel Wondama',
        },
    ]
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Kolom Kiri: Player Video Aktif (2 Spans di Desktop) --}}
            <div class="lg:col-span-2 bg-white rounded-none border border-gray-200 p-4 shadow-none">
                <div class="relative w-full overflow-hidden bg-black aspect-video">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full"
                        :src="'https://www.youtube.com/embed/' + videos[activeTab].id + '?autoplay=1'" 
                        :title="videos[activeTab].title"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="mt-4">
                    <div class="flex items-center gap-3 text-xs text-gray-500 font-medium mb-1">
                        <span x-text="videos[activeTab].author"></span>
                        {{-- <span>•</span> --}}
                        {{-- <span x-text="'Durasi: ' + videos[activeTab].duration"></span> --}}
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 leading-snug" x-text="videos[activeTab].title"></h2>
                </div>
            </div>

            {{-- Kolom Kanan: Sidebar Tab Judul Video --}}
            <div class="bg-white border border-gray-200 p-4">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200 uppercase tracking-wider">
                    Daftar Video
                </h3>

                <div class="flex flex-col gap-2 max-h-[480px] overflow-y-auto pr-1">
                    <template x-for="(video, index) in videos" :key="index">
                        <button 
                            @click="activeTab = index"
                            :class="activeTab === index 
                                ? 'bg-primary-900 text-white border-primary-900' 
                                : 'bg-gray-50 text-gray-700 hover:bg-gray-100 border-gray-200'"
                            class="w-full text-left p-3 border transition-all duration-150 flex items-start gap-3 group">
                            
                            {{-- Indicator Icon / Number --}}
                            <div class="flex-shrink-0 mt-0.5">
                                <template x-if="activeTab === index">
                                    <svg class="w-5 h-5 text-secondary-400 fill-current" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </template>
                                <template x-if="activeTab !== index">
                                    <span class="text-xs font-bold px-1.5 py-0.5 bg-gray-200 text-gray-600 rounded-none" x-text="index + 1"></span>
                                </template>
                            </div>

                            {{-- Title & Info --}}
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold line-clamp-2 leading-tight" x-text="video.title"></h4>
                                <span class="text-xs opacity-75 mt-1 block" x-text="video.duration"></span>
                            </div>
                        </button>
                    </template>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection