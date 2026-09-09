@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Video' : 'Tambah Video')
@section('page-title', $editMode ? 'Edit Video' : 'Tambah Video')
@section('content')
    <form action="{{ $editMode ? route('operator.video.update', $video->id) : route('operator.video.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if ($editMode) @method('PUT') @endif

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- LEFT COLUMN --}}
            <div class="flex-1 space-y-6">
                <x-operator.field label="Judul" name="title" required>
                    <input type="text" name="title" value="{{ old('title', $editMode ? $video->title : '') }}" required
                           class="w-full border border-gray-300 p-4 text-lg font-semibold focus:border-primary focus:outline-none transition no-round"
                           placeholder="Masukkan judul video">

                    <x-operator.slug-field :value="old('slug', $editMode ? $video->slug : '')" source="title" />
                </x-operator.field>

                <x-operator.field label="Link YouTube" name="youtube_url" required>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $editMode ? $video->youtube_url : '') }}" required
                           class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round"
                           placeholder="https://www.youtube.com/watch?v=...">
                </x-operator.field>

                <x-operator.field label="Keterangan" name="keterangan">
                    <textarea name="keterangan" rows="4"
                              class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round resize-none"
                              placeholder="Keterangan video (opsional)">{{ old('keterangan', $editMode ? $video->keterangan : '') }}</textarea>
                </x-operator.field>

                <x-operator.image-upload
                    label="Gambar Sampul"
                    name="gambar_file"
                    aspect="aspect-[1720/1080]"
                    :preview="$editMode && $video->cover ? $video->gambar : null"
                    :help="'Otomatis dikonversi ke WebP, ukuran seragam 1720x1080. ' . ($editMode ? 'Kosongkan untuk mempertahankan gambar saat ini.' : 'Opsional, dapat dikosongkan.')"
                />
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="w-full lg:w-80 space-y-6">
                <x-operator.status-card :edit-mode="$editMode" cancel-route="{{ route('operator.video.index') }}">
                    <x-operator.status-toggle :checked="$editMode ? $video->status : true" label="Tampilkan di galeri" />
                </x-operator.status-card>

                <x-operator.category-select
                    :categories="\App\Http\Controllers\Operator\VideoController::CATEGORIES"
                    :selected="$editMode ? $video->category : null"
                />
            </div>
        </div>
    </form>
@endsection
