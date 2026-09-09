{{-- Kartu generik untuk mengelompokkan beberapa field sekaligus (mis. Sumber Referensi).
     Props: title (opsional) --}}
@props(['title' => null])
<div {{ $attributes->merge(['class' => 'bg-white shadow-sm p-6']) }}>
    @if ($title)
        <label class="text-lg font-bold uppercase text-gray-500 block mb-3">{{ $title }}</label>
    @endif

    {{ $slot }}
</div>
