<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ $situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <!-- Standard Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo-yadupa-transparant.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-yadupa-transparant.png') }}">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        /*
         * Palet YADUPA — selaras dengan layouts/visitor.blade.php.
         * `primary` memakai skala merah YADUPA, `neutral` memakai skala stone.
         */
        tailwind.config = {
            theme: { extend: {
                colors: {
                    primary: { 50:'#fef2f2', 100:'#fee2e2', 200:'#fecaca', 300:'#fca5a5', 400:'#f87171', 500:'#ef4444', 600:'#dc2626', 700:'#b91c1c', 800:'#991b1b', 900:'#7f1d1d', 950:'#450a0a', DEFAULT:'#dc2626' },
                    accent:  { 50:'#fef2f2', 100:'#fee2e2', 200:'#fecaca', 300:'#fca5a5', 400:'#f87171', 500:'#ef4444', 600:'#dc2626', 700:'#b91c1c', 800:'#991b1b', 900:'#7f1d1d', DEFAULT:'#dc2626' },
                    neutral: { 50:'#fafaf9', 100:'#f5f5f4', 200:'#e7e5e4', 300:'#d6d3d1', 400:'#a8a29e', 500:'#78716c', 600:'#57534e', 700:'#44403c', 800:'#292524', 900:'#1c1917', 950:'#0c0a09' },
                    dark: '#1c1917'
                },
                fontFamily: {
                    display: ['Inter','ui-sans-serif','system-ui','sans-serif'],
                    sans: ['Inter','ui-sans-serif','system-ui','sans-serif']
                },
                boxShadow: {
                    'card': '0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03)',
                    'card-hover': '0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03)'
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
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        [x-cloak] { display: none !important; }
        .no-round { border-radius: 0.75rem; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        /* Editor konten (TinyMCE) di-skin lewat opsi `content_style` saat inisialisasi
           JS pada masing-masing form (area edit TinyMCE berjalan di dalam iframe,
           sehingga tidak bisa ditata lewat CSS halaman ini). */
        .tox-tinymce { border-radius: 0.75rem !important; overflow: hidden; }
    </style>
</head>
<body class="bg-stone-50 text-stone-700 font-sans text-sm" x-data="{ sidebarOpen: true, mobileSidebar: false }">

    {{-- Page Loading --}}
    {{-- @include('partials.page-loading') --}}

    <div class="flex min-h-screen">

        {{-- Sidebar Overlay (Mobile) --}}
        <div x-show="mobileSidebar" @click="mobileSidebar = false"
             class="fixed inset-0 bg-black/40 backdrop-blur-xs z-40 lg:hidden" x-transition.opacity></div>

        {{-- Sidebar --}}
        <aside :class="[mobileSidebar ? 'translate-x-0' : '-translate-x-full', sidebarOpen ? 'lg:translate-x-0' : 'lg:-translate-x-full']"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-white text-stone-700 border-r border-stone-100 shadow-xs flex flex-col transition-transform duration-300">

            {{-- Logo --}}
            <div class="px-6 py-5 border-b border-stone-100 flex items-center space-x-3">
                <img src="{{ asset('logo-yadupa-transparant.png') }}" alt="{{ $situs['nama_situs'] ?? 'YADUPA' }}" class="h-10 w-auto shrink-0">
                <div class="overflow-hidden">
                    <span class="block text-sm font-extrabold text-stone-900 leading-tight">YADUPA</span>
                    <span class="text-[11px] font-semibold tracking-wider uppercase text-stone-400 block">Halo,
                        {{ match(session('user.role')) { 'admin_master' => 'Admin', 'operator' => 'Operator', default => 'Penulis' } }}</span>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto py-5 px-3 space-y-6">
                @php $user = session('user'); @endphp

                @if ($user && $user['role'] === 'admin_master')
                    {{-- Admin Master Menu --}}
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Utama</p>
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-tachometer-alt w-5 text-center text-xs"></i>
                            <span>Dasbor</span>
                        </a>
                        <a href="{{ route('beranda') }}" target="_blank"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition text-stone-600 hover:bg-stone-50 hover:text-stone-900">
                            <i class="fas fa-globe w-5 text-center text-xs"></i>
                            <span>Lihat Website</span>
                            <i class="fas fa-external-link-alt text-xs ml-auto opacity-40"></i>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Konten</p>
                        <a href="{{ route('admin.halaman.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.halaman.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-file-alt w-5 text-center text-xs"></i>
                            <span>Halaman</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Pengaturan</p>
                        <a href="{{ route('admin.pengaturan-situs') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.pengaturan-situs') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-cog w-5 text-center text-xs"></i>
                            <span>Pengaturan Situs</span>
                        </a>
                        <a href="{{ route('admin.backup-database') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.backup-database') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-database w-5 text-center text-xs"></i>
                            <span>Backup Database</span>
                        </a>
                        <a href="{{ route('admin.backup-storage') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.backup-storage') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-folder-open w-5 text-center text-xs"></i>
                            <span>Backup Storage</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Pengguna</p>
                        <a href="{{ route('admin.pengguna.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.pengguna.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-users w-5 text-center text-xs"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                        <a href="{{ route('admin.aktivitas-login') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.aktivitas-login') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-history w-5 text-center text-xs"></i>
                            <span>Aktivitas Login</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Laporan</p>
                        <a href="{{ route('admin.statistik-pengunjung') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.statistik-pengunjung') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-chart-bar w-5 text-center text-xs"></i>
                            <span>Statistik Pengunjung</span>
                        </a>
                    </div>
                @endif

                @if ($user && $user['role'] === 'penulis')
                    {{-- Penulis Menu --}}
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Utama</p>
                        <a href="{{ route('penulis.dashboard') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('penulis.dashboard') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-tachometer-alt w-5 text-center text-xs"></i>
                            <span>Dasbor</span>
                        </a>
                        <a href="{{ route('beranda') }}" target="_blank"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition text-stone-600 hover:bg-stone-50 hover:text-stone-900">
                            <i class="fas fa-globe w-5 text-center text-xs"></i>
                            <span>Lihat Website</span>
                            <i class="fas fa-external-link-alt text-xs ml-auto opacity-40"></i>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Blog</p>
                        <a href="{{ route('penulis.blog.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('penulis.blog.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-newspaper w-5 text-center text-xs"></i>
                            <span>Blog</span>
                        </a>
                        <a href="{{ route('penulis.kategori-blog.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('penulis.kategori-blog.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-tags w-5 text-center text-xs"></i>
                            <span>Kategori Blog</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Media</p>
                        <a href="{{ route('penulis.media.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('penulis.media.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-photo-video w-5 text-center text-xs"></i>
                            <span>Media</span>
                        </a>
                        <a href="{{ route('penulis.foto-bercerita.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('penulis.foto-bercerita.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-images w-5 text-center text-xs"></i>
                            <span>Foto Bercerita</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Laporan</p>
                        <a href="{{ route('penulis.statistik-pengunjung') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('penulis.statistik-pengunjung') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-chart-bar w-5 text-center text-xs"></i>
                            <span>Statistik Pengunjung</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Pengguna</p>
                        <a href="{{ route('penulis.aktivitas-login') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('penulis.aktivitas-login') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-history w-5 text-center text-xs"></i>
                            <span>Aktivitas Login</span>
                        </a>
                    </div>
                @endif

                @if ($user && $user['role'] === 'operator')
                    {{-- Operator Menu --}}
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Utama</p>
                        <a href="{{ route('operator.dashboard.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.dashboard.index') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-tachometer-alt w-5 text-center text-xs"></i>
                            <span>Dasbor</span>
                        </a>
                        <a href="{{ route('beranda') }}" target="_blank"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition text-stone-600 hover:bg-stone-50 hover:text-stone-900">
                            <i class="fas fa-globe w-5 text-center text-xs"></i>
                            <span>Lihat Website</span>
                            <i class="fas fa-external-link-alt text-xs ml-auto opacity-40"></i>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Blog</p>
                        <a href="{{ route('operator.berita.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.berita.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-newspaper w-5 text-center text-xs"></i>
                            <span>Berita</span>
                        </a>
                        <a href="{{ route('operator.pengumuman.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.pengumuman.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-bullhorn w-5 text-center text-xs"></i>
                            <span>Pengumuman</span>
                        </a>
                        <a href="{{ route('operator.agenda.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.agenda.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-calendar-days w-5 text-center text-xs"></i>
                            <span>Agenda</span>
                        </a>
                        <a href="{{ route('operator.infografis.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.infografis.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-chart-simple w-5 text-center text-xs"></i>
                            <span>Infografis</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Konten</p>
                        <a href="{{ route('operator.hero.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.hero.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-panorama w-5 text-center text-xs"></i>
                            <span>Hero Beranda</span>
                        </a>
                        <a href="{{ route('operator.pages.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.pages.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-file-alt w-5 text-center text-xs"></i>
                            <span>Halaman</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Media</p>
                        <a href="{{ route('operator.foto.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.foto.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-images w-5 text-center text-xs"></i>
                            <span>Foto</span>
                        </a>
                        <a href="{{ route('operator.video.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.video.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-video w-5 text-center text-xs"></i>
                            <span>Video</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400 mb-2 px-3">Pengaturan</p>
                        <a href="{{ route('operator.pengaturan-situs.edit') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('operator.pengaturan-situs.*') ? 'bg-primary text-white shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-stone-900' }}">
                            <i class="fas fa-sliders w-5 text-center text-xs"></i>
                            <span>Pengaturan Situs</span>
                        </a>
                    </div>
                @endif
            </nav>

        </aside>

        {{-- Main Area --}}
        <div :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-0'" class="flex-1 flex flex-col min-w-0 transition-all duration-300">

            {{-- Top Bar --}}
            <header class="bg-white/80 backdrop-blur-md border-b border-stone-100 px-6 py-3.5 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center space-x-4">
                    <button @click="mobileSidebar = !mobileSidebar" class="lg:hidden text-lg text-stone-600">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="hidden lg:inline-flex items-center justify-center h-9 w-9 border border-stone-200 rounded-xl text-stone-500 hover:bg-stone-50 transition"
                            :title="sidebarOpen ? 'Sembunyikan sidebar' : 'Tampilkan sidebar'">
                        <i class="fas text-xs" :class="sidebarOpen ? 'fa-angles-left' : 'fa-angles-right'"></i>
                    </button>
                    <h1 class="text-base font-bold text-stone-900">@yield('page-title', 'Dashboard')</h1>
                </div>
                @php
                    $dashPrefix = match(session('user.role')) {
                        'admin_master' => 'admin',
                        'operator' => 'operator',
                        default => 'penulis',
                    };
                @endphp
                <div class="flex items-center space-x-4" x-data="{ profileOpen: false }">
                    <div class="relative">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-3 cursor-pointer select-none group">
                            <div class="text-right hidden sm:block">
                                <p class="text-xs font-semibold text-stone-800 group-hover:text-primary transition">{{ session('user.name', 'User') }}</p>
                                <p class="text-[11px] text-stone-400 capitalize">{{ str_replace('_', ' ', session('user.role', '')) }}</p>
                            </div>
                            <div class="w-9 h-9 bg-primary/10 text-primary rounded-xl flex items-center justify-center font-bold text-sm border border-primary/20">
                                {{ strtoupper(substr(session('user.name', 'U'), 0, 1)) }}
                            </div>
                            <i class="fas fa-chevron-down text-xs text-stone-400 transition-transform duration-200" :class="profileOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="profileOpen" @click.outside="profileOpen = false" x-transition style="display:none;"
                             class="absolute right-0 top-full mt-2 w-48 bg-white border border-stone-100 rounded-2xl shadow-lg z-50 overflow-hidden py-1">
                            <div class="px-4 py-3 border-b border-stone-50">
                                <p class="text-xs font-bold text-stone-900 truncate">{{ session('user.name', 'User') }}</p>
                                <p class="text-[11px] text-stone-400 truncate mt-0.5">{{ session('user.email', '') }}</p>
                            </div>
                            @if (Route::has("{$dashPrefix}.profil"))
                            <a href="{{ route("{$dashPrefix}.profil") }}"
                               class="w-full flex items-center gap-2.5 px-4 py-2.5 hover:bg-stone-50 transition-colors text-left text-stone-600 text-xs font-medium">
                                <i class="fas fa-user-pen w-4 text-center text-stone-400"></i> Edit Profil
                            </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-2.5 px-4 py-2.5 hover:bg-red-50 hover:text-red-600 transition-colors text-left text-stone-600 text-xs font-medium border-t border-stone-50">
                                    <i class="fas fa-sign-out-alt w-4 text-center text-stone-400"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-6">
                <x-flash-alert />

                @yield('content')
            </main>

            {{-- Footer --}}
            @php
                $disclaimerPage = $halamanFooter->firstWhere('slug', 'disclaimer');
            @endphp
            <footer class="bg-white border-t border-stone-100 px-6 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-stone-400">
                    <p>&copy; {{ date('Y') }} {{ $situs['nama_situs'] ?? 'YADUPA (Yayasan Anak Dusun Papua)' }}. Hak Cipta Dilindungi.</p>
                    <div class="flex items-center gap-3">
                        @if (Route::has("{$dashPrefix}.dokumentasi"))
                        <a href="{{ route("{$dashPrefix}.dokumentasi") }}" class="hover:text-stone-700 transition-colors">Dokumentasi</a>
                        <span class="text-stone-200">|</span>
                        @endif
                        <a href="{{ route('faq') }}" target="_blank" class="hover:text-stone-700 transition-colors">FAQ</a>
                        @if ($disclaimerPage)
                            <span class="text-stone-200">|</span>
                            <a href="{{ route('disclaimer') }}" target="_blank" class="hover:text-stone-700 transition-colors">Disclaimer</a>
                        @endif
                        <span class="text-stone-200">|</span>
                        <a href="{{ route('peta-situs') }}" target="_blank" class="hover:text-stone-700 transition-colors">Site Map</a>
                    </div>
                </div>
            </footer>

        </div>

    </div>

<x-confirm-modal />
<x-toast-notification />
@stack('scripts')
</body>
</html>