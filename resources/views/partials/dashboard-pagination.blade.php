{{-- Pagination bergaya dashboard (boxy no-round, warna primary), menggantikan tampilan default Laravel --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
         class="flex flex-col sm:flex-row items-center justify-between gap-4">

        <p class="text-sm text-gray-500 order-2 sm:order-1">
            Menampilkan <span class="font-semibold text-gray-700">{{ $paginator->firstItem() }}</span>
            &ndash; <span class="font-semibold text-gray-700">{{ $paginator->lastItem() }}</span>
            dari <span class="font-semibold text-gray-700">{{ $paginator->total() }}</span> data
        </p>

        <div class="flex items-center order-1 sm:order-2">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" class="inline-flex items-center justify-center w-9 h-9 text-gray-300 border border-gray-300 cursor-not-allowed no-round">
                    <i class="fas fa-chevron-left text-sm"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="inline-flex items-center justify-center w-9 h-9 text-gray-600 border border-gray-300 hover:bg-gray-50 transition no-round">
                    <i class="fas fa-chevron-left text-sm"></i>
                </a>
            @endif

            {{-- Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true" class="inline-flex items-center justify-center w-9 h-9 text-gray-400 border-t border-b border-gray-300 -ml-px">&hellip;</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="inline-flex items-center justify-center w-9 h-9 text-white bg-primary border border-primary font-bold -ml-px no-round">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                               class="inline-flex items-center justify-center w-9 h-9 text-gray-600 border border-gray-300 hover:bg-gray-50 transition -ml-px no-round">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="inline-flex items-center justify-center w-9 h-9 text-gray-600 border border-gray-300 hover:bg-gray-50 transition -ml-px no-round">
                    <i class="fas fa-chevron-right text-sm"></i>
                </a>
            @else
                <span aria-disabled="true" class="inline-flex items-center justify-center w-9 h-9 text-gray-300 border border-gray-300 cursor-not-allowed -ml-px no-round">
                    <i class="fas fa-chevron-right text-sm"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
