@php
    // Media sosial belum diaktifkan secara resmi oleh YADUPA; tautan hanya
    // dirender saat nilainya telah diisi melalui Pengaturan Situs.
    $sosial = collect([
        ['icon' => 'fab fa-instagram',  'label' => 'Instagram', 'url' => $situs['sosmed_instagram'] ?? null],
        ['icon' => 'fab fa-facebook-f', 'label' => 'Facebook',  'url' => $situs['sosmed_facebook'] ?? null],
        ['icon' => 'fab fa-whatsapp',   'label' => 'WhatsApp',  'url' => !empty($situs['sosmed_whatsapp']) ? 'https://wa.me/' . $situs['sosmed_whatsapp'] : null],
        ['icon' => 'fab fa-youtube',    'label' => 'YouTube',   'url' => $situs['sosmed_youtube'] ?? null],
    ])->filter(fn ($item) => !empty($item['url']));
@endphp

<footer class="bg-white border-t border-stone-200 mt-auto">

    {{-- Blok tautan --}}
    <div class="container mx-auto max-w-6xl px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- Identitas --}}
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('logo-yadupa-transparant.png') }}" alt="YADUPA Logo" class="h-12 w-auto">
                    <div>
                        <span class="block text-xl font-extrabold text-stone-900 leading-tight">YADUPA</span>
                        <span class="block text-xs font-medium text-stone-500 tracking-wider">Yayasan Anak Dusun Papua</span>
                    </div>
                </div>
                <div class="w-16 h-1.5 bg-red-600 mb-4 rounded-full"></div>
                <p class="text-sm text-stone-600 leading-relaxed max-w-md">
                    Lembaga Swadaya Masyarakat yang mendapatkan mandat untuk bekerja sebagai penguatan
                    Masyarakat Adat Papua, secara khusus Generasi Muda Papua.
                </p>
            </div>

            {{-- Navigasi --}}
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-stone-900 mb-4">Jelajahi</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('beranda') }}" class="text-stone-600 hover:text-red-600 transition-colors">Beranda</a></li>
                    <li><a href="{{ route('profil.tentang') }}" class="text-stone-600 hover:text-red-600 transition-colors">Sejarah &amp; Tujuan Pendirian</a></li>
                    <li><a href="{{ route('profil.prinsip-bidang-kerja') }}" class="text-stone-600 hover:text-red-600 transition-colors">Prinsip &amp; Bidang Kerja</a></li>
                    <li><a href="{{ route('profil.program-utama') }}" class="text-stone-600 hover:text-red-600 transition-colors">Yang Kami Lakukan</a></li>
                    <li><a href="{{ route('profil.mitra') }}" class="text-stone-600 hover:text-red-600 transition-colors">Mitra &amp; Jaringan</a></li>
                    <li><a href="{{ route('kontak') }}" class="text-stone-600 hover:text-red-600 transition-colors">Kontak &amp; Kolaborasi</a></li>
                </ul>
            </div>

            {{-- Informasi --}}
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-stone-900 mb-4">Informasi</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('informasi.index') }}" class="text-stone-600 hover:text-red-600 transition-colors">Berita &amp; Informasi</a></li>
                    <li><a href="{{ route('foto.index') }}" class="text-stone-600 hover:text-red-600 transition-colors">Galeri Foto</a></li>
                    <li><a href="{{ route('video.index') }}" class="text-stone-600 hover:text-red-600 transition-colors">Galeri Video</a></li>
                    <li><a href="{{ route('faq') }}" class="text-stone-600 hover:text-red-600 transition-colors">FAQ</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-stone-600 hover:text-red-600 transition-colors">Kebijakan Privasi</a></li>
                </ul>
            </div>

        </div>
    </div>

    {{-- Blok bawah --}}
    <div class="border-t border-stone-200">
        <div class="container mx-auto max-w-6xl px-6 py-8">
            <div class="flex flex-col items-center justify-center text-xs text-stone-500 gap-4">

                {{-- Media Sosial --}}
                @if ($sosial->isNotEmpty())
                <div class="flex items-center justify-center space-x-3 text-base">
                    @foreach ($sosial as $item)
                        <a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer"
                           class="w-10 h-10 bg-stone-100 hover:bg-red-600 hover:text-white text-stone-700 rounded-full flex items-center justify-center transition-colors duration-300"
                           aria-label="{{ $item['label'] }}">
                            <i class="{{ $item['icon'] }}"></i>
                        </a>
                    @endforeach
                </div>
                @endif

                {{-- Copyright --}}
                <div class="flex flex-col items-center justify-center gap-2 text-center">
                    <p>&copy; {{ date('Y') }} YADUPA (Yayasan Anak Dusun Papua). Hak Cipta Dilindungi.</p>
                    <p>
                        Powered by
                        <a href="https://nokensoft.com" target="_blank" rel="noopener noreferrer"
                           class="text-red-600 font-semibold hover:underline">
                            Nokensoft.com
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>

</footer>
