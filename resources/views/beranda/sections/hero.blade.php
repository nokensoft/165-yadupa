{{-- HERO (Template Modifikasi Kotak Section dengan Alpine.js Slider) --}}
@php
    // Atur tinggi hero dengan mudah di sini
    $heroHeight = '350px';
@endphp

@if(isset($heroes) && $heroes->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div id="beranda" 
         class="relative overflow-hidden rounded-2xl shadow-lg bg-neutral-900" 
         style="height: {{ $heroHeight }};"
         x-data="{
             active: 0,
             slides: {{ $heroes->map(fn($hero) => [
                 'title' => $hero->title,
                 'image' => $hero->gambar
             ])->toJson() }},
             init() {
                 if (this.slides.length > 1) {
                     setInterval(() => {
                         this.active = (this.active + 1) % this.slides.length;
                     }, 5000); // Ganti gambar setiap 5 detik
                 }
             }
         }">

        {{-- Loop Gambar & Title Slider --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="active === index"
                 x-transition:enter="transition-opacity ease-out duration-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-500"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 w-full h-full bg-cover bg-center slider-zoom"
                 :style="`background-image: url('${slide.image}');`">
                
                {{-- Overlay Gradient & Judul Hero --}}
                <div class="absolute inset-0  flex items-end p-6 md:p-10">
                    <h2 class="text-white text-lg md:text-xl font-bold drop-shadow-md" x-text="slide.title"></h2>
                </div>
            </div>
        </template>

        {{-- Navigation Dots (Indikator Slider) --}}
        <template x-if="slides.length > 1">
            <div class="absolute bottom-4 right-6 z-10 flex space-x-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="active = index" 
                            class="h-2 rounded-full transition-all duration-300"
                            :class="active === index ? 'w-8 bg-white' : 'w-2 bg-white/50'"></button>
                </template>
            </div>
        </template>

    </div>
</section>
@endif

<style>
@keyframes kenBurnsIn {
    0% { transform: scale(1); }
    100% { transform: scale(1.08); }
}
.slider-zoom {
    animation: kenBurnsIn 6s ease-in-out forwards;
}
</style>