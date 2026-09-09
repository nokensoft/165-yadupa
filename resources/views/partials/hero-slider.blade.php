{{-- HERO (Template Modifikasi Kotak Section dengan Alpine.js Slider) --}}
@php
    // Atur tinggi hero dengan mudah di sini
    $heroHeight = '350px';
@endphp

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div id="beranda" 
         class="relative overflow-hidden rounded-2xl shadow-lg bg-neutral-900" 
         style="height: {{ $heroHeight }};"
         x-data="{
             active: 0,
             slides: [
                 '{{ asset('img/hero/hero1.jpg') }}',
                 '{{ asset('img/hero/hero2.jpg') }}'
             ],
             init() {
                 setInterval(() => {
                     this.active = (this.active + 1) % this.slides.length;
                 }, 5000); // Ganti gambar setiap 5 detik
             }
         }">

        {{-- Loop Gambar Slider --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="active === index"
                 x-transition:enter="transition-opacity ease-out duration-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-500"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 w-full h-full bg-cover bg-center slider-zoom"
                 :style="`background-image: url('${slide}');`">
            </div>
        </template>

    </div>
</section>

<style>
@keyframes kenBurnsIn {
    0% { transform: scale(1); }
    100% { transform: scale(1.08); }
}
.slider-zoom {
    animation: kenBurnsIn 6s ease-in-out forwards;
}
</style>