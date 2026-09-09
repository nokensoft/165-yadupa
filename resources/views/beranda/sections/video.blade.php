{{-- SECTION VIDEO TERBARU --}}
<section id="video-terbaru" class="py-12 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(isset($videoTerbaru) && $videoTerbaru)
            <article class="bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-2 items-center">
                    
                    {{-- Sisi Kiri: Cover Video dengan Overlay Play Button --}}
                    <div class="relative w-full aspect-video bg-slate-900 overflow-hidden order-1">
                        <a href="{{ route('video.show', $videoTerbaru->slug) }}" class="block w-full h-full relative group">
                            @if($videoTerbaru->cover)
                                <img 
                                    src="{{ $videoTerbaru->gambar }}" 
                                    alt="{{ $videoTerbaru->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    loading="lazy"
                                />
                            @else
                                {{-- Fallback jika cover kosong: Ambil Thumbnail otomatis dari YouTube URL --}}
                                @php
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoTerbaru->youtube_url, $matches);
                                    $youtubeId = $matches[1] ?? null;
                                @endphp
                                @if($youtubeId)
                                    <img 
                                        src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg" 
                                        alt="{{ $videoTerbaru->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                        loading="lazy"
                                    />
                                @else
                                    <div class="w-full h-full min-h-[250px] flex flex-col items-center justify-center bg-slate-900 text-slate-400">
                                        <i class="fa-solid fa-video text-4xl mb-2 text-slate-600"></i>
                                        <span class="text-xs">Cover Tidak Tersedia</span>
                                    </div>
                                @endif
                            @endif

                            {{-- Overlay Play Button --}}
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition flex items-center justify-center">
                                <div class="w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                                    <i class="fa-solid fa-play text-xl ml-1"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Sisi Kanan: Judul, Keterangan, Tanggal, & Button --}}
                    <div class="p-6 sm:p-8 md:p-10 flex flex-col justify-between order-2 h-full">
                        <div>
                            {{-- Badge Kategori & Tanggal --}}
                            <div class="flex items-center gap-3 mb-4">
                                @if($videoTerbaru->category)
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-600 text-white uppercase tracking-wider">
                                        {{ $videoTerbaru->category }}
                                    </span>
                                @endif
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <i class="fa-regular fa-calendar text-red-600"></i>
                                    {{ \Carbon\Carbon::parse($videoTerbaru->created_at)->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            {{-- Judul Video --}}
                            <a href="{{ route('video.show', $videoTerbaru->slug) }}" class="group">
                                <h3 class="text-xl sm:text-2xl font-extrabold text-gray-900 mb-3 group-hover:text-red-600 transition line-clamp-2 leading-snug">
                                    {{ $videoTerbaru->title }}
                                </h3>
                            </a>

                            {{-- Keterangan Singkat --}}
                            @if($videoTerbaru->keterangan)
                                <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed">
                                    {{ $videoTerbaru->keterangan }}
                                </p>
                            @endif
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 pt-4 border-t border-gray-200/60 flex items-center justify-between">
                            <a href="{{ route('video.show', $videoTerbaru->slug) }}" class="inline-flex items-center text-sm font-bold text-red-600 hover:text-red-700 group">
                                Tonton Video <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="{{ route('video.index') }}" class="text-xs font-semibold text-gray-500 hover:text-gray-700">
                                Galeri Video &rarr;
                            </a>
                        </div>
                    </div>

                </div>
            </article>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-2xl border border-gray-100">
                <i class="fa-solid fa-video text-4xl text-gray-300 mb-3 block"></i>
                <p class="text-gray-500 font-medium">Belum ada dokumentasi video terbaru yang dipublikasikan.</p>
            </div>
        @endif
    </div>
</section>