@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Infografis' : 'Tambah Infografis')
@section('page-title', $editMode ? 'Edit Infografis' : 'Tambah Infografis')
@section('content')
    <x-operator.informasi-form route-prefix="operator.infografis" label="Infografis" :edit-mode="$editMode" :informasi="$informasi ?? null" />
@endsection
