{{-- Slug otomatis dari field sumber (judul/title) selama belum diubah manual, wajib unik.
     Props: value, source (nama atribut "name" dari input judul/title) --}}
@props(['value' => '', 'source'])
<div class="mt-4">
    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">Slug (URL) <span class="text-red-500">*</span></label>
    <input type="text" name="slug" data-slug-input data-slug-source="{{ $source }}"
           value="{{ $value }}"
           class="w-full border border-gray-300 p-3 text-lg font-mono focus:border-primary focus:outline-none transition no-round"
           placeholder="otomatis-terisi">
    <p class="text-lg text-gray-400 mt-1">Otomatis dibuat dari judul. Bisa diubah manual, dan harus unik.</p>
    @error('slug') <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
</div>

@once
<script>
    (function () {
        function slugify(text) {
            return text.toString().toLowerCase().trim()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        document.querySelectorAll('[data-slug-input]').forEach(function (slugInput) {
            var source = document.querySelector('[name="' + slugInput.dataset.slugSource + '"]');
            if (!source) return;

            var touched = slugInput.value.trim() !== '';

            slugInput.addEventListener('input', function () {
                touched = slugInput.value.trim() !== '';
            });

            source.addEventListener('input', function () {
                if (!touched) {
                    slugInput.value = slugify(source.value);
                }
            });
        });
    })();
</script>
@endonce
