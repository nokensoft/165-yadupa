<nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenu: false, openDropdown: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo & Brand -->
            <a href="{{ route('beranda') }}" class="flex items-center gap-3">
                <img src="{{ asset('img/logo-tutwuri-handayani.webp') }}" alt="{{ $situs['nama_situs'] ?? 'Dinas Pendidikan, Pemuda, & Olahraga' }}" class="h-12 w-auto" />
                <div>
                    <span class="text-lg font-bold text-primary-800 leading-tight block">{{ $situs['nama_situs'] ?? 'Dinas Pendidikan, Pemuda, & Olahraga' }}</span>
                    <span class="text-xs text-gray-500 leading-tight">Dinas Pendidikan, Pemuda, & Olahraga Kabupaten Teluk Wondama</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-1">
                <!-- Beranda -->
                <a href="{{ route('beranda') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('beranda') ? 'text-primary-700 bg-primary-50' : 'text-gray-700 hover:text-primary-700 hover:bg-primary-50 transition' }}">Beranda</a>

                
                <!-- Informasi (Dropdown dengan penanganan gap hover) -->
                <div class="relative py-2" 
                    @mouseenter="openDropdown = 'informasi'" 
                    @mouseleave="openDropdown = null">
                    
                    <button type="button"
                            class="px-3 py-2 rounded-md text-sm font-medium transition inline-flex items-center gap-1.5 {{ request()->routeIs('informasi.*') ? 'text-primary-700 bg-primary-50 font-semibold' : 'text-slate-700 hover:text-primary-700 hover:bg-primary-50' }}">
                        <span>Informasi</span>
                        <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                        :class="{ 'rotate-180': openDropdown === 'informasi' }"></i>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="openDropdown === 'informasi'" 
                        x-cloak 
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-0 top-full w-52 bg-white border border-slate-100 rounded-xl shadow-xl py-2 z-50">
                        
                        <a href="{{ route('informasi.index') }}" 
                        class="flex items-center justify-between px-4 py-2.5 text-sm transition {{ request()->routeIs('informasi.index') && !request('category') ? 'text-primary-700 bg-primary-50/80 font-semibold' : 'text-slate-700 hover:bg-slate-50 hover:text-primary-700' }}">
                            <span>Semua Informasi</span>
                            @if(request()->routeIs('informasi.index') && !request('category'))
                                <i class="fa-solid fa-check text-xs text-primary-600"></i>
                            @endif
                        </a>

                        <div class="my-1 border-t border-slate-100"></div>

                        <a href="{{ route('informasi.index', ['category' => 'Berita']) }}" 
                        class="flex items-center justify-between px-4 py-2.5 text-sm transition {{ request('category') === 'Berita' ? 'text-primary-700 bg-primary-50/80 font-semibold' : 'text-slate-700 hover:bg-slate-50 hover:text-primary-700' }}">
                            <span>Berita</span>
                            @if(request('category') === 'Berita')
                                <i class="fa-solid fa-check text-xs text-primary-600"></i>
                            @endif
                        </a>

                        <a href="{{ route('informasi.index', ['category' => 'Pengumuman']) }}" 
                        class="flex items-center justify-between px-4 py-2.5 text-sm transition {{ request('category') === 'Pengumuman' ? 'text-primary-700 bg-primary-50/80 font-semibold' : 'text-slate-700 hover:bg-slate-50 hover:text-primary-700' }}">
                            <span>Pengumuman</span>
                            @if(request('category') === 'Pengumuman')
                                <i class="fa-solid fa-check text-xs text-primary-600"></i>
                            @endif
                        </a>

                        <a href="{{ route('informasi.index', ['category' => 'Agenda']) }}" 
                        class="flex items-center justify-between px-4 py-2.5 text-sm transition {{ request('category') === 'Agenda' ? 'text-primary-700 bg-primary-50/80 font-semibold' : 'text-slate-700 hover:bg-slate-50 hover:text-primary-700' }}">
                            <span>Agenda</span>
                            @if(request('category') === 'Agenda')
                                <i class="fa-solid fa-check text-xs text-primary-600"></i>
                            @endif
                        </a>

                        <a href="{{ route('informasi.index', ['category' => 'Infografis']) }}" 
                        class="flex items-center justify-between px-4 py-2.5 text-sm transition {{ request('category') === 'Infografis' ? 'text-primary-700 bg-primary-50/80 font-semibold' : 'text-slate-700 hover:bg-slate-50 hover:text-primary-700' }}">
                            <span>Infografis</span>
                            @if(request('category') === 'Infografis')
                                <i class="fa-solid fa-check text-xs text-primary-600"></i>
                            @endif
                        </a>
                    </div>
                </div>



                <!-- Dokumentasi (Dropdown dengan penanganan gap hover) -->
                <div class="relative py-2" @mouseenter="openDropdown = 'dokumentasi'" @mouseleave="openDropdown = null">
                    <button class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-700 hover:bg-primary-50 transition inline-flex items-center gap-1">
                        Dokumentasi <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="openDropdown === 'dokumentasi'" x-cloak x-transition.origin.top class="absolute left-0 top-full w-48 bg-white border border-gray-100 rounded-lg shadow-lg py-2 z-50">
                        <a href="{{ route('foto.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Foto</a>
                        <a href="{{ route('video.index', 'video') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Video</a>
                    </div>
                </div>

                
                <!-- Profil (Dropdown) -->
                <div class="relative py-2" @mouseenter="openDropdown = 'profil'" @mouseleave="openDropdown = null">
                    <button class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-700 hover:bg-primary-50 transition inline-flex items-center gap-1">
                        Profil <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="openDropdown === 'profil'" x-cloak x-transition.origin.top class="absolute left-0 top-full w-64 bg-white border border-gray-100 rounded-lg shadow-lg py-2 z-50">
                        <a href="{{ route('profil.show', 'tentang-dinas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Tentang Dinas</a>
                        <a href="{{ route('profil.show', 'visi-dan-misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Visi dan Misi</a>
                        <a href="{{ route('profil.show', 'tugas-dan-fungsi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Tugas dan Fungsi</a>
                        <a href="{{ route('profil.show', 'struktur-organisasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Struktur Organisasi</a>
                        <a href="{{ route('profil.show', 'sumber-daya-manusia') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Sumber Daya Manusia</a>
                        <a href="{{ route('profil.show', 'sarana-dan-prasarana') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Sarana dan Prasarana</a>
                        <a href="{{ route('profil.show', 'isu-isu-strategis') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Isu-Isu Strategis</a>
                        <a href="{{ route('profil.show', 'tujuan-sasaran') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Tujuan & Sasaran</a>
                        <a href="{{ route('profil.show', 'program-utama') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Program Utama</a>
                    </div>
                </div>


                <!-- Layanan (Dropdown dengan penanganan gap hover) -->
                <div class="relative py-2" @mouseenter="openDropdown = 'layanan'" @mouseleave="openDropdown = null">
                    <button class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-primary-700 hover:bg-primary-50 transition inline-flex items-center gap-1">
                        Layanan <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="openDropdown === 'layanan'" x-cloak x-transition.origin.top class="absolute left-0 top-full w-48 bg-white border border-gray-100 rounded-lg shadow-lg py-2 z-50">
                        <a href="{{ route('layanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">Semua Layanan</a>
                        <a href="{{ route('layanan.sikora', 'sikora') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700">SIKORA</a>
                    </div>
                </div>

                <!-- Kontak Button -->
                <a href="{{ route('kontak') }}" class="ml-3 px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-full transition shadow-md"><i class="fa-solid fa-envelope mr-1"></i> Kontak</a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-gray-700 text-2xl">
                <i :class="mobileMenu ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="mobileMenu" x-cloak x-transition class="lg:hidden bg-white border-t shadow-lg">
        <div class="px-4 py-4 space-y-2" x-data="{ mobileSub: null }">
            <a href="{{ route('beranda') }}" class="block px-3 py-2 rounded-md font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-700">Beranda</a>

           <!-- Informasi Mobile -->
            <div>
                <button @click="mobileSub = mobileSub === 'inf' ? null : 'inf'" 
                        class="w-full flex justify-between items-center px-3 py-2 rounded-lg text-base font-medium transition {{ request()->routeIs('informasi.*') ? 'text-primary-700 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-slate-100 hover:text-primary-700' }}">
                    <span>Informasi</span> 
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" 
                    :class="{ 'rotate-180': mobileSub === 'inf' }"></i>
                </button>
                
                <div x-show="mobileSub === 'inf'" 
                    x-cloak 
                    x-collapse 
                    class="pl-3 space-y-1 mt-1 ml-2 border-l-2 border-primary-200">
                    
                    <a href="{{ route('informasi.index') }}" 
                    class="flex items-center justify-between px-3 py-2 text-sm rounded-md transition {{ request()->routeIs('informasi.index') && !request('category') ? 'text-primary-700 font-semibold bg-primary-50/60' : 'text-slate-600 hover:text-primary-700 hover:bg-slate-50' }}">
                        <span>Semua Informasi</span>
                        @if(request()->routeIs('informasi.index') && !request('category'))
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                        @endif
                    </a>

                    <a href="{{ route('informasi.index', ['category' => 'Berita']) }}" 
                    class="flex items-center justify-between px-3 py-2 text-sm rounded-md transition {{ request('category') === 'Berita' ? 'text-primary-700 font-semibold bg-primary-50/60' : 'text-slate-600 hover:text-primary-700 hover:bg-slate-50' }}">
                        <span>Berita</span>
                        @if(request('category') === 'Berita')
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                        @endif
                    </a>

                    <a href="{{ route('informasi.index', ['category' => 'Pengumuman']) }}" 
                    class="flex items-center justify-between px-3 py-2 text-sm rounded-md transition {{ request('category') === 'Pengumuman' ? 'text-primary-700 font-semibold bg-primary-50/60' : 'text-slate-600 hover:text-primary-700 hover:bg-slate-50' }}">
                        <span>Pengumuman</span>
                        @if(request('category') === 'Pengumuman')
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                        @endif
                    </a>

                    <a href="{{ route('informasi.index', ['category' => 'Agenda']) }}" 
                    class="flex items-center justify-between px-3 py-2 text-sm rounded-md transition {{ request('category') === 'Agenda' ? 'text-primary-700 font-semibold bg-primary-50/60' : 'text-slate-600 hover:text-primary-700 hover:bg-slate-50' }}">
                        <span>Agenda</span>
                        @if(request('category') === 'Agenda')
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                        @endif
                    </a>

                    <a href="{{ route('informasi.index', ['category' => 'Infografis']) }}" 
                    class="flex items-center justify-between px-3 py-2 text-sm rounded-md transition {{ request('category') === 'Infografis' ? 'text-primary-700 font-semibold bg-primary-50/60' : 'text-slate-600 hover:text-primary-700 hover:bg-slate-50' }}">
                        <span>Infografis</span>
                        @if(request('category') === 'Infografis')
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                        @endif
                    </a>
                </div>
            </div>


            <!-- Dokumentasi Mobile -->
            <div>
                <button @click="mobileSub = mobileSub === 'dok' ? null : 'dok'" class="w-full flex justify-between items-center px-3 py-2 rounded-md font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-700">
                    <span>Dokumentasi</span> <i class="fa-solid" :class="mobileSub === 'dok' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="mobileSub === 'dok'" class="pl-4 space-y-1 mt-1 border-l-2 border-primary-200">
                    <a href="{{ route('foto.index') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Foto</a>
                    <a href="{{ route('video.index') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Video</a>
                </div>
            </div>

            
            <!-- Profil Mobile (Statis) -->
            <div>
                <button @click="mobileSub = mobileSub === 'pro' ? null : 'pro'" class="w-full flex justify-between items-center px-3 py-2 rounded-md font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-700">
                    <span>Profil</span> 
                    <i class="fa-solid" :class="mobileSub === 'pro' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="mobileSub === 'pro'" x-cloak class="pl-4 space-y-1 mt-1 border-l-2 border-primary-200">
                    <a href="{{ route('profil.show', 'tentang-dinas') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Tentang Dinas</a>
                    <a href="{{ route('profil.show', 'visi-dan-misi') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Visi dan Misi</a>
                    <a href="{{ route('profil.show', 'tugas-dan-fungsi') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Tugas dan Fungsi</a>
                    <a href="{{ route('profil.show', 'struktur-organisasi') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Struktur Organisasi</a>
                    <a href="{{ route('profil.show', 'sumber-daya-manusia') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Sumber Daya Manusia</a>
                    <a href="{{ route('profil.show', 'sarana-dan-prasarana') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Sarana dan Prasarana</a>
                    <a href="{{ route('profil.show', 'isu-isu-strategis') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Isu-Isu Strategis</a>
                    <a href="{{ route('profil.show', 'tujuan-sasaran') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Tujuan & Sasaran</a>
                    <a href="{{ route('profil.show', 'program-utama') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Program Utama</a>
                </div>
            </div>



            <!-- Layanan Mobile -->
            <div>
                <button @click="mobileSub = mobileSub === 'lay' ? null : 'lay'" class="w-full flex justify-between items-center px-3 py-2 rounded-md font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-700">
                    <span>Layanan</span> <i class="fa-solid" :class="mobileSub === 'lay' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="mobileSub === 'lay'" class="pl-4 space-y-1 mt-1 border-l-2 border-primary-200">
                    <a href="{{ route('layanan') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">Semua Layanan</a>
                    <a href="{{ route('layanan.sikora') }}" class="block px-3 py-1.5 text-sm text-gray-600 hover:text-primary-700">SIKORA</a>
                </div>
            </div>

            <a href="{{ route('kontak') }}" class="block px-3 py-2 rounded-md font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-700">Kontak</a>
        </div>
    </div>
</nav>