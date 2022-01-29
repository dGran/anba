<div class="flex flex-col md:flex-row items-center select-none pb-4">
    <div class="flex-1 w-full flex flex-col relative">
        <label for="season" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Temporada
        </label>
        <select id="season" class="appearance-none sm:rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border-t border-b sm:border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="season" wire:change="change_season">
            @foreach ($seasons as $seas)
                <option value="{{ $seas->slug }}">{{ $seas->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
        <label for="phase" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Fase
        </label>
        <select id="phase" class="appearance-none sm:rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border-t border-b sm:border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="phase">
            <option value="all">Liga regular / Playoffs</option>
            <option value="regular">Liga regular</option>
            <option value="playoffs">Playoffs</option>
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
        <label for="mode" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Modo
        </label>
        <select id="mode" class="appearance-none sm:rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border-t border-b sm:border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="mode">
            <option value="per_game">Por partido</option>
            <option value="totals">Totales</option>
        </select>
    </div>
</div>

<div class="flex-auto flex flex-col | select-none | py-4 | {{ $season_is_current ?: 'hidden' }}">
    <label class="flex items-center justify-end cursor-pointer">
        <input type="checkbox" class="toggle appearance-none relative w-10 h-5 transition-all duration-200 ease-in-out bg-gray-300 hover:bg-gray-400 focus:bg-gray-400 rounded-full shadow-inner outline-none" wire:model="current_roster"/>
        <span class="ml-2 text-xs uppercase">Plantilla actual</span>
    </label>
</div>
