@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Halaman' : 'Tambah Halaman')
@section('page-title', $editMode ? 'Edit Halaman' : 'Tambah Halaman')
@section('content')
    <form action="{{ $editMode ? route('operator.pages.update', $page->id) : route('operator.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($editMode) @method('PUT') @endif

        <div class="flex flex-col lg:flex-row gap-6">
            <div class="flex-1 space-y-6">
                <x-operator.field label="Judul Halaman" name="title" required>
                    <input type="text" name="title" value="{{ old('title', $editMode ? $page->title : '') }}" required
                           class="w-full border border-gray-300 p-4 text-lg font-semibold focus:border-primary focus:outline-none transition no-round"
                           placeholder="Masukkan judul halaman">

                    <x-operator.slug-field :value="old('slug', $editMode ? $page->slug : '')" source="title" />
                </x-operator.field>

                <x-operator.field label="Konten" name="content" required>
                    <textarea name="content" id="editor">{{ old('content', $editMode ? $page->content : '') }}</textarea>
                </x-operator.field>
            </div>

            <div class="w-full lg:w-80 space-y-6">
                <x-operator.status-card :edit-mode="$editMode" cancel-route="{{ route('operator.pages.index') }}">
                    <x-operator.status-toggle :checked="$editMode ? $page->status : true" label="Aktifkan halaman" />
                </x-operator.status-card>

                <x-operator.image-upload
                    label="Gambar Cover"
                    name="gambar_file"
                    aspect="aspect-video"
                    :preview="$editMode && $page->cover ? $page->gambar : null"
                    :help="'Opsional. Tampil sebagai banner di atas konten halaman.' . ($editMode ? ' Kosongkan untuk mempertahankan gambar saat ini.' : '')"
                />
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        license_key: 'gpl',
        height: 420,
        menubar: false,
        statusbar: false,
        branding: false,
        placeholder: 'Tulis konten halaman...',
        plugins: 'lists link image',
        toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image | removeformat',
        content_style: "body { font-family: Inter, sans-serif; font-size: 0.95rem; line-height: 1.75; color: #292524; } a { color: #dc2626; }",
        images_upload_url: '{{ route('operator.tinymce.upload') }}',
        images_upload_credentials: true,
        setup: function (editor) {
            // TinyMCE tidak otomatis mensinkronkan isinya ke textarea asli.
            // Sinkronkan kembali tepat sebelum form disubmit, dan cegah submit jika kosong.
            editor.on('init', function () {
                const form = editor.getElement().closest('form');
                if (!form) return;

                form.addEventListener('submit', (e) => {
                    tinymce.triggerSave();
                    if (!editor.getContent({ format: 'text' }).trim()) {
                        e.preventDefault();
                        alert('Konten tidak boleh kosong.');
                    }
                });
            });
        },
    });
</script>
@endpush
