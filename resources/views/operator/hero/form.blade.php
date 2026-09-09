@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Hero' : 'Tambah Hero')
@section('page-title', $editMode ? 'Edit Hero' : 'Tambah Hero')
@section('content')
    <form action="{{ $editMode ? route('operator.hero.update', $hero->id) : route('operator.hero.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if ($editMode) @method('PUT') @endif

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- LEFT COLUMN --}}
            <div class="flex-1 space-y-6">
                <x-operator.field label="Judul" name="title" required>
                    <input type="text" name="title" value="{{ old('title', $editMode ? $hero->title : '') }}" required
                           class="w-full border border-gray-300 p-4 text-lg font-semibold focus:border-primary focus:outline-none transition no-round"
                           placeholder="Masukkan judul hero">
                </x-operator.field>

                <x-operator.image-upload
                    label="Gambar Hero"
                    name="gambar_file"
                    :required="!$editMode"
                    aspect="aspect-video"
                    :preview="$editMode && $hero->image ? $hero->gambar : null"
                    :help="'Otomatis dikonversi ke WebP, ukuran seragam 1920x1080 (16:9) untuk background hero layar penuh di beranda.' . ($editMode ? ' Kosongkan untuk mempertahankan gambar saat ini.' : '')"
                />
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="w-full lg:w-80 space-y-6">
                <x-operator.status-card :edit-mode="$editMode" cancel-route="{{ route('operator.hero.index') }}">
                    <x-operator.status-toggle :checked="$editMode ? $hero->status : true" label="Tampilkan di beranda" />
                </x-operator.status-card>

                <x-operator.field label="Prioritas Urutan" name="priority" help="Angka lebih kecil tampil lebih dulu di slider beranda.">
                    <input type="number" name="priority" min="0" value="{{ old('priority', $editMode ? $hero->priority : 0) }}"
                           class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                </x-operator.field>

                <x-operator.field label="Tanggal Publikasi" name="published_at" help="Kosongkan untuk menggunakan tanggal saat ini.">
                    <input type="date" name="published_at"
                           value="{{ old('published_at', ($editMode && $hero->published_at) ? $hero->published_at->format('Y-m-d') : '') }}"
                           class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
                </x-operator.field>
            </div>
        </div>
    </form>
@endsection
