@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Foto' : 'Tambah Foto')
@section('page-title', $editMode ? 'Edit Foto' : 'Tambah Foto')
@section('content')
    <form action="{{ $editMode ? route('operator.foto.update', $photo->id) : route('operator.foto.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if ($editMode) @method('PUT') @endif

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- LEFT COLUMN --}}
            <div class="flex-1 space-y-6">
                <x-operator.field label="Judul" name="title" required>
                    <input type="text" name="title" value="{{ old('title', $editMode ? $photo->title : '') }}" required
                           class="w-full border border-gray-300 p-4 text-lg font-semibold focus:border-primary focus:outline-none transition no-round"
                           placeholder="Masukkan judul foto">

                    <x-operator.slug-field :value="old('slug', $editMode ? $photo->slug : '')" source="title" />
                </x-operator.field>

                <x-operator.field label="Keterangan" name="keterangan">
                    <textarea name="keterangan" rows="4"
                              class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round resize-none"
                              placeholder="Keterangan foto (opsional)">{{ old('keterangan', $editMode ? $photo->keterangan : '') }}</textarea>
                </x-operator.field>

                <x-operator.image-upload
                    label="Gambar"
                    name="gambar_file"
                    :required="!$editMode"
                    aspect="aspect-[1720/1080]"
                    :preview="$editMode && $photo->image ? $photo->gambar : null"
                    :help="'Otomatis dikonversi ke WebP, ukuran seragam 1720x1080.' . ($editMode ? ' Kosongkan untuk mempertahankan gambar saat ini.' : '')"
                />
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="w-full lg:w-80 space-y-6">
                <x-operator.status-card :edit-mode="$editMode" cancel-route="{{ route('operator.foto.index') }}">
                    <x-operator.status-toggle :checked="$editMode ? $photo->status : true" label="Tampilkan di galeri" />
                </x-operator.status-card>

                <x-operator.category-select
                    :categories="\App\Http\Controllers\Operator\PhotoController::CATEGORIES"
                    :selected="$editMode ? $photo->category : null"
                />
            </div>
        </div>
    </form>
@endsection
