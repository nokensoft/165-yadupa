{{-- Checkbox toggle status aktif/nonaktif. Props: name (default status), checked, label --}}
@props(['name' => 'status', 'checked' => true, 'label' => 'Aktifkan'])
<label class="flex items-center gap-2 text-lg text-gray-700 mb-4">
    <input type="checkbox" name="{{ $name }}" value="1" {{ old($name, $checked) ? 'checked' : '' }} class="w-5 h-5">
    {{ $label }}
</label>
