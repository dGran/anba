<div class="my-2">

	<div class="filters flex items-center select-none overflow-x-auto">
		<div class="flex flex-col">
			<label for="filterType" class="text-xs uppercase">
				Equipo o jugador
			</label>
			<select id="filterType" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="filterType" wire:change="changeFilterType">
				<option value="team">Equipo</option>
				<option value="player">Jugador</option>
			</select>
		</div>
		<div class="flex flex-col ml-4">
			<label for="phase" class="text-xs uppercase">
				Partido o AVG
			</label>
			<select id="phase" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="phase">
				<option value="regular">Liga regular</option>
				<option value="playoffs">Playoffs</option>
			</select>
		</div>
		<div class="flex flex-col ml-4">
			<label for="season" class="text-xs uppercase">
				Temporada
			</label>
			<select id="season" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="season" wire:change="change_season">
				<option value="">{{ __('Todas') }}</option>
				@foreach ($seasons as $seas)
					<option value="{{ $seas->slug }}">{{ $seas->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="flex flex-col ml-4">
			<label for="phase" class="text-xs uppercase">
				Fase de la temporada
			</label>
			<select id="phase" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="phase">
				<option value="regular">Liga regular</option>
				<option value="playoffs">Playoffs</option>
			</select>
		</div>
	</div>
</div>
