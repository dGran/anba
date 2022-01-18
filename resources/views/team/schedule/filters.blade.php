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
        <label for="rival" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Rival
        </label>
        <select id="rival" class="appearance-none sm:rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border-t border-b sm:border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="rival">
            <option value="all">Todos</option>
            @foreach ($rivals as $riv)
                <option value="{{ $riv->id }}">{{ $riv->team->short_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
        <label for="matches" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Partidos
        </label>
        <select id="matches" class="appearance-none sm:rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border-t border-b sm:border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="matches_state">
            <option value="all">Todos</option>
            <option value="played">Disputados</option>
            <option value="pending">Pendientes</option>
        </select>
    </div>
</div>
