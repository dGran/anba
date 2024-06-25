@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                        <i class='bx bx-chevron-left text-lg'></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" rel="prev" aria-label="@lang('pagination.previous')" tabindex="0" wire:click="previousPage">
                        <i class='bx bx-chevron-left text-lg'></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="d-none d-md-block page-item separator disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="d-none d-md-block page-item"><a class="page-link" tabindex="0" wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" rel="next" aria-label="@lang('pagination.next')" tabindex="0" wire:click="nextPage">
                        <i class='bx bx-chevron-right text-lg'></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">
                        <i class='bx bx-chevron-right text-lg'></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>

    <div class="pagination-info">
        <p>
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            <span>/</span>
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            <span>de</span>
            <span class="font-medium">{{ $paginator->total() }}</span>
            <span>registros</span>
        </p>
    </div>
@endif
