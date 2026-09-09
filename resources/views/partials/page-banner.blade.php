<section class="relative bg-gradient-to-br from-primary-800 via-primary-900 to-secondary-900 py-16 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-secondary-400 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
        <h2 class="text-3xl lg:text-5xl font-extrabold">{{ $title }}</h2>
        <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2 text-sm text-gray-300">
                <a href="{{ route('beranda') }}" class="hover:text-white transition">Beranda</a>
                <i class="fa-solid fa-chevron-right text-xs"></i>
                <span class="text-white font-semibold">{!! $breadcrumb ?? e($title) !!}</span>
            </div>
            @if (!empty($rightAction))
                <div class="text-sm md:text-base">
                    {!! $rightAction !!}
                </div>
            @endif
        </div>
    </div>
</section>
