<header x-data="{ mobileMenuOpen: false, scrolled: false, langOpen: false, currentLang: 'ID' }"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg py-4' : 'bg-transparent py-6'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-2xl overflow-hidden shadow-lg transform -rotate-6">
                <img src="{{ asset('img/logo-yadupa.png') }}" alt="YADUPA Logo" class="w-full h-full object-cover">
            </div>
            <span class="text-2xl font-black text-papua-brown uppercase tracking-tighter italic">YADUPA</span>
        </div>

        <div class="hidden md:flex items-center space-x-8 font-bold text-lg uppercase tracking-wider">
            <a href="{{ url('/') }}" class="text-papua-brown hover:text-papua-red transition">Beranda</a>
            <a href="#about" class="text-gray-500 hover:text-papua-brown transition">Tentang Kami</a>
            <a href="#impact" class="text-gray-500 hover:text-papua-brown transition">Dampak</a>
            <a href="#blog" class="text-gray-500 hover:text-papua-brown transition">Blog</a>
            <button class="bg-papua-gold text-papua-black px-6 py-2.5 rounded-full hover:shadow-xl transition transform hover:-translate-y-1 text-base">DUKUNG KAMI</button>

            {{-- Language Switcher --}}
            <div class="relative border-l border-gray-200 pl-8 ml-2">
                <button @click="langOpen = !langOpen" @click.away="langOpen = false" class="flex items-center space-x-2 text-gray-600 hover:text-papua-brown transition uppercase tracking-widest text-base font-black">
                    <span x-text="currentLang">ID</span>
                    <i class="fas fa-chevron-down text-xs transition-transform" :class="langOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="langOpen" x-cloak
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="absolute right-0 mt-4 w-32 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden py-2">
                    <button @click="currentLang = 'ID'; langOpen = false" class="w-full text-left px-6 py-2 hover:bg-gray-50 text-gray-700 font-bold">Bahasa</button>
                    <button @click="currentLang = 'EN'; langOpen = false" class="w-full text-left px-6 py-2 hover:bg-gray-50 text-gray-700 font-bold">English</button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu Toggle --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-3xl text-papua-brown">
            <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
        </button>
    </nav>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" x-transition x-cloak class="md:hidden bg-white border-t border-gray-100 px-6 py-8 space-y-6 shadow-2xl">
        <a href="{{ url('/') }}" class="block text-xl font-bold text-papua-brown">Beranda</a>
        <a href="#about" class="block text-xl font-bold text-gray-500">Tentang Kami</a>
        <a href="#blog" class="block text-xl font-bold text-gray-500">Blog</a>
        <div class="flex space-x-4 border-t border-gray-100 pt-6">
            <button class="text-papua-brown font-black uppercase">ID</button>
            <span class="text-gray-300">|</span>
            <button class="text-gray-400 font-black uppercase">EN</button>
        </div>
        <button class="w-full bg-papua-brown text-white py-4 rounded-2xl font-bold text-lg">DUKUNG KAMI</button>
    </div>
</header>
