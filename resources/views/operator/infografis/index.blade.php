@extends('layouts.dashboard')
@section('title', 'Infografis')
@section('page-title', 'Infografis')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Infografis',
        'createRoute' => route('operator.infografis.create'),
        'trashedRoute' => route('operator.infografis.index'),
        'columns' => ['Gambar', 'Judul', 'Tanggal', 'Status'],
        'paginator' => $informasi,
        'rows' => $informasi->map(fn($i) => [
            'cells' => [
                new \Illuminate\Support\HtmlString('<img src="' . e($i->gambar) . '" alt="' . e($i->title) . '" class="w-16 h-12 object-cover border border-gray-200">'),
                $i->title,
                optional($i->published_at)->format('d M Y') ?? $i->created_at->format('d M Y'),
                $i->status ? 'Terbit' : 'Draft',
            ],
            'editRoute' => $i->trashed() ? null : route('operator.infografis.edit', $i->id),
            'deleteRoute' => $i->trashed() ? null : route('operator.infografis.destroy', $i->id),
            'restoreRoute' => $i->trashed() ? route('operator.infografis.restore', $i->id) : null,
            'forceDeleteRoute' => $i->trashed() ? route('operator.infografis.force-delete', $i->id) : null,
            'trashed' => $i->trashed(),
        ])->toArray(),
    ])
@endsection
