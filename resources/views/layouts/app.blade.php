<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'YADUPA | Yayasan Anak Dusun Papua')</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo-yadupa.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo-yadupa.png') }}">

    <link rel="preconnect"
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        'papua-brown': '#A0522D',
                        'papua-gold': '#FFD700',
                        'papua-red': '#D2691E',
                        'papua-black': '#1A1A1A'
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body class="bg-white font-sans antialiased text-gray-800 leading-relaxed overflow-x-hidden">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
