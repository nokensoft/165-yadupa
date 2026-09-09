<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $namaSitus = $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua';
    $deskripsiDefault = $situs['seo_meta_description']
        ?? 'Lembaga Swadaya Masyarakat (LSM) yang berdedikasi untuk penguatan masyarakat adat Papua dan memberikan akses pendidikan yang layak serta berkelanjutan bagi generasi muda di Tanah Papua.';

    // Halaman yang mendefinisikan @section('hero') mendapat navigasi transparan
    // saat berada di puncak halaman; halaman lain selalu memakai navigasi solid.
    $hasHero = View::hasSection('hero');
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags & SEO Optimization -->
    <title>@yield('title', $namaSitus . ' | Penguatan Masyarakat Adat & Pendidikan')</title>
    <meta name="title" content="@yield('seo-title', $namaSitus)">
    <meta name="description" content="@yield('seo-description', $deskripsiDefault)">
    <meta name="keywords" content="YADUPA, Yayasan Anak Dusun Papua, LSM Papua, Pendidikan Papua, Masyarakat Adat Papua, Anak Dusun Papua, Organisasi Papua">
    <meta name="author" content="Yayasan Anak Dusun Papua">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook / WhatsApp Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('seo-title', $namaSitus)">
    <meta property="og:description" content="@yield('seo-description', $deskripsiDefault)">
    <meta property="og:image" content="{{ asset('bg2.jpeg') }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('seo-title', $namaSitus)">
    <meta name="twitter:description" content="@yield('seo-description', $deskripsiDefault)">
    <meta name="twitter:image" content="{{ asset('bg2.jpeg') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo-yadupa-transparant.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-yadupa-transparant.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        /*
         * Palet YADUPA.
         * `stone` + `red` bawaan Tailwind adalah sumber kebenaran desain.
         * Alias di bawah memetakan nama palet warisan template lama
         * (primary/secondary/neutral/accent) ke palet YADUPA, sehingga halaman
         * yang belum sempat dirapikan tetap tampil dengan warna yang benar.
         */
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Aksen utama YADUPA (merah)
                        primary: {
                            50:'#fef2f2', 100:'#fee2e2', 200:'#fecaca', 300:'#fca5a5',
                            400:'#f87171', 500:'#ef4444', 600:'#dc2626', 700:'#b91c1c',
                            800:'#991b1b', 900:'#7f1d1d', 950:'#450a0a', DEFAULT:'#dc2626'
                        },
                        accent: {
                            50:'#fef2f2', 100:'#fee2e2', 200:'#fecaca', 300:'#fca5a5',
                            400:'#f87171', 500:'#ef4444', 600:'#dc2626', 700:'#b91c1c',
                            800:'#991b1b', 900:'#7f1d1d', DEFAULT:'#dc2626'
                        },
                        // Warna pendukung gelap (stone)
                        secondary: {
                            50:'#fafaf9', 100:'#f5f5f4', 200:'#e7e5e4', 300:'#d6d3d1',
                            400:'#a8a29e', 500:'#78716c', 600:'#57534e', 700:'#44403c',
                            800:'#292524', 900:'#1c1917', 950:'#0c0a09', DEFAULT:'#1c1917'
                        },
                        neutral: {
                            50:'#fafaf9', 100:'#f5f5f4', 200:'#e7e5e4', 300:'#d6d3d1',
                            400:'#a8a29e', 500:'#78716c', 600:'#57534e', 700:'#44403c',
                            800:'#292524', 900:'#1c1917', 950:'#0c0a09', DEFAULT:'#78716c'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        display: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Alpine.js CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        [x-cloak] { display: none !important; }
        /* Menjaga rasio gambar latar agar tidak melar */
        .hero-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>

    @yield('json-ld')
    @stack('styles')
</head>

<body class="antialiased bg-stone-50 text-stone-800 flex flex-col min-h-screen">

    @include('partials.visitor.navbar', ['hasHero' => $hasHero])

    @if ($hasHero)
        {{-- Halaman ber-hero mengatur spasi atasnya sendiri --}}
        @yield('hero')

        <main class="flex-grow">
            @yield('content')
        </main>
    @else
        {{-- Halaman dalam: kanvas standar dengan ruang untuk navigasi tetap --}}
        <main class="flex-grow pt-32 pb-20 px-6">
            <div class="container mx-auto max-w-6xl">
                @yield('content')
            </div>
        </main>
    @endif

    @include('partials.visitor.footer')

    @stack('scripts')
</body>
</html>
