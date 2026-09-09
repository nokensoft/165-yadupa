@extends('layouts.dashboard')
@section('title', 'Hero Beranda')
@section('page-title', 'Hero Beranda')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Hero',
        'createRoute' => route('operator.hero.create'),
        'trashedRoute' => route('operator.hero.index'),
        'columns' => ['Gambar', 'Judul', 'Prioritas', 'Status'],
        'paginator' => $heroes,
        'rows' => $heroes->map(fn($h) => [
            'cells' => [
                new \Illuminate\Support\HtmlString('<img src="' . e($h->gambar) . '" alt="' . e($h->title) . '" class="w-20 h-9 object-cover border border-gray-200">'),
                $h->title,
                $h->priority,
                $h->status ? 'Aktif' : 'Nonaktif',
            ],
            'editRoute' => $h->trashed() ? null : route('operator.hero.edit', $h->id),
            'deleteRoute' => $h->trashed() ? null : route('operator.hero.destroy', $h->id),
            'restoreRoute' => $h->trashed() ? route('operator.hero.restore', $h->id) : null,
            'forceDeleteRoute' => $h->trashed() ? route('operator.hero.force-delete', $h->id) : null,
            'trashed' => $h->trashed(),
        ])->toArray(),
    ])
@endsection
