@if ($students->lastPage() > 1)
    <div class="p-4 bg-gray-100 rounded-lg shadow-lg">
        <ul class="flex justify-center space-x-2">
            {{-- First Page --}}
            <li class="page-item {{ ($students->currentPage() == 1) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-200 transition-all duration-200 rounded-full' }}">
                <a class="page-link px-4 py-2" href="{{ $students->url(1) }}"
                   @if($students->currentPage() == 1) tabindex="-1" aria-disabled="true" @endif>
                    <i class="w-5 h-5" data-feather="chevrons-left"></i>
                </a>
            </li>

            {{-- Previous Page --}}
            <li class="page-item {{ ($students->currentPage() == 1) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-200 transition-all duration-200 rounded-full' }}">
                <a class="page-link px-4 py-2" href="{{ $students->previousPageUrl() }}"
                   @if($students->currentPage() == 1) tabindex="-1" aria-disabled="true" @endif>
                    <i class="w-5 h-5" data-feather="chevron-left"></i>
                </a>
            </li>

            {{-- Page Links --}}
            @for ($i = 1; $i <= $students->lastPage(); $i++)
                <li class="page-item {{ ($students->currentPage() == $i) ? 'bg-blue-500 text-white shadow-lg rounded-full' : 'hover:bg-blue-200 transition-all duration-200 rounded-full' }}">
                    <a class="page-link px-4 py-2" href="{{ $students->url($i) }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor

            {{-- Next Page --}}
            <li class="page-item {{ ($students->currentPage() == $students->lastPage()) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-200 transition-all duration-200 rounded-full' }}">
                <a class="page-link px-4 py-2" href="{{ $students->nextPageUrl() }}"
                   @if($students->currentPage() == $students->lastPage()) tabindex="-1" aria-disabled="true" @endif>
                    <i class="w-5 h-5" data-feather="chevron-right"></i>
                </a>
            </li>

            {{-- Last Page --}}
            <li class="page-item {{ ($students->currentPage() == $students->lastPage()) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-200 transition-all duration-200 rounded-full' }}">
                <a class="page-link px-4 py-2" href="{{ $students->url($students->lastPage()) }}"
                   @if($students->currentPage() == $students->lastPage()) tabindex="-1" aria-disabled="true" @endif>
                    <i class="w-5 h-5" data-feather="chevrons-right"></i>
                </a>
            </li>
        </ul>
    </div>
@endif
