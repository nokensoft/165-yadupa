{{-- Kartu kontrol status (slot: select/checkbox) + tombol Simpan/Perbarui & Batal.
     Props: editMode, cancelRoute --}}
@props(['editMode', 'cancelRoute'])
<div class="bg-white shadow-sm p-6">
    {{ $slot }}

    <div class="flex gap-3 mt-4">
        <button type="submit" class="flex-1 bg-primary text-white px-4 py-3 font-bold hover:bg-red-700 transition uppercase text-lg tracking-wide no-round text-center">
            <i class="fas fa-save mr-1"></i> {{ $editMode ? 'Perbarui' : 'Simpan' }}
        </button>
        <a href="{{ $cancelRoute }}" class="bg-gray-200 text-gray-700 px-4 py-3 font-bold hover:bg-gray-300 transition uppercase text-lg tracking-wide no-round text-center">Batal</a>
    </div>
</div>
