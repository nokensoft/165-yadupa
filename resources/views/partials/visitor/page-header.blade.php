@php
    /**
     * Header standar untuk halaman-dalam visitor.
     *
     * Contoh pemakaian:
     *   @include('partials.visitor.page-header', [
     *       'title'       => 'Kontak & Kolaborasi',
     *       'lead'        => 'Hubungi kami untuk kerja sama program.',
     *       'breadcrumbs' => [
     *           ['label' => 'Media', 'url' => route('informasi.index')],
     *           ['label' => 'Kontak'],
     *       ],
     *   ])
     *
     * @var string      $title       Judul halaman (wajib).
     * @var string|null $lead        Paragraf pengantar; boleh berisi HTML aman.
     * @var array       $breadcrumbs Daftar remah; item terakhir dirender non-tautan.
     *                               Tiap item: ['label' => string, 'url' => ?string].
     *                               Remah "Beranda" ditambahkan otomatis.
     */
    $title = $title ?? '';
    $lead = $lead ?? null;
    $breadcrumbs = $breadcrumbs ?? [['label' => $title]];
@endphp

<div class="mb-12">

    {{-- Breadcrumb minimalis --}}
    <nav aria-label="Breadcrumb" class="text-xs font-medium text-stone-500 mb-6 flex flex-wrap items-center gap-x-2 gap-y-1">
        <a href="{{ route('beranda') }}" class="hover:text-red-600 transition-colors">Beranda</a>

        @foreach ($breadcrumbs as $crumb)
            <span aria-hidden="true">/</span>

            @if (! empty($crumb['url']) && ! $loop->last)
                <a href="{{ $crumb['url'] }}" class="hover:text-red-600 transition-colors">{{ $crumb['label'] }}</a>
            @else
                <span class="text-stone-800" @if ($loop->last) aria-current="page" @endif>{{ $crumb['label'] }}</span>
            @endif
        @endforeach
    </nav>

    {{-- Judul halaman --}}
    <div class="w-16 h-1.5 bg-red-600 mb-4 rounded-full"></div>

    <h1 class="text-3xl md:text-5xl font-extrabold text-stone-900 tracking-tight">
        {{ $title }}
    </h1>

    @if ($lead)
        <p class="text-stone-600 mt-4 text-lg max-w-3xl leading-relaxed">{!! $lead !!}</p>
    @endif

</div>
