@extends('layouts.dashboard')
@section('title', 'Halaman')
@section('page-title', 'Halaman')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Halaman',
        'createRoute' => route('operator.pages.create'),
        'trashedRoute' => route('operator.pages.index'),
        'columns' => ['Judul', 'Status'],
        'paginator' => $pages,
        'rows' => $pages->map(fn($p) => [
            'cells' => [
                $p->title,
                $p->status ? 'Aktif' : 'Nonaktif',
            ],
            'editRoute' => $p->trashed() ? null : route('operator.pages.edit', $p->id),
            'deleteRoute' => $p->trashed() ? null : route('operator.pages.destroy', $p->id),
            'restoreRoute' => $p->trashed() ? route('operator.pages.restore', $p->id) : null,
            'forceDeleteRoute' => $p->trashed() ? route('operator.pages.force-delete', $p->id) : null,
            'trashed' => $p->trashed(),
        ])->toArray(),
    ])
@endsection
