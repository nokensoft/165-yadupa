@extends('layouts.visitor')

@section('title', $page->title . ' - ' . ($situs['nama_situs'] ?? 'YADUPA - Yayasan Anak Dusun Papua'))
@section('seo-title', $page->title . ' - YADUPA | Yayasan Anak Dusun Papua')
@section('seo-description', Str::limit(strip_tags($page->content), 155, '...') ?: ('Informasi mengenai ' . $page->title . ' pada situs resmi YADUPA.'))

@section('json-ld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('beranda')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => $page->title],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@push('styles')
<style>
    /* Styling konten dinamis dari database (pages.content), diselaraskan dengan tema YADUPA */
    .page-content p { margin-bottom: 1.25rem; line-height: 1.75; }
    .page-content h2 { font-size: 1.75rem; font-weight: 800; color: #1c1917; margin-top: 2rem; margin-bottom: 1rem; }
    .page-content h3 { font-size: 1.35rem; font-weight: 700; color: #292524; margin-top: 1.75rem; margin-bottom: 0.75rem; }
    .page-content h4 { font-size: 1.15rem; font-weight: 700; color: #44403c; margin-top: 1.5rem; margin-bottom: 0.5rem; }
    .page-content ul { list-style-type: disc; padding-left: 1.75rem; margin-top: 0.75rem; margin-bottom: 1.25rem; }
    .page-content ul ul { list-style-type: circle; margin-top: 0.35rem; margin-bottom: 0.35rem; padding-left: 1.5rem; }
    .page-content ul ul ul { list-style-type: square; }
    .page-content ol { list-style-type: decimal; padding-left: 1.75rem; margin-top: 0.75rem; margin-bottom: 1.25rem; }
    .page-content ol ol { list-style-type: lower-alpha; margin-top: 0.35rem; margin-bottom: 0.35rem; padding-left: 1.5rem; }
    .page-content li { margin-bottom: 0.4rem; line-height: 1.6; }
    .page-content blockquote { border-left: 4px solid #dc2626; background-color: #fafaf9; padding: 1rem 1.25rem; margin: 1.5rem 0; border-radius: 0 0.75rem 0.75rem 0; font-style: italic; color: #44403c; }
    .page-content table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; }
    .page-content th, .page-content td { border: 1px solid #e7e5e4; padding: 0.75rem 1rem; text-align: left; }
    .page-content th { background-color: #fafaf9; font-weight: 700; }
    .page-content a { color: #dc2626; text-decoration: underline; }
    .page-content a:hover { color: #b91c1c; }
    .page-content img { border-radius: 0.75rem; margin: 1rem 0; max-width: 100%; height: auto; }
</style>
@endpush

@section('content')

@include('partials.visitor.page-header', [
    'title' => $page->title,
    'breadcrumbs' => [['label' => $page->title]],
])

@if ($page->gambar)
    <div class="mb-10 rounded-2xl overflow-hidden border border-stone-200 shadow-sm aspect-video sm:aspect-[21/9] bg-stone-100">
        <img src="{{ $page->gambar }}" alt="{{ $page->title }}" class="w-full h-full object-cover">
    </div>
@endif

<div class="page-content text-stone-700 text-lg leading-relaxed max-w-4xl">
    {!! $page->content !!}
</div>

@endsection
