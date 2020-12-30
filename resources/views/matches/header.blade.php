<header class="bg-white dark:bg-gray-750 shadow border-t border-gray-150 dark:border-gray-850">
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
		@if (isset($regs))
			<div class="filters flex items-center gap-4 px-3 md:px-0">
				<div class="flex flex-col">
					<label for="season" class="text-xs uppercase">
						Temporada
					</label>
					<select id="season" class="rounded py-1 px-3 text-sm bg-white dark:bg-gray-700 border mt-1 appearance-none hover:bg-gray-100 dark:hover:bg-gray-650 focus:outline-none light:border-gray-300 dark:border-gray-900 light:focus:border-gray-400 dark:focus:border-dark-link focus:bg-gray-100 dark:focus:bg-gray-650" wire:model="season">
						@foreach ($seasons as $season)
							<option value="{{ $season->slug }}">{{ $season->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="flex flex-col">
					<label for="view" class="text-xs uppercase">
						Equipo
					</label>
					<select id="view" class="rounded py-1 px-3 text-sm bg-white dark:bg-gray-700 border mt-1 appearance-none hover:bg-gray-100 dark:hover:bg-gray-650 focus:outline-none light:border-gray-300 dark:border-gray-900 light:focus:border-gray-400 dark:focus:border-dark-link focus:bg-gray-100 dark:focus:bg-gray-650" wire:model="team">
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
					<select id="view" class="rounded py-1 px-3 text-sm bg-white dark:bg-gray-700 border mt-1 appearance-none hover:bg-gray-100 dark:hover:bg-gray-650 focus:outline-none light:border-gray-300 dark:border-gray-900 light:focus:border-gray-400 dark:focus:border-dark-link focus:bg-gray-100 dark:focus:bg-gray-650" wire:model="manager">
						<option value="all">Todos</option>
						@foreach ($managers as $manager)
							<option value="{{ $manager->id }}">{{ $manager->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		@endif
    </div>
</header>