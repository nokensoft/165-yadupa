@extends('layouts.dashboard')
@section('title', 'Blog')
@section('page-title', 'Blog')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Blog',
        'createRoute' => route('penulis.blog.create'),
        'trashedRoute' => route('penulis.blog.index'),
        'columns' => ['Gambar', 'Judul', 'Kategori', 'Tanggal', 'Status', 'Dibaca'],
        'paginator' => $blog,
        'rows' => $blog->map(function ($b) {
            $media = $b->media;
            $publicUrl = (!$b->trashed() && $b->status === 'terbit' && !empty($b->slug))
                ? route('blog.detail', $b->slug)
                : null;
            if ($media && $media->tipe === 'foto' && $media->file_path && !str_starts_with($media->file_path, 'http')) {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="' . asset('storage/' . $media->file_path) . '" alt="' . e($b->judul) . '" class="w-16 h-12 object-cover border border-gray-200">'
                );
            } elseif ($b->gambar_url) {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="' . e($b->gambar_url) . '" alt="' . e($b->judul) . '" class="w-16 h-12 object-cover border border-gray-200">'
                );
            } else {
                $preview = new \Illuminate\Support\HtmlString(
                    '<span class="text-gray-300 text-xl"><i class="fas fa-newspaper"></i></span>'
                );
            }
            return [
                'cells' => [
                    $preview,
                    $b->judul,
                    $b->kategori?->nama ?? '-',
                    $b->created_at->format('d M Y'),
                    ucfirst($b->status),
                    new \Illuminate\Support\HtmlString(
                        '<span class="inline-flex items-center gap-1 text-gray-600"><i class="fas fa-eye text-lg"></i> ' . number_format($b->jumlah_dibaca ?? 0) . '</span>'
                    ),
                ],
                'viewRoute' => $publicUrl,
                'viewLabel' => 'Tampilkan Detail',
                'viewTarget' => '_blank',
                'copyUrl' => $publicUrl,
                'copyLabel' => 'Copy URL Publik',
                'copySuccessMessage' => 'URL publik blog berhasil disalin!',
                'editRoute' => $b->trashed() ? null : route('penulis.blog.edit', $b->id),
                'deleteRoute' => $b->trashed() ? null : route('penulis.blog.destroy', $b->id),
                'restoreRoute' => $b->trashed() ? route('penulis.blog.restore', $b->id) : null,
                'forceDeleteRoute' => $b->trashed() ? route('penulis.blog.force-delete', $b->id) : null,
                'trashed' => $b->trashed(),
            ];
        })->toArray(),
    ])
@endsection
