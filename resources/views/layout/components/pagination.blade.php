@if ($paginator->lastPage() > 1)
    <nav 
        role="navigation" 
        aria-label="Pagination Navigation"
        class="w-full mt-4"
    >
        {{-- Mobile View: Only Prev & Next --}}
        <div class="flex justify-center sm:hidden space-x-2">
            {{-- Previous --}}
            <a href="{{ $paginator->previousPageUrl() ?? '#' }}"
               class="px-3 py-2 rounded-lg bg-white border text-gray-600 hover:bg-gray-100 {{ $paginator->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}"
               aria-label="Previous">
                &laquo;
            </a>

            {{-- Next --}}
            <a href="{{ $paginator->nextPageUrl() ?? '#' }}"
               class="px-3 py-2 rounded-lg bg-white border text-gray-600 hover:bg-gray-100 {{ $paginator->currentPage() == $paginator->lastPage() ? 'opacity-50 pointer-events-none' : '' }}"
               aria-label="Next">
                &raquo;
            </a>
        </div>

        {{-- Desktop View: Full Pagination --}}
        <div class="hidden sm:flex flex-wrap justify-center items-center gap-1">
            {{-- First --}}
            <a href="{{ $paginator->url(1) }}"
               class="px-3 py-2 rounded-lg border bg-white text-gray-600 hover:bg-gray-100 {{ $paginator->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}"
               aria-label="First Page">
                &laquo;&laquo;
            </a>

            {{-- Previous --}}
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-2 rounded-lg border bg-white text-gray-600 hover:bg-gray-100 {{ $paginator->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}"
               aria-label="Previous Page">
                &laquo;
            </a>

            {{-- Page Numbers --}}
            @php
                $window = 2;
                $ellipsisShown = false;
            @endphp

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if ($i == 1 || $i == $paginator->lastPage() || abs($paginator->currentPage() - $i) <= $window)
                    <a href="{{ $paginator->url($i) }}"
                       class="px-3 py-2 rounded-lg border 
                       {{ $paginator->currentPage() == $i 
                           ? 'bg-blue-600 text-white font-semibold' 
                           : 'bg-white text-gray-600 hover:bg-gray-100' }}"
                       aria-current="{{ $paginator->currentPage() == $i ? 'page' : false }}">
                        {{ $i }}
                    </a>
                    @php $ellipsisShown = false; @endphp
                @elseif (!$ellipsisShown)
                    <span class="px-3 py-2 text-gray-400 select-none">...</span>
                    @php $ellipsisShown = true; @endphp
                @endif
            @endfor

            {{-- Next --}}
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-2 rounded-lg border bg-white text-gray-600 hover:bg-gray-100 {{ $paginator->currentPage() == $paginator->lastPage() ? 'opacity-50 pointer-events-none' : '' }}"
               aria-label="Next Page">
                &raquo;
            </a>

            {{-- Last --}}
            <a href="{{ $paginator->url($paginator->lastPage()) }}"
               class="px-3 py-2 rounded-lg border bg-white text-gray-600 hover:bg-gray-100 {{ $paginator->currentPage() == $paginator->lastPage() ? 'opacity-50 pointer-events-none' : '' }}"
               aria-label="Last Page">
                &raquo;&raquo;
            </a>
        </div>
    </nav>
@endif
