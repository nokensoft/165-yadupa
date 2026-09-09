@extends('layouts.dashboard')
@section('title', 'Foto')
@section('page-title', 'Foto')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Foto',
        'createRoute' => route('operator.foto.create'),
        'trashedRoute' => route('operator.foto.index'),
        'columns' => ['Gambar', 'Judul', 'Kategori', 'Status'],
        'paginator' => $photos,
        'rows' => $photos->map(fn($p) => [
            'cells' => [
                new \Illuminate\Support\HtmlString('<img src="' . e($p->gambar) . '" alt="' . e($p->title) . '" class="w-20 h-14 object-cover border border-gray-200">'),
                $p->title,
                $p->category,
                $p->status ? 'Aktif' : 'Nonaktif',
            ],
            'editRoute' => $p->trashed() ? null : route('operator.foto.edit', $p->id),
            'deleteRoute' => $p->trashed() ? null : route('operator.foto.destroy', $p->id),
            'restoreRoute' => $p->trashed() ? route('operator.foto.restore', $p->id) : null,
            'forceDeleteRoute' => $p->trashed() ? route('operator.foto.force-delete', $p->id) : null,
            'trashed' => $p->trashed(),
        ])->toArray(),
    ])
@endsection
