@extends('layouts.visitor')
@section('title', ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-description', ($situs['seo_meta_description'] ?? 'Lembaga Swadaya Masyarakat (LSM) yang mendapatkan mandat untuk bekerja sebagai penguatan Masyarakat Adat Papua, secara khusus Generasi Muda Papua.'))

@section('json-ld')
@php
$_bcHome = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('beranda')],
]];
$_f = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
@endphp
<script type="application/ld+json">{!! json_encode($_bcHome, $_f) !!}</script>
@endsection

@section('hero')
    @include('partials.visitor.hero')
@endsection

@section('content')

    @include('beranda.sections.informasi')
    @include('beranda.sections.foto')
    @include('beranda.sections.video')










 













    
    {{-- SEKILAS TENTANG YADUPA --}}
    <section id="tentang" class="py-20 bg-stone-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block px-4 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold mb-4">
                        <i class="fa-solid fa-people-group mr-1"></i> Siapa Kami
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-stone-900 mb-6">
                        Sekilas Tentang <span class="text-red-600">YADUPA</span>
                    </h2>
                    <p class="text-stone-600 mb-6 leading-relaxed">
                        <strong>Yayasan Anak Dusun Papua (YADUPA)</strong> adalah Lembaga Swadaya Masyarakat (LSM) yang mendapatkan mandat untuk bekerja sebagai penguatan Masyarakat Adat Papua, secara khusus Generasi Muda Papua.
                    </p>
                    <p class="text-stone-600 mb-8 leading-relaxed">
                        Melalui Rapat Kerja Dewan Adat Papua yang Pertama, Dewan Adat Papua memutuskan mendirikan organisasi guna penguatan Masyarakat Adat. Kesepakatan ini direalisasikan melalui Akta Notaris Nomor 17, di mana pada tanggal <strong>23 April 2003</strong> YADUPA resmi didirikan.
                    </p>

                    <div class="grid sm:grid-cols-2 gap-4 mb-8">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-landmark text-red-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-stone-900 text-sm">Kantor Pusat</h4>
                                <p class="text-xs text-stone-500">Distrik Abepura, Kota Jayapura, Papua</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-network-wired text-red-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-stone-900 text-sm">Kantor Cabang</h4>
                                <p class="text-xs text-stone-500">Yapen, Biak, Waropen, dan Yalimo</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('profil.tentang') }}" class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-semibold rounded-full hover:bg-red-700 transition shadow-md">
                            Profil Selengkapnya <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                        <a href="{{ route('profil.program-utama') }}" class="inline-flex items-center px-6 py-3 border-2 border-stone-300 text-stone-700 font-semibold rounded-full hover:border-red-600 hover:text-red-600 transition">
                            Yang Kami Lakukan
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-white rounded-2xl shadow-lg border border-stone-200 p-6">
                        <img src="{{ asset('bg2.jpeg') }}" alt="YADUPA" class="w-full rounded-lg object-cover shadow-sm h-64" />
                        <div class="mt-4 pt-4 border-t border-stone-100">
                            <h5 class="font-bold text-stone-900 text-sm mb-1"><i class="fa-solid fa-scale-balanced text-red-600 mr-2"></i> Dasar Pembentukan</h5>
                            <p class="text-xs text-stone-500 leading-relaxed">
                                Akta Notaris Nomor 17, tanggal 23 April 2003. Prinsip kerja: Kemandirian, Keadilan, Kebenaran, Demokrasi, dan Kesetaraan Gender.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>














@endsection
