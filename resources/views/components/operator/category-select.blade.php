{{-- Dropdown kategori. Props: categories (array), selected (nilai terpilih), label, required, name --}}
@props(['categories', 'selected' => null, 'label' => 'Kategori', 'required' => true, 'name' => 'category'])
<div class="bg-white shadow-sm p-6">
    <label class="text-lg font-bold uppercase text-gray-500 block mb-2">
        {{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
    </label>
    <select name="{{ $name }}" {{ $required ? 'required' : '' }}
            class="w-full border border-gray-300 p-3 text-lg focus:border-primary focus:outline-none transition bg-white no-round">
        <option value="">Pilih {{ $label }}</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat }}" {{ old($name, $selected) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
        @endforeach
    </select>
    @error($name) <p class="text-red-500 text-lg mt-1">{{ $message }}</p> @enderror
</div>
