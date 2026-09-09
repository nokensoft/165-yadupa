{{-- INFORMASI TERBARU --}}
<section id="blog" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="mb-10 text-center sm:text-left">
            <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900">Informasi</h2>
            <p class="text-gray-500 text-sm mt-1">Berita, pengumuman, agenda, dan infografis terbaru untuk Anda</p>
        </div>

        @if(isset($informasis) && $informasis->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Dibatasi Maksimal 3 Data --}}
                @foreach($informasis->take(3) as $item)
                    <article class="group bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between">
                        <div>
                            {{-- Container Gambar & Badge Kategori --}}
                            <div class="relative block aspect-video bg-slate-100 overflow-hidden">
                                <a href="{{ route('informasi.show', $item->slug) }}" class="block w-full h-full">
                                    @if($item->image)
                                        <img 
                                            src="{{ $item->gambar }}" 
                                            alt="{{ $item->title }}" 
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                        />
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-400">
                                            <i class="fa-regular fa-newspaper text-4xl mb-2"></i>
                                            <span class="text-xs">Tidak Ada Gambar</span>
                                        </div>
                                    @endif
                                </a>

                                {{-- Badge Kategori Dynamic --}}
                                @if($item->category)
                                    <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold rounded-full text-white shadow-sm
                                        @if($item->category == 'Berita') bg-blue-600
                                        @elseif($item->category == 'Pengumuman') bg-rose-600
                                        @elseif($item->category == 'Agenda') bg-emerald-600
                                        @elseif($item->category == 'Infografis') bg-purple-600
                                        @else bg-gray-600 @endif">
                                        {{ $item->category }}
                                    </span>
                                @endif
                            </div>

                            {{-- Content Card --}}
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs text-gray-400 flex items-center gap-1">
                                        <i class="fa-regular fa-calendar text-blue-600"></i>
                                        {{ \Carbon\Carbon::parse($item->published_at ?? $item->created_at)->translatedFormat('d F Y') }}
                                    </span>
                                </div>

                                <a href="{{ route('informasi.show', $item->slug) }}">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-700 transition line-clamp-2">
                                        {{ $item->title }}
                                    </h3>
                                </a>
                                
                                <p class="text-sm text-gray-500 line-clamp-3">
                                    {{ Str::limit(strip_tags($item->content), 120) }}
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Button Selengkapnya --}}
            <div class="text-center mt-10">
                <a href="{{ route('informasi.index') }}" class="inline-flex items-center px-6 py-3 border-2 border-blue-600 text-blue-600 font-semibold rounded-full hover:bg-blue-600 hover:text-white transition">
                    Tampilkan Postingan Lainnya <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-2xl border border-gray-100">
                <i class="fa-solid fa-newspaper text-4xl text-gray-300 mb-3 block"></i>
                <p class="text-gray-500 font-medium">Belum ada informasi terbaru yang dipublikasikan.</p>
            </div>
        @endif
    </div>
</section>