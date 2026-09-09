@extends('layouts.dashboard')
@section('title', 'Video')
@section('page-title', 'Video')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Video',
        'createRoute' => route('operator.video.create'),
        'trashedRoute' => route('operator.video.index'),
        'columns' => ['Gambar', 'Judul', 'Kategori', 'Status'],
        'paginator' => $videos,
        'rows' => $videos->map(fn($v) => [
            'cells' => [
                new \Illuminate\Support\HtmlString('<img src="' . e($v->gambar) . '" alt="' . e($v->title) . '" class="w-20 h-14 object-cover border border-gray-200">'),
                $v->title,
                $v->category,
                $v->status ? 'Aktif' : 'Nonaktif',
            ],
            'editRoute' => $v->trashed() ? null : route('operator.video.edit', $v->id),
            'deleteRoute' => $v->trashed() ? null : route('operator.video.destroy', $v->id),
            'restoreRoute' => $v->trashed() ? route('operator.video.restore', $v->id) : null,
            'forceDeleteRoute' => $v->trashed() ? route('operator.video.force-delete', $v->id) : null,
            'trashed' => $v->trashed(),
        ])->toArray(),
    ])
@endsection
