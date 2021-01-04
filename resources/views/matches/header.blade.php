<header class="bg-gray-50 dark:bg-gray-800 shadow border-t border-gray-150 dark:border-gray-850">
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
		@if (isset($regs))
			<div class="filters flex items-center gap-4">
				<div class="flex flex-col">
					<label for="season" class="text-xs uppercase">
						Temporada
					</label>
					<select id="season" class="appearance-none rounded text-sm | py-1 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="season">
						@foreach ($seasons as $season)
							<option value="{{ $season->slug }}">{{ $season->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="flex flex-col">
					<label for="view" class="text-xs uppercase">
						Equipo
					</label>
					<select id="season" class="appearance-none rounded text-sm | py-1 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="team">
						<option value="all">Todos</option>
						@foreach ($season_teams as $season_team)
							<option value="{{ $season_team->id }}">{{ $season_team->team->medium_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="flex flex-col">
					<label for="view" class="text-xs uppercase">
						Manager
					</label>
					<select id="season" class="appearance-none rounded text-sm | py-1 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="manager">
						<option value="all">Todos</option>
						@foreach ($managers as $manager)
							<option value="{{ $manager->id }}">{{ $manager->name }}</option>
						@endforeach
					</select>
				</div>
			</div> {{-- filters --}}
			<div class="flex flex-col mt-2">
				<input type="search" class="appearance-none rounded text-sm | py-1 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" placeholder='Buscar...' wire:model="search" autofocus>
			</div>
		@endif
    </div>
</header>