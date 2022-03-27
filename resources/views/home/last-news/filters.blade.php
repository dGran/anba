<ul class="text-xs md:text-sm tracking-wide flex bg-header-bg-light dark:bg-gray-750 text-gray-150 px-4 overflow-x-auto select-none | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-transparent hover:scrollbar-thumb-gray-300 | dark:hover:scrollbar-thumb-gray-500">
    <li class="" wire:click="setFilterType('all')">
        <button type="button" class="{{ $filterType == 'all' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            todas
        </button>
    </li>
    <li class="ml-2.5" wire:click="setFilterType('resultados')">
        <button class="{{ $filterType == 'resultados' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            resultados
        </button>
    </li>
    <li class="ml-2.5" wire:click="setFilterType('destacados')">
        <button class="{{ $filterType == 'destacados' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            destacados
        </button>
    </li>
    <li class="ml-2.5" wire:click="setFilterType('records')">
        <button class="{{ $filterType == 'records' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            records
        </button>
    </li>
    <li class="ml-2.5" wire:click="setFilterType('rachas')">
        <button class="{{ $filterType == 'rachas' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            rachas
        </button>
    </li>
    <li class="ml-2.5" wire:click="setFilterType('movimientos')">
        <button class="{{ $filterType == 'movimientos' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            movimientos
        </button>
    </li>
    <li class="ml-2.5" wire:click="setFilterType('declaraciones')">
        <button class="{{ $filterType == 'declaraciones' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            declaraciones
        </button>
    </li>
    <li class="ml-2.5" wire:click="setFilterType('lesiones')">
        <button class="{{ $filterType == 'lesiones' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            lesiones
        </button>
    </li>
    <li class="ml-2.5" wire:click="setFilterType('general')">
        <button class="{{ $filterType == 'general' ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-white' : 'bg-header-bg dark:bg-gray-750 hover:bg-white focus:bg-white hover:text-gray-700 focus:text-gray-700 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:hover:text-white dark:focus:text-white' }} leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none | border border-header-bg-lighter dark:border-gray-650 border-b-0">
            general
        </button>
    </li>
</ul>