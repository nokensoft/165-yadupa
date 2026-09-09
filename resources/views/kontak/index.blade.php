@extends('layouts.visitor')

@section('title', 'Kontak & Kolaborasi - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', 'Kontak & Kolaborasi - YADUPA | Yayasan Anak Dusun Papua')
@section('seo-description', 'Hubungi Yayasan Anak Dusun Papua (YADUPA) untuk informasi lebih lanjut, kemitraan, atau kolaborasi dalam penguatan masyarakat adat dan pendidikan di Papua.')

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Kontak & Kolaborasi']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')

@include('partials.visitor.page-header', [
    'title' => 'Kontak & Kolaborasi',
    'lead' => 'Mari berkolaborasi untuk penguatan masyarakat adat Papua. Hubungi kantor pusat kami atau salah satu kantor cabang kami di wilayah Papua.',
    'breadcrumbs' => [['label' => 'Kontak & Kolaborasi']],
])

{{-- Kantor Pusat --}}
<div class="bg-white border border-stone-200 rounded-3xl p-8 shadow-sm mb-12">
    <div class="flex items-center gap-4 mb-6">
        <div class="bg-red-600 text-white p-4 rounded-2xl"><i class="fas fa-building text-2xl"></i></div>
        <h2 class="text-2xl font-bold text-stone-900">Kantor Pusat YADUPA</h2>
    </div>
    <div class="grid md:grid-cols-2 gap-8">
        <div>
            <p class="font-semibold text-stone-900 mb-1">Alamat</p>
            <p class="text-stone-600">{{ $situs['alamat'] ?? 'Jalan Pertambangan Nomor 178, Perumahan Silva Lestari Kotaraja Dalam, Kelurahan VIM, Distrik Abepura, Kota Jayapura.' }}</p>
        </div>
        <div>
            <p class="font-semibold text-stone-900 mb-1">Kontak</p>
            <p class="text-stone-600">Telepon: {{ $situs['telepon'] ?? '(0967) 584433' }}</p>
            <p class="text-stone-600">Email: <a href="mailto:{{ $situs['email'] ?? 'office@yadupa.org' }}" class="text-red-600 hover:underline">{{ $situs['email'] ?? 'office@yadupa.org' }}</a></p>
            <p class="text-stone-600">Website: <a href="{{ $situs['website'] ?? 'https://www.yadupa.org' }}" target="_blank" rel="noopener noreferrer" class="text-red-600 hover:underline">www.yadupa.org</a></p>
        </div>
    </div>
</div>

{{-- Kantor Cabang --}}
<h2 class="text-2xl font-bold text-stone-900 mb-8">Kantor Cabang</h2>
<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

    <div class="bg-white border border-stone-200 rounded-2xl p-6 shadow-sm">
        <h3 class="font-bold text-lg text-stone-900 mb-2">Kabupaten Yapen</h3>
        <p class="text-sm text-stone-600 mb-4">Jl. Anotaurei (sebelum Hotel Fardan), Distrik Anotaurei</p>
        <p class="text-sm font-semibold text-stone-800">Jeckson Yapanani</p>
        <p class="text-sm text-red-600">0852 5410 7290</p>
    </div>

    <div class="bg-white border border-stone-200 rounded-2xl p-6 shadow-sm">
        <h3 class="font-bold text-lg text-stone-900 mb-2">Kabupaten Biak</h3>
        <p class="text-sm text-stone-600 mb-4">Kompleks Mandiri Dalam (samping PLTD), Karang Mulia – Distrik Samofa</p>
        <p class="text-sm font-semibold text-stone-800">Agus Faknik</p>
        <p class="text-sm text-red-600">0823 9833 5470</p>
    </div>

    <div class="bg-white border border-stone-200 rounded-2xl p-6 shadow-sm">
        <h3 class="font-bold text-lg text-stone-900 mb-2">Kabupaten Waropen</h3>
        <p class="text-sm text-stone-600 mb-4">Jl. Sanggei Urfas, Distrik Sanggei</p>
        <p class="text-sm font-semibold text-stone-800">Jhon Imbiri</p>
        <p class="text-sm text-red-600">0812 4872 2292</p>
    </div>

    <div class="bg-white border border-stone-200 rounded-2xl p-6 shadow-sm">
        <h3 class="font-bold text-lg text-stone-900 mb-2">Kabupaten Yalimo</h3>
        <p class="text-sm text-stone-600 mb-4">Jl. Elelim, Distrik Elelim</p>
        <p class="text-sm font-semibold text-stone-800">Naam Mabel</p>
        <p class="text-sm text-red-600">0821 9952 7006</p>
    </div>

</div>

@endsection
