@php
    $waNumber = !empty($situs['sosmed_whatsapp']) ? preg_replace('/[^0-9]/', '', $situs['sosmed_whatsapp']) : null;
    $sessionUser = session('user');
    $footerAccountLabel = $sessionUser['name'] ?? 'Login';
    $footerAccountUrl = match ($sessionUser['role'] ?? null) {
        'admin_master' => route('admin.dashboard'),
        'penulis' => route('penulis.dashboard'),
        'operator' => route('operator.dashboard.index'),
        default => route('login'),
    };
@endphp
<div x-data="{ developmentInfoOpen: false }">

@if ($waNumber)
    <a href="https://wa.me/{{ $waNumber }}?text=Halo%20Disdikpora%20Teluk%20Wondama%2C%20saya%20ingin%20bertanya."
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat CS WhatsApp"
       class="fixed bottom-6 right-6 w-12 h-12 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg flex items-center justify-center transition z-50">
        <i class="fa-brands fa-whatsapp text-2xl"></i>
    </a>
@endif

<button id="btnTop"
        onclick="window.scrollTo({top:0,behavior:'smooth'})"
        class="fixed bottom-44 right-6 w-12 h-12 bg-primary-600 hover:bg-primary-700 text-white rounded-full shadow-lg flex items-center justify-center transition z-50 opacity-0 translate-y-4 pointer-events-none">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<div x-show="developmentInfoOpen"
     x-cloak
     @keydown.escape.window="developmentInfoOpen = false"
     class="fixed inset-0 z-[70] flex items-center justify-center p-4"
     x-transition.opacity>
    <div class="absolute inset-0 bg-black/50" @click="developmentInfoOpen = false"></div>
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden" x-transition.scale>
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-bold text-neutral-900">Informasi Website</h3>
            <button type="button"
                    @click="developmentInfoOpen = false"
                    class="text-gray-400 hover:text-gray-600 transition"
                    aria-label="Tutup modal informasi">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        <div class="px-6 py-5">
            <p class="text-neutral-700 leading-relaxed">
                Portal resmi layanan informasi dan data pendidikan Dinas Pendidikan, Pemuda dan Olahraga Kabupaten Teluk Wondama.
            </p>
            <p class="mt-4 text-sm text-neutral-500">
                Powered by
                <a href="https://nokensoft.com"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="text-primary-700 hover:text-primary-800 underline font-semibold">
                    Nokensoft.com
                </a>
            </p>
        </div>
        <div class="px-6 pb-6">
            <button type="button"
                    @click="developmentInfoOpen = false"
                    class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary-700 hover:bg-primary-800 text-white font-semibold rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<footer class="bg-primary-950 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('img/logo-tutwuri-handayani.webp') }}" alt="{{ $situs['nama_situs'] ?? 'Dinas Pendidikan, Pemuda, & Olahraga' }}" class="h-10 w-auto" />
                    <span class="text-lg font-bold text-white">{{ $situs['nama_situs'] ?? 'Dinas Pendidikan, Pemuda, & Olahraga' }}</span>
                </div>
                <p class="text-sm leading-relaxed mb-6">{{ $situs['deskripsi_situs'] ?? 'Portal resmi Dinas Pendidikan, Pemuda dan Olahraga Kabupaten Teluk Wondama.' }}</p>
                @if (!empty($situs['telepon']))
                    <p class="text-sm text-gray-400 mb-6"><i class="fa-solid fa-phone mr-2"></i> {{ $situs['telepon'] }}</p>
                @endif
                <div class="flex gap-3">
                    @if (!empty($situs['sosmed_facebook']))
                        <a href="{{ $situs['sosmed_facebook'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-white/10 hover:bg-primary-600 rounded-lg flex items-center justify-center transition"><i class="fa-brands fa-facebook-f text-sm"></i></a>
                    @endif
                    @if (!empty($situs['sosmed_instagram']))
                        <a href="{{ $situs['sosmed_instagram'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-white/10 hover:bg-primary-600 rounded-lg flex items-center justify-center transition"><i class="fa-brands fa-instagram text-sm"></i></a>
                    @endif
                    @if (!empty($situs['sosmed_twitter']))
                        <a href="{{ $situs['sosmed_twitter'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-white/10 hover:bg-primary-600 rounded-lg flex items-center justify-center transition"><i class="fa-brands fa-x-twitter text-sm"></i></a>
                    @endif
                    @if (!empty($situs['sosmed_youtube']))
                        <a href="{{ $situs['sosmed_youtube'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-white/10 hover:bg-primary-600 rounded-lg flex items-center justify-center transition"><i class="fa-brands fa-youtube text-sm"></i></a>
                    @endif
                    @if (!empty($situs['sosmed_tiktok']))
                        <a href="{{ $situs['sosmed_tiktok'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-white/10 hover:bg-primary-600 rounded-lg flex items-center justify-center transition"><i class="fa-brands fa-tiktok text-sm"></i></a>
                    @endif
                </div>
            </div>

           
            {{-- Footer information --}}
            <div>
                <h3 class="text-white font-bold text-base mb-4 tracking-wide">Informasi & Dokumentasi</h3>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('informasi.index', ['category' => 'Berita']) }}" 
                        class="transition inline-flex items-center gap-2 {{ request('category') === 'Berita' ? 'text-primary-400 font-semibold' : 'text-slate-300 hover:text-primary-400' }}">
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-60"></i>
                            <span>Berita</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('informasi.index', ['category' => 'Pengumuman']) }}" 
                        class="transition inline-flex items-center gap-2 {{ request('category') === 'Pengumuman' ? 'text-primary-400 font-semibold' : 'text-slate-300 hover:text-primary-400' }}">
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-60"></i>
                            <span>Pengumuman</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('informasi.index', ['category' => 'Agenda']) }}" 
                        class="transition inline-flex items-center gap-2 {{ request('category') === 'Agenda' ? 'text-primary-400 font-semibold' : 'text-slate-300 hover:text-primary-400' }}">
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-60"></i>
                            <span>Agenda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('informasi.index', ['category' => 'Infografis']) }}" 
                        class="transition inline-flex items-center gap-2 {{ request('category') === 'Infografis' ? 'text-primary-400 font-semibold' : 'text-slate-300 hover:text-primary-400' }}">
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-60"></i>
                            <span>Infografis</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('foto.index') }}" 
                        class="transition inline-flex items-center gap-2 {{ request()->routeIs('foto*') ? 'text-primary-400 font-semibold' : 'text-slate-300 hover:text-primary-400' }}">
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-60"></i>
                            <span>Galeri Foto</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('video.index') }}" 
                        class="transition inline-flex items-center gap-2 {{ request()->routeIs('video*') ? 'text-primary-400 font-semibold' : 'text-slate-300 hover:text-primary-400' }}">
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-60"></i>
                            <span>Galeri Video</span>
                        </a>
                    </li>
                </ul>
            </div>



            <div>
                <h4 class="text-white font-bold mb-4">Profil Dinas</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('profil.show', 'tentang-dinas') }}" class="hover:text-primary-400 transition">Tentang Dinas</a></li>
                    <li><a href="{{ route('profil.show', 'visi-dan-misi') }}" class="hover:text-primary-400 transition">Visi & Misi</a></li>
                    <li><a href="{{ route('profil.show', 'tugas-dan-fungsi') }}" class="hover:text-primary-400 transition">Tugas & Fungsi</a></li>
                    <li><a href="{{ route('profil.show', 'struktur-organisasi') }}" class="hover:text-primary-400 transition">Struktur Organisasi</a></li>
                    <li><a href="{{ route('profil.show', 'sumber-daya-manusia') }}" class="hover:text-primary-400 transition">Sumber Daya Manusia</a></li>
                    <li><a href="{{ route('profil.show', 'sarana-dan-prasarana') }}" class="hover:text-primary-400 transition">Sarana & Prasarana</a></li>
                    <li><a href="{{ route('profil.show', 'isu-isu-strategis') }}" class="hover:text-primary-400 transition">Isu-Isu Strategis</a></li>
                    <li><a href="{{ route('profil.show', 'tujuan-sasaran') }}" class="hover:text-primary-400 transition">Tujuan & Sasaran</a></li>
                    <li><a href="{{ route('profil.show', 'program-utama') }}" class="hover:text-primary-400 transition">Program Utama</a></li>
                </ul>
            </div>



            <div>
                <h4 class="text-white font-bold mb-4">Layanan Cepat</h4>
                <p class="text-sm mb-4">Butuh bantuan administrasi atau informasi seputar pendidikan di Teluk Wondama?</p>
                <a href="{{ route('kontak') }}" class="inline-flex items-center px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-full transition text-sm shadow-md">
                    <i class="fa-solid fa-headset mr-2"></i> Pusat Layanan
                </a>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} {{ $situs['nama_situs'] ?? 'Dinas Pendidikan, Pemuda, & Olahraga' }}. All rights reserved.</p>
            <div class="flex items-center gap-3">
                <a href="{{ $footerAccountUrl }}"
                   class="inline-flex items-center px-4 py-1.5 rounded-full border border-white/20 text-sm text-gray-200 hover:text-white hover:border-primary-400 hover:bg-white/10 transition">
                    <i class="fa-solid {{ $sessionUser ? 'fa-user' : 'fa-right-to-bracket' }} mr-2"></i>
                    <span>{{ $footerAccountLabel }}</span>
                </a>
                <p class="text-sm text-gray-400">Powered by <a href="https://nokensoft.com" target="_blank" class="text-primary-400 hover:text-primary-300 transition">Nokensoft.com</a></p>
            </div>
        </div>
    </div>
</footer>
</div>