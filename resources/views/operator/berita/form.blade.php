@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Berita' : 'Tambah Berita')
@section('page-title', $editMode ? 'Edit Berita' : 'Tambah Berita')
@section('content')
    <x-operator.informasi-form route-prefix="operator.berita" label="Berita" :edit-mode="$editMode" :informasi="$informasi ?? null" />
@endsection
