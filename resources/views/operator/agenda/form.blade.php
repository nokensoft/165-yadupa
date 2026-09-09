@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Agenda' : 'Tambah Agenda')
@section('page-title', $editMode ? 'Edit Agenda' : 'Tambah Agenda')
@section('content')
    <x-operator.informasi-form route-prefix="operator.agenda" label="Agenda" :edit-mode="$editMode" :informasi="$informasi ?? null" />
@endsection
