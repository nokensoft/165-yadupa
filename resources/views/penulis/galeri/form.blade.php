@extends('layouts.dashboard')
@section('title', $editMode ? 'Edit Foto Bercerita' : 'Tambah Foto Bercerita')
@section('page-title', $editMode ? 'Edit Foto Bercerita' : 'Tambah Foto Bercerita')
@section('content')
    @php
        $initialItems = old('items', $editMode
            ? $galeri->media->map(fn ($m) => [
                'media_id' => (string) $m->id,
                'judul' => $m->pivot->judul_item ?: $m->judul,
                'keterangan_singkat' => $m->pivot->keterangan_singkat,
            ])->values()->toArray()
            : []);

        if (empty($initialItems)) {
            $initialItems = [[
                'media_id' => '',
                'judul' => '',
                'keterangan_singkat' => '',
            ]];
        }

        $mediaOptions = $media->map(fn ($m) => [
            'id' => (string) $m->id,
            'judul' => $m->judul,
            'preview' => asset('storage/' . $m->file_path),
        ])->values()->toArray();

        $initialCoverMediaId = old('cover_media_id', $editMode ? $galeri->cover_media_id : '');
    @endphp

    <div class="bg-white shadow-sm p-6">
        <form action="{{ $editMode ? route('penulis.foto-bercerita.update', $galeri->id) : route('penulis.foto-bercerita.store') }}" method="POST" class="space-y-6" x-data="galeriItemsForm(@js($initialItems), @js($mediaOptions), @js($initialCoverMediaId))">
            @csrf
            @if ($editMode) @method('PUT') @endif

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 text-red-700">
                    <p class="font-bold mb-2">Ada data yang belum sesuai:</p>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="max-w-4xl">
                <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Foto Cover</label>
                <input type="hidden" name="cover_media_id" :value="cover_media_id">
                <input type="file" id="cover-file-input" class="hidden" accept="image/*" @change="handleCoverFileInput($event)">
                <div @click="triggerCoverFilePicker()"
                     @dragover.prevent="setCoverDragOver(true)"
                     @dragleave.prevent="setCoverDragOver(false)"
                     @drop.prevent="handleCoverFileDrop($event)"
                     :class="cover_drag_over ? 'border-primary bg-primary/5' : 'border-gray-200 bg-white'"
                     class="border p-2 cursor-pointer transition no-round">
                    <template x-if="previewUrl(cover_media_id)">
                        <div class="w-full max-w-xl bg-gray-100 pointer-events-none" style="aspect-ratio: 1720 / 1080;">
                            <img :src="previewUrl(cover_media_id)" alt="Preview cover" class="w-full h-full object-contain bg-gray-100">
                        </div>
                    </template>
                    <template x-if="!previewUrl(cover_media_id)">
                        <div class="w-full max-w-xl bg-gray-100 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center text-gray-400" style="aspect-ratio: 1720 / 1080;">
                            <i class="fas fa-image text-2xl mb-2"></i>
                            <span class="text-xs uppercase tracking-wide">Drag & Drop Foto Cover di Sini</span>
                            <span class="text-xs mt-1">atau klik untuk pilih file</span>
                        </div>
                    </template>
                </div>
                <div class="flex flex-wrap items-center gap-3 mt-2">
                    <button type="button" @click.stop="openGalleryModalForCover()"
                            class="text-xs font-bold uppercase tracking-wide text-primary hover:text-red-700 underline">
                        Pilih dari Media
                    </button>
                    <button type="button" @click="triggerCoverFilePicker()"
                            class="text-xs font-bold uppercase tracking-wide text-dark hover:text-gray-700 underline">
                        Pilih File
                    </button>
                    <button type="button" @click="clearCoverMedia()" x-show="cover_media_id"
                            class="text-red-600 hover:text-red-700 text-xs font-bold uppercase tracking-wide">
                        <i class="fas fa-times mr-1"></i>Hapus Cover
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-2" x-show="selectedMediaTitle(cover_media_id)">
                    Cover dipilih: <span class="font-semibold" x-text="selectedMediaTitle(cover_media_id)"></span>
                </p>
                <p class="text-xs text-primary mt-2" x-show="cover_uploading">
                    <i class="fas fa-spinner fa-spin mr-1"></i>Mengupload foto cover...
                </p>
                <p class="text-xs text-red-600 mt-2" x-show="cover_upload_error" x-text="cover_upload_error"></p>
                @error('cover_media_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="max-w-4xl">
                <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Judul Cerita</label>
                <input type="text" name="judul" value="{{ old('judul', $editMode ? $galeri->judul : '') }}" required
                       class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round"
                       placeholder="Judul foto bercerita">
                @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="max-w-4xl">
                <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="galeri-deskripsi-editor" data-rich-editor="galeri" rows="3"
                          class="w-full border border-gray-300 p-4 text-lg focus:border-primary focus:outline-none transition no-round resize-none"
                          placeholder="Deskripsi cerita (opsional)">{{ old('deskripsi', $editMode ? $galeri->deskripsi : '') }}</textarea>
            </div>

            @if ($media->count() > 0)
                <div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-2">
                        <label class="text-lg font-bold uppercase text-gray-500">Item Foto Bercerita</label>
                        <button type="button" @click="addItem()" class="bg-primary text-white px-4 py-2 text-sm font-bold hover:bg-red-700 transition uppercase tracking-wide no-round">
                            <i class="fas fa-plus mr-2"></i>Tambah
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 mb-4">
                        Setiap item berisi <strong>foto dari fitur Media</strong>, <strong>judul</strong>, dan <strong>keterangan singkat</strong>.
                    </p>

                    <div class="space-y-4">
                        <template x-for="(item, index) in items" :key="item.item_uid">
                            <div class="border border-gray-200 p-4 bg-gray-50">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="font-bold text-gray-700">Item Foto <span x-text="index + 1"></span></h3>
                                    <button type="button" @click="removeItem(index)" x-show="items.length > 1" class="text-red-600 hover:text-red-700 text-sm font-bold">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </div>

                                <div class="mb-4">
                                    <label class="text-sm font-bold uppercase text-gray-500 block mb-2">Foto Item</label>
                                    <input type="hidden" :name="`items[${index}][media_id]`" :value="item.media_id">
                                    <input type="file" :id="`item-file-input-${item.item_uid}`" class="hidden" accept="image/*" @change="handleItemFileInput(index, $event)">
                                    <div @click="triggerItemFilePicker(index)"
                                         @dragover.prevent="setItemDragOver(index, true)"
                                         @dragleave.prevent="setItemDragOver(index, false)"
                                         @drop.prevent="handleItemFileDrop(index, $event)"
                                         :class="item.drag_over ? 'border-primary bg-primary/5' : 'border-gray-200 bg-white'"
                                         class="border p-2 cursor-pointer transition no-round">
                                        <template x-if="previewUrl(item.media_id)">
                                            <div class="w-full max-w-lg bg-gray-100 pointer-events-none" style="aspect-ratio: 1720 / 1080;">
                                                <img :src="previewUrl(item.media_id)" alt="Preview foto" class="w-full h-full object-contain bg-gray-100">
                                            </div>
                                        </template>
                                        <template x-if="!previewUrl(item.media_id)">
                                            <div class="w-full max-w-lg bg-gray-100 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center text-gray-400" style="aspect-ratio: 1720 / 1080;">
                                                <i class="fas fa-image text-2xl mb-2"></i>
                                                <span class="text-xs uppercase tracking-wide">Drag & Drop Foto di Sini</span>
                                                <span class="text-xs mt-1">atau klik untuk pilih file</span>
                                            </div>
                                        </template>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Drag & drop foto untuk upload media baru.</p>
                                    <div class="flex flex-wrap items-center gap-3 mt-2">
                                        <button type="button" @click.stop="openGalleryModal(index)"
                                                class="text-xs font-bold uppercase tracking-wide text-primary hover:text-red-700 underline">
                                            Pilih dari Media
                                        </button>
                                        <button type="button" @click="triggerItemFilePicker(index)"
                                                class="text-xs font-bold uppercase tracking-wide text-dark hover:text-gray-700 underline">
                                            Pilih File
                                        </button>
                                    <button type="button" @click="clearSelectedMedia(index)" x-show="item.media_id"
                                            class="text-red-600 hover:text-red-700 text-xs font-bold uppercase tracking-wide">
                                        <i class="fas fa-times mr-1"></i>Hapus Pilihan Foto
                                    </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2" x-show="selectedMediaTitle(item.media_id)">
                                        Dipilih: <span class="font-semibold" x-text="selectedMediaTitle(item.media_id)"></span>
                                    </p>
                                    <p class="text-xs text-primary mt-2" x-show="item.uploading">
                                        <i class="fas fa-spinner fa-spin mr-1"></i>Mengupload foto...
                                    </p>
                                    <p class="text-xs text-red-600 mt-2" x-show="item.upload_error" x-text="item.upload_error"></p>
                                    <p class="text-xs text-gray-400 mt-1">Foto wajib dipilih dari fitur Media agar terintegrasi.</p>
                                </div>

                                <div class="mb-4">
                                    <label class="text-sm font-bold uppercase text-gray-500 block mb-2">Judul</label>
                                    <input type="text" :name="`items[${index}][judul]`" x-model="item.judul" required
                                           class="w-full border border-gray-300 p-3 text-sm focus:border-primary focus:outline-none transition no-round"
                                           placeholder="Judul foto">
                                </div>

                                <div>
                                    <label class="text-sm font-bold uppercase text-gray-500 block mb-2">Keterangan Singkat</label>
                                    <textarea :name="`items[${index}][keterangan_singkat]`" :id="`item-keterangan-${item.item_uid}`" data-rich-editor="galeri" x-model="item.keterangan_singkat" rows="3"
                                              class="w-full border border-gray-300 p-3 text-sm focus:border-primary focus:outline-none transition no-round resize-none"
                                              placeholder="Keterangan singkat di bawah foto"></textarea>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 text-yellow-700">
                    Belum ada media foto. Silakan
                    <a href="{{ route('penulis.media.create') }}" class="underline font-bold">upload foto di fitur Media</a>
                    terlebih dahulu.
                </div>
            @endif

            <div x-show="showGalleryModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <div class="absolute inset-0 bg-black/60" @click="closeGalleryModal()"></div>

                <div class="relative bg-white w-full max-w-4xl max-h-[85vh] flex flex-col shadow-xl no-round z-10">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold uppercase text-dark">Pilih Foto dari Galeri Media</h3>
                        <button type="button" @click="closeGalleryModal()" class="text-gray-400 hover:text-gray-700 text-xl">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="flex-1 overflow-y-auto p-6">
                        <div x-show="mediaOptions.length === 0" class="text-center py-10 text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-2"></i>
                            <p>Belum ada media foto. Upload gambar terlebih dahulu.</p>
                        </div>

                        <div x-show="mediaOptions.length > 0" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                            <template x-for="option in mediaOptions" :key="option.id">
                                <button type="button" @click="chooseModalMedia(option.id)"
                                        :class="modalSelectedId === option.id ? 'ring-2 ring-primary ring-offset-1' : 'hover:ring-2 hover:ring-gray-300'"
                                        class="relative text-left border border-gray-200 bg-white transition no-round overflow-hidden">
                                    <img :src="option.preview" :alt="option.judul" class="w-full h-28 object-contain bg-gray-100">
                                    <div class="p-2">
                                        <p class="text-sm font-semibold text-gray-700 truncate" x-text="option.judul"></p>
                                    </div>
                                    <div x-show="modalSelectedId === option.id" class="absolute top-2 right-2 bg-primary text-white w-6 h-6 flex items-center justify-center text-xs no-round">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200">
                        <button type="button" @click="closeGalleryModal()" class="bg-gray-200 text-gray-700 px-6 py-3 font-bold hover:bg-gray-300 transition uppercase text-sm no-round">
                            Batal
                        </button>
                        <button type="button" @click="confirmGallerySelection()" :disabled="!modalSelectedId"
                                class="bg-primary text-white px-6 py-3 font-bold hover:bg-red-700 transition uppercase text-sm no-round disabled:opacity-50">
                            <i class="fas fa-check mr-1"></i>Pilih Foto
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                @if ($media->count() > 0)
                    <button type="submit" class="bg-primary text-white px-8 py-4 font-bold hover:bg-red-700 transition uppercase text-lg tracking-wide no-round">
                        <i class="fas fa-save mr-2"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}
                    </button>
                @endif
                <a href="{{ route('penulis.foto-bercerita.index') }}" class="bg-gray-200 text-gray-700 px-8 py-4 font-bold hover:bg-gray-300 transition uppercase text-lg tracking-wide no-round">Batal</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>
<script>
function galeriItemsForm(initialItems, mediaOptions, initialCoverMediaId) {
    const createItemUid = () => `item-${Date.now()}-${Math.random().toString(36).slice(2, 8)}`;
    const createItemState = (item = {}) => ({
        item_uid: item.item_uid ?? createItemUid(),
        media_id: item.media_id ? String(item.media_id) : '',
        judul: item.judul ?? '',
        keterangan_singkat: item.keterangan_singkat ?? '',
        uploading: false,
        upload_error: '',
        drag_over: false,
    });
    return {
        items: (Array.isArray(initialItems) && initialItems.length ? initialItems : [{}]).map(createItemState),
        mediaOptions: Array.isArray(mediaOptions)
            ? mediaOptions.map(option => ({ ...option, id: String(option.id) }))
            : [],
        cover_media_id: initialCoverMediaId ? String(initialCoverMediaId) : '',
        cover_uploading: false,
        cover_upload_error: '',
        cover_drag_over: false,
        showGalleryModal: false,
        activeItemIndex: null,
        activeCoverSelection: false,
        modalSelectedId: '',
        richTextEditors: {},
        richTextToolbar: 'bold italic | link blockquote | bullist numlist',
        init() {
            this.$nextTick(() => this.initializeRichTextEditors());
            this.$watch('items.length', () => {
                this.$nextTick(() => this.initializeRichTextEditors());
            });
            this.$el.addEventListener('submit', () => this.syncRichTextEditors());
        },
        addItem() {
            this.items.push(createItemState());
        },
        removeItem(index) {
            if (this.items.length <= 1) return;
            this.items.splice(index, 1);
            this.cleanupRichTextEditors();
            if (this.activeItemIndex === index) {
                this.closeGalleryModal();
            } else if (this.activeItemIndex !== null && this.activeItemIndex > index) {
                this.activeItemIndex -= 1;
            }
        },
        triggerCoverFilePicker() {
            const input = document.getElementById('cover-file-input');
            if (input) input.click();
        },
        handleCoverFileInput(event) {
            const file = event.target?.files?.[0];
            if (file) {
                this.uploadMediaForCover(file);
            }
            event.target.value = '';
        },
        setCoverDragOver(value) {
            this.cover_drag_over = !!value;
        },
        handleCoverFileDrop(event) {
            this.setCoverDragOver(false);
            const file = event.dataTransfer?.files?.[0];
            if (file) {
                this.uploadMediaForCover(file);
            }
        },
        triggerItemFilePicker(index) {
            const item = this.items[index];
            if (!item) return;
            const input = document.getElementById(`item-file-input-${item.item_uid}`);
            if (input) input.click();
        },
        handleItemFileInput(index, event) {
            const file = event.target?.files?.[0];
            if (file) {
                this.uploadMediaForItem(index, file);
            }
            event.target.value = '';
        },
        setItemDragOver(index, value) {
            if (!this.items[index]) return;
            this.items[index].drag_over = !!value;
        },
        handleItemFileDrop(index, event) {
            this.setItemDragOver(index, false);
            const file = event.dataTransfer?.files?.[0];
            if (file) {
                this.uploadMediaForItem(index, file);
            }
        },
        async uploadMediaFile(file, mediaTitle) {
            if (!file.type || !file.type.startsWith('image/')) {
                throw new Error('File harus berupa gambar.');
            }

            const formData = new FormData();
            formData.append('judul', mediaTitle || 'Foto');
            formData.append('file', file);

            const response = await fetch('{{ route("penulis.media.upload-ajax") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            if (!response.ok) {
                let errorMessage = 'Gagal upload foto baru.';
                try {
                    const errorData = await response.json();
                    errorMessage = errorData.message
                        || (errorData.errors && Object.values(errorData.errors).flat()[0])
                        || errorMessage;
                } catch (_) {}

                throw new Error(errorMessage);
            }

            return response.json();
        },
        async uploadMediaForCover(file) {
            this.cover_uploading = true;
            this.cover_upload_error = '';

            try {
                const uploadedMedia = await this.uploadMediaFile(file, file.name.replace(/\.[^/.]+$/, '') || 'Cover');
                this.upsertMediaOption(uploadedMedia);
                this.cover_media_id = String(uploadedMedia.id);
            } catch (error) {
                this.cover_upload_error = error?.message || 'Terjadi kesalahan saat upload foto cover.';
            } finally {
                this.cover_uploading = false;
                this.cover_drag_over = false;
            }
        },
        async uploadMediaForItem(index, file) {
            const item = this.items[index];
            if (!item) return;

            item.uploading = true;
            item.upload_error = '';

            try {
                const mediaTitle = (item.judul || '').trim() || file.name.replace(/\.[^/.]+$/, '');
                const uploadedMedia = await this.uploadMediaFile(file, mediaTitle || 'Foto');
                this.upsertMediaOption(uploadedMedia);
                item.media_id = String(uploadedMedia.id);
            } catch (error) {
                item.upload_error = error?.message || 'Terjadi kesalahan saat upload foto.';
            } finally {
                item.uploading = false;
                item.drag_over = false;
            }
        },
        upsertMediaOption(media) {
            const option = {
                id: String(media.id),
                judul: media.judul ?? '',
                preview: media.file_path ?? '',
            };
            const existingIndex = this.mediaOptions.findIndex(item => item.id === option.id);
            if (existingIndex === -1) {
                this.mediaOptions.unshift(option);
                return;
            }
            this.mediaOptions[existingIndex] = option;
        },
        openGalleryModalForCover() {
            this.activeCoverSelection = true;
            this.activeItemIndex = null;
            this.modalSelectedId = this.cover_media_id ? String(this.cover_media_id) : '';
            this.showGalleryModal = true;
        },
        openGalleryModal(index) {
            if (!this.items[index]) return;
            this.activeCoverSelection = false;
            this.activeItemIndex = index;
            this.modalSelectedId = this.items[index].media_id ? String(this.items[index].media_id) : '';
            this.showGalleryModal = true;
        },
        closeGalleryModal() {
            this.showGalleryModal = false;
            this.activeItemIndex = null;
            this.activeCoverSelection = false;
            this.modalSelectedId = '';
        },
        chooseModalMedia(mediaId) {
            this.modalSelectedId = String(mediaId);
        },
        confirmGallerySelection() {
            if (this.activeCoverSelection) {
                this.cover_media_id = this.modalSelectedId ? String(this.modalSelectedId) : '';
                this.cover_upload_error = '';
                this.closeGalleryModal();
                return;
            }
            if (this.activeItemIndex === null || !this.items[this.activeItemIndex]) {
                this.closeGalleryModal();
                return;
            }
            this.items[this.activeItemIndex].media_id = this.modalSelectedId ? String(this.modalSelectedId) : '';
            this.closeGalleryModal();
        },
        clearSelectedMedia(index) {
            if (!this.items[index]) return;
            this.items[index].media_id = '';
            this.items[index].upload_error = '';
        },
        clearCoverMedia() {
            this.cover_media_id = '';
            this.cover_upload_error = '';
        },
        selectedMedia(mediaId) {
            return this.mediaOptions.find(option => option.id === String(mediaId)) ?? null;
        },
        selectedMediaTitle(mediaId) {
            const selected = this.selectedMedia(mediaId);
            return selected ? selected.judul : '';
        },
        previewUrl(mediaId) {
            const selected = this.selectedMedia(mediaId);
            return selected ? selected.preview : '';
        },
        initializeRichTextEditors() {
            if (typeof window.tinymce === 'undefined') return;

            this.cleanupRichTextEditors();

            this.$el.querySelectorAll('textarea[data-rich-editor="galeri"]').forEach((textarea) => {
                const key = textarea.id || textarea.name;
                if (!key || this.richTextEditors[key]) return;
                tinymce.init({
                    target: textarea,
                    menubar: false,
                    statusbar: false,
                    branding: false,
                    promotion: false,
                    convert_urls: false,
                    plugins: 'link lists',
                    toolbar: this.richTextToolbar,
                    height: textarea.id === 'galeri-deskripsi-editor' ? 220 : 180,
                    placeholder: textarea.getAttribute('placeholder') || '',
                    content_style: 'body { font-family: Lato, sans-serif; font-size: 14px; line-height: 1.6; }',
                    setup: (editor) => {
                        editor.on('init change input undo redo', () => {
                            editor.save();
                            textarea.dispatchEvent(new Event('input', { bubbles: true }));
                        });
                    },
                    init_instance_callback: (editor) => {
                        this.richTextEditors[key] = editor;
                        editor.save();
                    },
                });
            });
        },
        cleanupRichTextEditors() {
            const activeKeys = new Set(
                Array.from(this.$el.querySelectorAll('textarea[data-rich-editor="galeri"]'))
                    .map((textarea) => textarea.id || textarea.name)
                    .filter(Boolean)
            );

            Object.entries(this.richTextEditors).forEach(([key, editor]) => {
                if (!activeKeys.has(key)) {
                    if (editor && typeof editor.remove === 'function') {
                        editor.remove();
                    }
                    delete this.richTextEditors[key];
                }
            });
        },
        syncRichTextEditors() {
            if (typeof window.tinymce !== 'undefined') {
                window.tinymce.triggerSave();
            }
            Object.values(this.richTextEditors).forEach((editor) => {
                if (editor && typeof editor.save === 'function') {
                    editor.save();
                }
            });
        }
    };
}
</script>
@endpush
