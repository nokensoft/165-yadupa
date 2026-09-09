@extends('layouts.dashboard')
@section('title', 'Foto Bercerita')
@section('page-title', 'Foto Bercerita')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Foto Bercerita',
        'createRoute' => route('penulis.foto-bercerita.create'),
        'trashedRoute' => route('penulis.foto-bercerita.index'),
        'columns' => ['Cover', 'Judul Cerita', 'Jumlah Item Foto', 'Total Pembaca', 'Publik', 'Tanggal'],
        'paginator' => $galeri,
        'rows' => $galeri->map(function ($g) {
            $cover = $g->coverMedia ?: $g->media->first();
            $publicUrl = (!$g->trashed() && $g->is_publik && !empty($g->slug))
                ? route('foto-bercerita.detail', $g->slug)
                : null;
            if ($cover && $cover->tipe === 'video') {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="https://img.youtube.com/vi/' . e($cover->file_name) . '/default.jpg" alt="' . e($g->judul) . '" class="w-20 object-cover border border-gray-200" style="aspect-ratio: 1720 / 1080;" onerror="this.outerHTML=\'<span class=&quot;text-gray-400 text-xl&quot;><i class=&quot;fab fa-youtube&quot;></i></span>\'">' .
                    '<span class="absolute bottom-0 right-0 bg-red-600 text-white text-lg px-1"><i class="fab fa-youtube"></i></span>'
                );
            } elseif ($cover && $cover->file_path && !str_starts_with($cover->file_path, 'http')) {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="' . asset('storage/' . $cover->file_path) . '" alt="' . e($g->judul) . '" class="w-20 object-cover border border-gray-200" style="aspect-ratio: 1720 / 1080;">'
                );
            } else {
                $preview = new \Illuminate\Support\HtmlString(
                    '<span class="text-gray-300 text-xl"><i class="fas fa-images"></i></span>'
                );
            }

            if ($g->trashed()) {
                $publikCell = new \Illuminate\Support\HtmlString(
                    '<span class="text-gray-300"><i class="fas fa-minus text-lg"></i></span>'
                );
            } else {
                $publikCell = new \Illuminate\Support\HtmlString(
                    '<form action="' . route('penulis.foto-bercerita.toggle-publik', $g->id) . '" method="POST" class="inline">' .
                    csrf_field() . method_field('PATCH') .
                    '<button type="submit" title="' . ($g->is_publik ? 'Sembunyikan dari publik' : 'Tampilkan di publik') . '"' .
                    ' class="inline-flex items-center justify-center w-8 h-8 transition ' .
                    ($g->is_publik ? 'bg-green-50 text-green-600 hover:bg-green-100' : 'bg-gray-100 text-gray-400 hover:bg-gray-200') . '">' .
                    '<i class="fas ' . ($g->is_publik ? 'fa-eye' : 'fa-eye-slash') . ' text-lg"></i>' .
                    '</button></form>'
                );
            }

            return [
                'cells' => [
                    $preview,
                    $g->judul,
                    $g->media_count . ' item',
                    number_format($g->jumlah_dibaca ?? 0) . ' dibaca',
                    $publikCell,
                    $g->created_at->format('d M Y'),
                ],
                'viewRoute' => $publicUrl,
                'viewLabel' => 'Tampilkan Detail',
                'viewTarget' => '_blank',
                'copyUrl' => $publicUrl,
                'copyLabel' => 'Copy URL Publik',
                'copySuccessMessage' => 'URL publik foto bercerita berhasil disalin!',
                'editRoute' => $g->trashed() ? null : route('penulis.foto-bercerita.edit', $g->id),
                'deleteRoute' => $g->trashed() ? null : route('penulis.foto-bercerita.destroy', $g->id),
                'restoreRoute' => $g->trashed() ? route('penulis.foto-bercerita.restore', $g->id) : null,
                'forceDeleteRoute' => $g->trashed() ? route('penulis.foto-bercerita.force-delete', $g->id) : null,
                'trashed' => $g->trashed(),
            ];
        })->toArray(),
    ])
@endsection
