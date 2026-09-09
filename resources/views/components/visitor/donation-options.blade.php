@props(['highlightLabel' => 'Populer'])

<div {{ $attributes->class(['grid sm:grid-cols-2 lg:grid-cols-4 gap-6']) }}>
    <div class="p-6 rounded-2xl border-2 border-gray-200 text-center hover:border-emerald-300 transition">
        <div class="text-3xl font-extrabold text-emerald-700 mb-1">Rp 50rb</div>
        <p class="text-xs text-gray-500">Pilihan awal untuk ikut mendukung kegiatan sosial dan lingkungan.</p>
    </div>
    <div class="p-6 rounded-2xl border-2 border-emerald-600 bg-emerald-50 ring-2 ring-emerald-200 text-center relative">
        <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 bg-emerald-600 text-white text-xs font-bold rounded-full">{{ $highlightLabel }}</span>
        <div class="text-3xl font-extrabold text-emerald-700 mb-1">Rp 150rb</div>
        <p class="text-xs text-gray-500">Nominal favorit untuk kontribusi rutin yang lebih berdampak.</p>
    </div>
    <div class="p-6 rounded-2xl border-2 border-gray-200 text-center hover:border-emerald-300 transition">
        <div class="text-3xl font-extrabold text-emerald-700 mb-1">Rp 500rb</div>
        <p class="text-xs text-gray-500">Kontribusi lebih besar untuk membantu keberlanjutan kegiatan yayasan.</p>
    </div>
    <div class="p-6 rounded-2xl border-2 border-gray-200 text-center hover:border-emerald-300 transition">
        <div class="text-2xl font-extrabold text-emerald-700 mb-1">Jumlah Lain</div>
        <p class="text-xs text-gray-500">Pilih nominal donasi sesuai kemampuan Anda.</p>
    </div>
</div>
