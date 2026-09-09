{{-- Kartu form generik: label (+tanda wajib) & pesan error, input aktualnya diisi lewat slot.
     Props: label, name (untuk @error), required (bool), help (teks bantuan opsional) --}}
@props(['label', 'name', 'required' => false, 'help' => null])
<div {{ $attributes->merge(['class' => 'bg-white shadow-sm p-6']) }}>
    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">
        {{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
    </label>

    {{ $slot }}

    @if ($help)
        <p class="text-lg text-gray-400 mt-1">{{ $help }}</p>
    @endif
    @error($name) <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
</div>
