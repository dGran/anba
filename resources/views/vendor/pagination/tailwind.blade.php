@if ($paginator->hasPages())
    <nav>
        <ul class="pagination flex items center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link mx-0.5 bg-gray-150 dark:bg-gray-750 text-gray-350 dark:text-gray-550 border border-gray-200 dark:border-gray-700 focus:outline-none" aria-hidden="true">
                        <i class='bx bx-chevron-left text-lg'></i>
                    </a>
                </li>
            @else
                {{-- fix for previuos --}}
                <li class="page-item hidden">
                    <a class="page-link mx-0.5 bg-white dark:bg-gray-700 text-gray-700 border border-gray-200 dark:border-gray-650 hover:bg-indigo-50 dark:hover:bg-gray-650 focus:bg-indigo-50 dark:focus:bg-gray-650 hover:border-indigo-200 dark:hover:border-gray-600 focus:border-indigo-200 dark:focus:border-gray-600 hover:text-indigo-500 focus:text-indigo-500 dark:hover:text-gray-300 dark:focus:text-gray-300 dark:text-white focus:outline-none" rel="prev" aria-label="@lang('pagination.previous')" tabindex="0" wire:click="previousPage">
                        <i class='bx bx-chevron-left text-lg'></i>
                    </a>
                </li>
                {{-- end-fix --}}
                <li class="page-item">
                    <a class="page-link mx-0.5 bg-white dark:bg-gray-700 text-gray-700 border border-gray-200 dark:border-gray-650 hover:bg-indigo-50 dark:hover:bg-gray-650 focus:bg-indigo-50 dark:focus:bg-gray-650 hover:border-indigo-200 dark:hover:border-gray-600 focus:border-indigo-200 dark:focus:border-gray-600 hover:text-indigo-500 focus:text-indigo-500 dark:hover:text-gray-300 dark:focus:text-gray-300 dark:text-white focus:outline-none" rel="prev" aria-label="@lang('pagination.previous')" tabindex="0" wire:click="previousPage">
                        <i class='bx bx-chevron-left text-lg'></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="hidden md:block page-item separator disabled" aria-disabled="true"><span class="page-link mx-0.5 bg-white dark:bg-gray-700 text-gray-700 border border-gray-200 dark:border-gray-650 hover:bg-indigo-50 dark:hover:bg-gray-650 focus:bg-indigo-50 dark:focus:bg-gray-650 hover:border-indigo-200 dark:hover:border-gray-600 focus:border-indigo-200 dark:focus:border-gray-600 hover:text-indigo-500 focus:text-indigo-500 dark:hover:text-gray-300 dark:focus:text-gray-300 dark:text-white focus:outline-none">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link focus:outline-none">{{ $page }}</span></li>
                        @else
                            <li class="hidden md:block page-item"><a class="page-link bg-white dark:bg-gray-700 text-gray-700 border border-gray-200 dark:border-gray-650 hover:bg-indigo-50 dark:hover:bg-gray-650 focus:bg-indigo-50 dark:focus:bg-gray-650 hover:border-indigo-200 dark:hover:border-gray-600 focus:border-indigo-200 dark:focus:border-gray-600 hover:text-indigo-500 focus:text-indigo-500 dark:hover:text-gray-300 dark:focus:text-gray-300 dark:text-white focus:outline-none" tabindex="0" wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- fix for next --}}
                <li class="page-item hidden">
                    <a class="page-link mx-0.5 bg-white dark:bg-gray-700 text-gray-700 border border-gray-200 dark:border-gray-650 hover:bg-indigo-50 dark:hover:bg-gray-650 focus:bg-indigo-50 dark:focus:bg-gray-650 hover:border-indigo-200 dark:hover:border-gray-600 focus:border-indigo-200 dark:focus:border-gray-600 hover:text-indigo-500 focus:text-indigo-500 dark:hover:text-gray-300 dark:focus:text-gray-300 dark:text-white focus:outline-none" rel="next" aria-label="@lang('pagination.next')" tabindex="0" wire:click="nextPage">
                        <i class='bx bx-chevron-right text-lg'></i>
                    </a>
                </li>
                {{-- end-fix --}}
                <li class="page-item">
                    <a class="page-link mx-0.5 bg-white dark:bg-gray-700 text-gray-700 border border-gray-200 dark:border-gray-650 hover:bg-indigo-50 dark:hover:bg-gray-650 focus:bg-indigo-50 dark:focus:bg-gray-650 hover:border-indigo-200 dark:hover:border-gray-600 focus:border-indigo-200 dark:focus:border-gray-600 hover:text-indigo-500 focus:text-indigo-500 dark:hover:text-gray-300 dark:focus:text-gray-300 dark:text-white focus:outline-none" rel="next" aria-label="@lang('pagination.next')" tabindex="0" wire:click="nextPage">
                        <i class='bx bx-chevron-right text-lg'></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="page-link mx-0.5 bg-gray-150 dark:bg-gray-750 text-gray-350 dark:text-gray-550 border border-gray-200 dark:border-gray-700 focus:outline-none" aria-hidden="true">
                        <i class='bx bx-chevron-right text-lg'></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>

    <div class="pagination-info mt-3">
        <p class="text-gray-700 dark:text-gray-300">
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            <span>/</span>
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            <span>de</span>
            <span class="font-medium">{{ $paginator->total() }}</span>
            <span>registros</span>
        </p>
    </div>
@endif
