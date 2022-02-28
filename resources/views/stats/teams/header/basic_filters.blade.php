<div class="flex flex-col md:flex-row items-center select-none pt-2">
	<div class="flex-1 w-full flex flex-col relative">
		<label for="season" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
			Temporada
		</label>
		<select id="season" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="season" wire:change="change_season">
			@foreach ($seasons as $seas)
				<option value="{{ $seas->slug }}">{{ $seas->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
		<label for="phase" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
			Fase
		</label>
		<select id="phase" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="phase">
			<option value="regular">Liga regular</option>
			<option value="playoffs">Playoffs</option>
		</select>
	</div>
	<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
		<label for="mode" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
			Modo
		</label>
		<select id="mode" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="mode" wire:change="change_mode">
			<option value="per_game">Por partido</option>
			<option value="totals">Totales</option>
		</select>
	</div>
{{-- 		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
		<label for="filter_PJ" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
			PJ
		</label>
		<input type="number" id="filter_PJ" wire:model="filter_PJ" class="appearance-none rounded text-sm | h-12 md:h-16 pt-5 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none | text-sm text-blue-500 dark:text-dark-link font-bold">
	</div>
	<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
		<label for="filter_SUM_MIN" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
			MIN
		</label>
		<input type="number" id="filter_SUM_MIN" wire:model="filter_SUM_MIN" class="appearance-none rounded text-sm | h-12 md:h-16 pt-5 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none | text-sm text-blue-500 dark:text-dark-link font-bold">
	</div> --}}
	<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
		<a class="appearance-none rounded text-base text-right text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-2.5 md:pt-5 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none | cursor-pointer" wire:click="$toggle('advanced_filters')">
			Filtros avanzados
		</a>
	</div>
</div>
