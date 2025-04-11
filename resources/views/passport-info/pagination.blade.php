@if ($passports->lastPage() > 1)
<li class="page-item {{ ($passports->currentPage() == 1) ? 'disabled' : '' }}">
    <a class="page-link" href="{{ $passports->url(1) }}">
        <i class="w-4 h-4" data-feather="chevrons-left"></i>
    </a>
</li>
<li class="page-item {{ ($passports->currentPage() == 1) ? 'disabled' : '' }}">
    <a class="page-link" href="{{ $passports->previousPageUrl() }}">
        <i class="w-4 h-4" data-feather="chevron-left"></i>
    </a>
</li>
@for ($i = 1; $i <= $passports->lastPage(); $i++)
<li class="page-item {{ ($passports->currentPage() == $i) ? 'active' : '' }}">
    <a class="page-link" href="{{ $passports->url($i) }}">{{ $i }}</a>
</li>
@endfor
<li class="page-item {{ ($passports->currentPage() == $passports->lastPage()) ? 'disabled' : '' }}">
    <a class="page-link" href="{{ $passports->nextPageUrl() }}">
        <i class="w-4 h-4" data-feather="chevron-right"></i>
    </a>
</li>
<li class="page-item {{ ($passports->currentPage() == $passports->lastPage()) ? 'disabled' : '' }}">
    <a class="page-link" href="{{ $passports->url($passports->lastPage()) }}">
        <i class="w-4 h-4" data-feather="chevrons-right"></i>
    </a>
</li>
@endif
