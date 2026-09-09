@extends('layouts.visitor')

@section('title', 'SIKORA - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', 'SIKORA - Sistem Informasi Pendidikan Disdikpora Kab. Teluk Wondama')
@section('seo-description', 'Portal resmi Sistem Informasi Pendidikan (SIKORA) Dinas Pendidikan, Pemuda, dan Olahraga Kabupaten Teluk Wondama.')

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
            'name' => 'Layanan',
            'item' => route('layanan')
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => 'SIKORA'
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')

{{-- Header Banner --}}
<section class="relative bg-gradient-to-br from-primary-800 via-primary-900 to-secondary-900 h-[160px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-secondary-400 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs uppercase font-extrabold tracking-widest text-red-400 block mb-1">Layanan Unggulan</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">SIKORA Teluk Wondama</h1>
    </div>
</section>

{{-- Section 1: Hero & Detail Penjelasan SIKORA --}}
<section class="py-12 sm:py-16 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            {{-- Visual Logo / Card --}}
            <div class="lg:col-span-5">
                <div class="bg-gray-50 rounded-2xl border border-gray-200 overflow-hidden shadow-sm p-4 group">
                    <div class="w-full aspect-square bg-slate-900 rounded-xl overflow-hidden relative mb-4">
                        <img 
                            src="{{ asset('img/layanan/logo-tutwuri-handayani.jpg') }}" 
                            alt="SIKORA - Sistem Informasi Pendidikan Disdikpora Teluk Wondama" 
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            loading="lazy"
                        />
                    </div>
                    <a 
                        href="https://sikora.wondamakab.go.id" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center justify-center gap-2 w-full px-5 py-3 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-xl transition shadow-sm"
                    >
                        <span>Akses Portal Utama SIKORA</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </a>
                </div>
            </div>

            
            {{-- Deskripsi & Fitur Utama --}}
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold text-red-600 uppercase tracking-wider mb-1 block">Sistem Informasi Pendidikan</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Mengenal SIKORA</h2>
                    <p class="mt-3 text-sm sm:text-base text-gray-600 leading-relaxed">
                        <strong class="text-gray-900">SIKORA (Sistem Informasi Pendidikan)</strong> merupakan platform digital terpadu yang dikembangkan khusus oleh Dinas Pendidikan, Pemuda, dan Olahraga Kabupaten Teluk Wondama untuk mewujudkan tata kelola data pendidikan yang transparan, akuntabel, dan terkoneksi secara real-time.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Pilar 1: Database Umum Setiap Jenjang --}}
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i class="fa-solid fa-layer-group text-red-600 text-lg mb-2 block"></i>
                        <h4 class="font-bold text-gray-900 text-sm mb-1">Database Setiap Jenjang</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">Penyimpanan dan pengelolaan data master terpadu untuk jenjang PAUD, SD, SMP, hingga Pendidikan Masyarakat.</p>
                    </div>

                    {{-- Pilar 2: Kondisi Sarana dan Prasarana --}}
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i class="fa-solid fa-building-circle-check text-red-600 text-lg mb-2 block"></i>
                        <h4 class="font-bold text-gray-900 text-sm mb-1">Kondisi Sarana & Prasarana</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">Pemetaan rinci tingkat kerusakan, ketersediaan ruang kelas, laboratorium, dan fasilitas fisik sekolah di seluruh distrik.</p>
                    </div>

                    {{-- Pilar 3: Distribusi Dana BOS --}}
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i class="fa-solid fa-hand-holding-dollar text-red-600 text-lg mb-2 block"></i>
                        <h4 class="font-bold text-gray-900 text-sm mb-1">Distribusi Dana BOS</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">Transparansi penyaluran, verifikasi penerima, serta pemantauan realisasi penggunaan Bantuan Operasional Sekolah.</p>
                    </div>

                    {{-- Pilar 4: Statistik Pendidikan Terpusat --}}
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i class="fa-solid fa-chart-pie text-red-600 text-lg mb-2 block"></i>
                        <h4 class="font-bold text-gray-900 text-sm mb-1">Statistik Terpusat Dinas</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">Pusat Dasbor Indikator Capaian Pendidikan untuk mendukung perumusan kebijakan strategis Disdikpora.</p>
                    </div>
                </div>
            </div>



        </div>
    </div>
</section>



{{-- Section 2: FAQ Khusus SIKORA (6 Rows) --}}
<section class="py-12 sm:py-16 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="text-xs font-extrabold text-red-600 uppercase tracking-widest block mb-2">Panduan & Bantuan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Pertanyaan Sering Diajukan Seputar SIKORA</h2>
            <p class="mt-2 text-sm text-gray-600">Informasi penting mengenai penggunaan, cakupan data, dan tata kelola portal SIKORA Teluk Wondama.</p>
        </div>

        <div x-data="{ active: 1 }" class="space-y-4">
            
            {{-- FAQ Row 1 --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition">
                <button 
                    @click="active = (active === 1 ? null : 1)" 
                    class="w-full text-left px-6 py-4 flex items-center justify-between font-bold text-gray-900 text-sm sm:text-base focus:outline-none"
                >
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-question text-red-600"></i>
                        1. Apa fungsi utama dari portal SIKORA Disdikpora Teluk Wondama?
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': active === 1 }"></i>
                </button>
                <div x-show="active === 1" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    SIKORA berfungsi sebagai pusat basis data terpadu untuk mengelola data master pendidikan per jenjang, pemetaan sarana prasarana sekolah, transparansi alokasi Dana BOS, serta penyediaan statistik pendidikan terpusat bagi YADUPA - Yayasan Anak Dusun Papua.
                </div>
            </div>

            {{-- FAQ Row 2 --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition">
                <button 
                    @click="active = (active === 2 ? null : 2)" 
                    class="w-full text-left px-6 py-4 flex items-center justify-between font-bold text-gray-900 text-sm sm:text-base focus:outline-none"
                >
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-question text-red-600"></i>
                        2. Jenjang pendidikan apa saja yang terdata di dalam SIKORA?
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': active === 2 }"></i>
                </button>
                <div x-show="active === 2" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    Database SIKORA mencakup seluruh satuan pendidikan di Kabupaten Teluk Wondama, mulai dari jenjang PAUD/TK, Sekolah Dasar (SD), Sekolah Menengah Pertama (SMP), hingga Lembaga Pendidikan Non-Formal/Masyarakat (PKBM).
                </div>
            </div>

            {{-- FAQ Row 3 --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition">
                <button 
                    @click="active = (active === 3 ? null : 3)" 
                    class="w-full text-left px-6 py-4 flex items-center justify-between font-bold text-gray-900 text-sm sm:text-base focus:outline-none"
                >
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-question text-red-600"></i>
                        3. Bagaimana SIKORA mengelola pemetaan sarana dan prasarana sekolah?
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': active === 3 }"></i>
                </button>
                <div x-show="active === 3" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    SIKORA mendata kondisi riil bangunan (baik, rusak ringan, sedang, maupun berat), ketersediaan ruang kelas, laboratorium, perpustakaan, serta kebutuhan alat penunjang belajar di setiap distrik sebagai acuan prioritas bantuan fisik dari dinas.
                </div>
            </div>

            {{-- FAQ Row 4 --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition">
                <button 
                    @click="active = (active === 4 ? null : 4)" 
                    class="w-full text-left px-6 py-4 flex items-center justify-between font-bold text-gray-900 text-sm sm:text-base focus:outline-none"
                >
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-question text-red-600"></i>
                        4. Bagaimana mekanisme pengawasan distribusi Dana BOS melalui SIKORA?
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': active === 4 }"></i>
                </button>
                <div x-show="active === 4" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    SIKORA menyediakan modul pemantauan alokasi, status penyaluran per gelombang, serta verifikasi laporan penggunaan Dana Bantuan Operasional Sekolah (BOS) dari tiap sekolah agar akuntabel dan tepat sasaran.
                </div>
            </div>

            {{-- FAQ Row 5 --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition">
                <button 
                    @click="active = (active === 5 ? null : 5)" 
                    class="w-full text-left px-6 py-4 flex items-center justify-between font-bold text-gray-900 text-sm sm:text-base focus:outline-none"
                >
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-question text-red-600"></i>
                        5. Siapa yang dapat mengakses data statistik pendidikan di SIKORA?
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': active === 5 }"></i>
                </button>
                <div x-show="active === 5" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    Statistik pendidikan terpusat disajikan secara agregat dan terbuka untuk publik, stakeholder, serta pimpinan dinas untuk membantu monitoring indikator capaian pendidikan daerah dan pengambilan keputusan berbasis data.
                </div>
            </div>

            {{-- FAQ Row 6 --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition">
                <button 
                    @click="active = (active === 6 ? null : 6)" 
                    class="w-full text-left px-6 py-4 flex items-center justify-between font-bold text-gray-900 text-sm sm:text-base focus:outline-none"
                >
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-question text-red-600"></i>
                        6. Bagaimana sekolah mengajukan pembaruan data atau kendala akun SIKORA?
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': active === 6 }"></i>
                </button>
                <div x-show="active === 6" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    Operator sekolah dapat mengajukan pembaruan data secara berkala melalu akun portal SIKORA atau menghubungi Tim Pengelola Data/Helpdesk Disdikpora Teluk Wondama untuk pemulihan akun dan konsultasi teknis.
                </div>
            </div>

        </div>
    </div>
</section>




@endsection