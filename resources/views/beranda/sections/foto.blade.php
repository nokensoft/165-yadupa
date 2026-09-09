{{-- SECTION FOTO TERBARU --}}
<section id="foto-terbaru" class="py-12 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(isset($photoTerbaru) && $photoTerbaru)
            <article class="bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-2 items-center">
                    
                    {{-- Sisi Kiri: Judul, Keterangan, Tanggal, & Button --}}
                    <div class="p-6 sm:p-8 md:p-10 flex flex-col justify-between order-2 md:order-1 h-full">
                        <div>
                            {{-- Badge Kategori & Tanggal --}}
                            <div class="flex items-center gap-3 mb-4">
                                @if($photoTerbaru->category)
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-primary-900 text-white uppercase tracking-wider">
                                        {{ $photoTerbaru->category }}
                                    </span>
                                @endif
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <i class="fa-regular fa-calendar text-primary-900"></i>
                                    {{ \Carbon\Carbon::parse($photoTerbaru->created_at)->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            {{-- Judul Foto --}}
                            <a href="{{ route('foto.show', $photoTerbaru->slug) }}" class="group">
                                <h3 class="text-xl sm:text-2xl font-extrabold text-gray-900 mb-3 group-hover:text-primary-800 transition line-clamp-2 leading-snug">
                                    {{ $photoTerbaru->title }}
                                </h3>
                            </a>

                            {{-- Keterangan Singkat --}}
                            @if($photoTerbaru->keterangan)
                                <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed">
                                    {{ $photoTerbaru->keterangan }}
                                </p>
                            @endif
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 pt-4 border-t border-gray-200/60 flex items-center justify-between">
                            <a href="{{ route('foto.show', $photoTerbaru->slug) }}" class="inline-flex items-center text-sm font-bold text-primary-900 hover:text-primary-800 group">
                                Lihat Detail Foto <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="{{ route('foto.index') }}" class="text-xs font-semibold text-gray-500 hover:text-gray-700">
                                Galeri Foto &rarr;
                            </a>
                        </div>
                    </div>

                    {{-- Sisi Kanan: Gambar Foto --}}
                    <div class="relative w-full aspect-video md:aspect-auto md:h-full bg-slate-100 overflow-hidden order-1 md:order-2">
                        <a href="{{ route('foto.show', $photoTerbaru->slug) }}" class="block w-full h-full group">
                            @if($photoTerbaru->image)
                                <img 
                                    src="{{ $photoTerbaru->gambar }}" 
                                    alt="{{ $photoTerbaru->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    loading="lazy"
                                />
                            @else
                                <div class="w-full h-full min-h-[250px] flex flex-col items-center justify-center bg-slate-100 text-slate-400">
                                    <i class="fa-regular fa-image text-4xl mb-2"></i>
                                    <span class="text-xs">Foto Tidak Tersedia</span>
                                </div>
                            @endif
                        </a>
                    </div>

                </div>
            </article>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-2xl border border-gray-100">
                <i class="fa-regular fa-image text-4xl text-gray-300 mb-3 block"></i>
                <p class="text-gray-500 font-medium">Belum ada dokumentasi foto terbaru yang dipublikasikan.</p>
            </div>
        @endif
    </div>
</section>