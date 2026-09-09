@extends('layouts.dashboard')
@section('title', 'Agenda')
@section('page-title', 'Agenda')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Agenda',
        'createRoute' => route('operator.agenda.create'),
        'trashedRoute' => route('operator.agenda.index'),
        'columns' => ['Gambar', 'Judul', 'Tanggal', 'Status'],
        'paginator' => $informasi,
        'rows' => $informasi->map(fn($i) => [
            'cells' => [
                new \Illuminate\Support\HtmlString('<img src="' . e($i->gambar) . '" alt="' . e($i->title) . '" class="w-16 h-12 object-cover border border-gray-200">'),
                $i->title,
                optional($i->published_at)->format('d M Y') ?? $i->created_at->format('d M Y'),
                $i->status ? 'Terbit' : 'Draft',
            ],
            'editRoute' => $i->trashed() ? null : route('operator.agenda.edit', $i->id),
            'deleteRoute' => $i->trashed() ? null : route('operator.agenda.destroy', $i->id),
            'restoreRoute' => $i->trashed() ? route('operator.agenda.restore', $i->id) : null,
            'forceDeleteRoute' => $i->trashed() ? route('operator.agenda.force-delete', $i->id) : null,
            'trashed' => $i->trashed(),
        ])->toArray(),
    ])
@endsection
