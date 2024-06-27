@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            <li class="page-item @if ($paginator->onFirstPage()) disabled @endif">
                <button class="page-link" rel="prev" aria-label="@lang('pagination.previous')" tabindex="0" wire:click="previousPage" wire:loading.attr="disabled">
                    <i class='bx bx-chevron-left text-lg'></i>
                </button>
            </li>

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="d-none d-md-block page-item separator disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page === $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="d-none d-md-block page-item"><a class="page-link" tabindex="0" wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <li class="page-item @if (!$paginator->hasMorePages()) disabled @endif">
                <button class="page-link" rel="next" aria-label="@lang('pagination.next')" tabindex="0" wire:click="nextPage" wire:loading.attr="disabled">
                    <i class='bx bx-chevron-right text-lg'></i>
                </button>
            </li>
        </ul>
    </nav>

    <div class="pagination-info">
        <p class="font-medium">{{ $paginator->firstItem() }} / {{ $paginator->lastItem() }} de {{ $paginator->total() }} registros</p>
    </div>
@endif
