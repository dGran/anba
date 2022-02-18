@if ($players->total() > 0)
    <div class="flex items-center justify-end | text-xs md:text-sm | px-3 sm:px-0">
        <p class="text-gray-700 dark:text-gray-300 | flex items-center space-x-1">
            <span class="font-medium">{{ $players->firstItem() }}</span>
            <span>/</span>
            <span class="font-medium">{{ $players->lastItem() }}</span>
            <span>de</span>
            <span class="font-medium">{{ $players->total() }}</span>
            <span>registros</span>
        </p>
        <div class="pl-3 | flex items-center space-x-0">
            <button wire:click="previousPage({{ $players->lastPage() }})" class="bg-white dark:bg-gray-750 hover:bg-gray-200 dark:hover:bg-gray-700 focus:bg-gray-200 dark:focus:bg-gray-700 | h-9 w-10 | border border-gray-200 dark:border-gray-650 | rounded-l-md | focus:outline-none">
                <i class="fas fa-chevron-left"></i>
            </button>
            <select class="appearance-none font-bold | h-9 px-3 | bg-white dark:bg-gray-750 hover:bg-gray-200 dark:hover:bg-gray-700 focus:bg-gray-200 dark:focus:bg-gray-700 | border-t border-b border-gray-200 dark:border-gray-650 | focus:outline-none" wire:model="page" wire:change="setCurrentPage">
                @for ($i = 1; $i < $players->lastPage()+1 ; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <button wire:click="nextPage({{ $players->lastPage() }})" class="bg-white dark:bg-gray-750 hover:bg-gray-200 dark:hover:bg-gray-700 focus:bg-gray-200 dark:focus:bg-gray-700 | h-9 w-10 | border border-gray-200 dark:border-gray-650 | rounded-r-md | focus:outline-none">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
@endif
