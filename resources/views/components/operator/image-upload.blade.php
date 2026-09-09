{{-- Kartu upload gambar dengan preview langsung (Alpine).
     Props: label, name (default gambar_file), required, preview (URL awal/null), aspect (class rasio), help
     Slot (opsional): konten tambahan di dalam kartu yang sama (mis. field "atau URL Gambar"),
     boleh pakai @input="preview = $event.target.value || preview" untuk ikut mengubah preview. --}}
@props([
    'label',
    'name' => 'gambar_file',
    'required' => false,
    'preview' => null,
    'aspect' => 'aspect-video',
    'help' => null,
])
<div {{ $attributes->merge(['class' => 'bg-white shadow-sm p-6 space-y-4']) }}
     x-data="{ preview: @js($preview) }">
    <label class="text-lg font-bold uppercase text-gray-500 block">
        {{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
    </label>

    <template x-if="preview">
        <img :src="preview" class="w-full {{ $aspect }} object-cover border border-gray-200" alt="Preview">
    </template>
    <template x-if="!preview">
        <div class="w-full {{ $aspect }} bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-lg">
            <i class="fas fa-image mr-2"></i> Belum ada gambar
        </div>
    </template>

    <div>
        <input type="file" name="{{ $name }}" accept="image/*" {{ $required ? 'required' : '' }}
               @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview"
               class="w-full border border-gray-300 p-3 text-lg no-round">
        @if ($help)
            <p class="text-lg text-gray-400 mt-1">{{ $help }}</p>
        @endif
        @error($name) <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
    </div>

    {{ $slot }}
</div>
