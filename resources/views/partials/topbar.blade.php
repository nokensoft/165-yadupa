<div class="bg-primary-900 text-white text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex flex-col sm:flex-row justify-between items-center gap-2">
        <div class="flex items-center gap-4">
            @if (!empty($situs['email']))
                <span><i class="fa-solid fa-envelope mr-1"></i> {{ $situs['email'] }}</span>
            @endif
            @if (!empty($situs['telepon']))
                <span><i class="fa-solid fa-phone mr-1"></i> {{ $situs['telepon'] }}</span>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex items-center gap-3 text-xs">
                <a href="{{ route('kontak') }}" class="hover:text-primary-300 transition font-medium">Kontak</a>
                <span class="text-white/30">|</span>
                <a href="{{ route('faq') }}" class="hover:text-primary-300 transition font-medium">FAQ</a>
                <span class="text-white/30">|</span>
                <a id="translate-link-id" href="#" onclick="setGoogleTranslateLanguage('id'); return false;" class="inline-flex items-center hover:text-primary-300 transition font-medium">
                    <span class="mr-1" aria-hidden="true">🇮🇩</span>ID
                </a>
                <span class="text-white/30">/</span>
                <a id="translate-link-en" href="#" onclick="setGoogleTranslateLanguage('en'); return false;" class="inline-flex items-center hover:text-primary-300 transition font-medium">
                    <span class="mr-1" aria-hidden="true">🇬🇧</span>EN
                </a>
            </div>
            <div class="flex items-center gap-3 sm:ml-4 sm:pl-4 sm:border-l sm:border-white/20">
                @if (!empty($situs['sosmed_facebook']))
                    <a href="{{ $situs['sosmed_facebook'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-primary-300 transition"><i class="fa-brands fa-facebook-f"></i></a>
                @endif
                @if (!empty($situs['sosmed_instagram']))
                    <a href="{{ $situs['sosmed_instagram'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-primary-300 transition"><i class="fa-brands fa-instagram"></i></a>
                @endif
                @if (!empty($situs['sosmed_twitter']))
                    <a href="{{ $situs['sosmed_twitter'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-primary-300 transition"><i class="fa-brands fa-x-twitter"></i></a>
                @endif
                @if (!empty($situs['sosmed_youtube']))
                    <a href="{{ $situs['sosmed_youtube'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-primary-300 transition"><i class="fa-brands fa-youtube"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="google_translate_element" class="hidden" aria-hidden="true"></div>

@once
    <style>
        body { top: 0 !important; }
        iframe.goog-te-banner-frame,
        .goog-te-banner-frame.skiptranslate,
        .goog-te-balloon-frame,
        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            display: none !important;
            visibility: hidden !important;
        }
        .goog-logo-link,
        .goog-te-gadget span,
        .goog-te-gadget-icon {
            display: none !important;
        }
        .goog-te-gadget {
            color: transparent !important;
            font-size: 0 !important;
        }
        #google_translate_element {
            display: none !important;
        }
    </style>

    <script>
        window.googleTranslateElementInit = function () {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en',
                autoDisplay: false
            }, 'google_translate_element');
        };
        window.getGoogleTranslateLanguage = function () {
            const googTransCookie = document.cookie
                .split('; ')
                .find((row) => row.startsWith('googtrans='));

            if (!googTransCookie) return 'id';

            const cookieValue = decodeURIComponent(googTransCookie.split('=').slice(1).join('='));
            const segments = cookieValue.split('/').filter(Boolean);
            const activeLanguage = segments[segments.length - 1];

            return activeLanguage === 'en' ? 'en' : 'id';
        };

        window.applyGoogleTranslateActiveStyle = function () {
            const idLink = document.getElementById('translate-link-id');
            const enLink = document.getElementById('translate-link-en');
            if (!idLink || !enLink) return;

            [idLink, enLink].forEach((link) => {
                link.classList.remove('text-primary-300', 'font-semibold', 'underline', 'underline-offset-2');
            });

            const activeLink = window.getGoogleTranslateLanguage() === 'en' ? enLink : idLink;
            activeLink.classList.add('text-primary-300', 'font-semibold', 'underline', 'underline-offset-2');
        };

        window.setGoogleTranslateLanguage = function (lang) {
            const cookieValue = '/id/' + lang;
            document.cookie = 'googtrans=' + cookieValue + ';path=/';
            document.cookie = 'googtrans=' + cookieValue + ';path=/;domain=' + window.location.hostname;
            window.applyGoogleTranslateActiveStyle();
            window.location.reload();
        };

        document.addEventListener('DOMContentLoaded', () => {
            window.applyGoogleTranslateActiveStyle();
        });
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endonce
