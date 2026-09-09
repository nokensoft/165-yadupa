@extends('layouts.dashboard')
@section('title', 'Kategori Blog')
@section('page-title', 'Kategori Blog')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Kategori',
        'createRoute' => route('penulis.kategori-blog.create'),
        'trashedRoute' => route('penulis.kategori-blog.index'),
        'columns' => ['Nama Kategori', 'Slug', 'Jumlah Blog'],
        'paginator' => $kategori,
        'rows' => $kategori->map(fn ($k) => [
            'cells' => [$k->nama, $k->slug, $k->blog_count],
            'editRoute' => $k->trashed() ? null : route('penulis.kategori-blog.edit', $k->id),
            'deleteRoute' => $k->trashed() ? null : route('penulis.kategori-blog.destroy', $k->id),
            'restoreRoute' => $k->trashed() ? route('penulis.kategori-blog.restore', $k->id) : null,
            'forceDeleteRoute' => $k->trashed() ? route('penulis.kategori-blog.force-delete', $k->id) : null,
            'trashed' => $k->trashed(),
        ])->toArray(),
    ])
@endsection
