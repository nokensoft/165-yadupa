@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Pengumuman' : 'Tambah Pengumuman')
@section('page-title', $editMode ? 'Edit Pengumuman' : 'Tambah Pengumuman')
@section('content')
    <x-operator.informasi-form route-prefix="operator.pengumuman" label="Pengumuman" :edit-mode="$editMode" :informasi="$informasi ?? null" />
@endsection
