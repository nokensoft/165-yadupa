{{-- Form terpadu untuk konten Informasi (Berita/Pengumuman/Agenda/Infografis).
     Props: routePrefix, label, editMode, informasi (jika edit) --}}
@props(['routePrefix', 'label', 'editMode', 'informasi' => null])
@php
    $formAction = $editMode ? route("{$routePrefix}.update", $informasi->id) : route("{$routePrefix}.store");
    $indexRoute = route("{$routePrefix}.index");
@endphp

<form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($editMode) @method('PUT') @endif

    <div class="flex flex-col lg:flex-row gap-6">

        {{-- LEFT COLUMN --}}
        <div class="flex-1 space-y-6">
            <x-operator.field label="Judul" name="title" required>
                <input type="text" name="title" value="{{ old('title', $editMode ? $informasi->title : '') }}" required
                       class="w-full border border-gray-300 p-4 text-lg font-semibold focus:border-primary focus:outline-none transition no-round"
                       placeholder="Masukkan judul {{ strtolower($label) }}">

                <x-operator.slug-field :value="old('slug', $editMode ? $informasi->slug : '')" source="title" />
            </x-operator.field>

            <x-operator.field label="Konten" name="content" required>
                <textarea name="content" id="editor">{{ old('content', $editMode ? $informasi->content : '') }}</textarea>
            </x-operator.field>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="w-full lg:w-80 space-y-6">
            <x-operator.status-card :edit-mode="$editMode" :cancel-route="$indexRoute">
                <x-operator.status-toggle :checked="$editMode ? $informasi->status : true" label="Terbitkan" />
            </x-operator.status-card>

            <x-operator.field label="Tanggal Publikasi" name="published_at" help="Kosongkan untuk menggunakan tanggal saat ini">
                <input type="date" name="published_at"
                       value="{{ old('published_at', ($editMode && $informasi->published_at) ? $informasi->published_at->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition no-round">
            </x-operator.field>

            <x-operator.image-upload
                label="Gambar Sampul"
                name="gambar_file"
                aspect="aspect-video"
                :preview="$editMode && $informasi->image ? $informasi->gambar : null"
                :help="'Otomatis dikonversi ke WebP, ukuran seragam 1200x675 (rasio 16:9).' . ($editMode ? ' Kosongkan untuk mempertahankan gambar saat ini.' : '')"
            />
        </div>
    </div>
</form>

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
        placeholder: 'Tulis konten {{ strtolower($label) }} lengkap...',
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
