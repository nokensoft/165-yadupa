@extends('layouts.dashboard')
@section('title', 'Pengumuman')
@section('page-title', 'Pengumuman')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Pengumuman',
        'createRoute' => route('operator.pengumuman.create'),
        'trashedRoute' => route('operator.pengumuman.index'),
        'columns' => ['Gambar', 'Judul', 'Tanggal', 'Status'],
        'paginator' => $informasi,
        'rows' => $informasi->map(fn($i) => [
            'cells' => [
                new \Illuminate\Support\HtmlString('<img src="' . e($i->gambar) . '" alt="' . e($i->title) . '" class="w-16 h-12 object-cover border border-gray-200">'),
                $i->title,
                optional($i->published_at)->format('d M Y') ?? $i->created_at->format('d M Y'),
                $i->status ? 'Terbit' : 'Draft',
            ],
            'editRoute' => $i->trashed() ? null : route('operator.pengumuman.edit', $i->id),
            'deleteRoute' => $i->trashed() ? null : route('operator.pengumuman.destroy', $i->id),
            'restoreRoute' => $i->trashed() ? route('operator.pengumuman.restore', $i->id) : null,
            'forceDeleteRoute' => $i->trashed() ? route('operator.pengumuman.force-delete', $i->id) : null,
            'trashed' => $i->trashed(),
        ])->toArray(),
    ])
@endsection
