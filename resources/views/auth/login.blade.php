<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua' }}</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Standard Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo-yadupa-transparant.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-yadupa-transparant.png') }}">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    primary: { 50:'#fef2f2', 100:'#fee2e2', 200:'#fecaca', 300:'#fca5a5', 400:'#f87171', 500:'#ef4444', 600:'#dc2626', 700:'#b91c1c', 800:'#991b1b', 900:'#7f1d1d', 950:'#450a0a', DEFAULT:'#dc2626' },
                },
                fontFamily: {
                    sans: ['Inter','ui-sans-serif','system-ui','sans-serif'],
                    display: ['Inter','ui-sans-serif','system-ui','sans-serif']
                }
            }}
        }
    </script>
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-stone-50 min-h-screen flex items-center justify-center font-sans text-base p-4">

    <div class="w-full max-w-sm">
        {{-- Logo & Header --}}
        <div class="text-center mb-8">
            <img src="{{ asset('logo-yadupa-transparant.png') }}" alt="{{ $situs['nama_situs'] ?? 'YADUPA' }}" class="h-14 w-auto shrink-0 mx-auto">
            <h1 class="text-xl font-bold text-stone-900 tracking-tight mt-3">{{ $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua' }}</h1>
            <p class="text-stone-500 text-sm mt-1">Gunakan email dan password untuk akses Admin Panel</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white p-8 border border-gray-100 shadow-sm rounded-2xl">
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl mb-6 text-sm flex items-center">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wider text-gray-600 block mb-2">Email</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-3.5 pl-11 text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition"
                               placeholder="nama@domain.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-xs font-semibold uppercase tracking-wider text-gray-600 block mb-2">Password</label>
                    <div class="relative" x-data="{ show: false }">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-lock"></i></span>
                        <input :type="show ? 'text' : 'password'" name="password" required
                               class="w-full bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-3.5 pl-11 pr-11 text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition"
                               placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-sm">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-primary text-white py-3.5 rounded-xl font-medium hover:bg-primary/90 focus:ring-4 focus:ring-primary/20 transition text-sm shadow-sm">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('beranda') }}" class="text-sm text-gray-500 hover:text-gray-800 transition inline-flex items-center">
                    <i class="fas fa-arrow-left mr-1.5"></i> Kembali ke Website
                </a>
            </div>
        </div>

        {{-- Footer Copyright --}}
        <p class="text-center text-xs text-stone-400 mt-8">
            &copy; {{ date('Y') }} {{ $situs['nama_situs'] ?? 'YADUPA (Yayasan Anak Dusun Papua)' }}. Hak Cipta Dilindungi.
        </p>
        <p class="text-center text-xs text-stone-400 mt-2">
            Powered by <a href="https://nokensoft.com" target="_blank" class="font-bold hover:underline">Nokensoft.com</a>
        </p>
    </div>

</body>
</html>