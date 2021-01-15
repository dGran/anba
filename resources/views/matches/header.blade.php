<header class="bg-gray-50 dark:bg-gray-800 shadow border-t border-gray-150 dark:border-gray-850 transition duration-500 ease-in-out">
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
		@if (isset($regs))
			<div class="flex items-center select-none">
				<div class="flex-1 sm:flex-auto flex flex-col">
					<label for="season" class="text-xs uppercase">
						Temporada
					</label>
					<select id="season" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="season">
						@foreach ($seasons as $season)
							<option value="{{ $season->slug }}">{{ $season->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="hidden sm:flex-auto sm:flex flex-col ml-4">
					<label for="teams" class="text-xs uppercase">
						Equipo
					</label>
					<select id="teams" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="team">
						<option value="all">Todos</option>
						@foreach ($season_teams as $season_team)
							<option value="{{ $season_team->id }}">{{ $season_team->team->medium_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="hidden sm:flex-auto sm:flex flex-col ml-4">
					<label for="manager" class="text-xs uppercase">
						Manager
					</label>
					<select id="manager" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="manager">
						<option value="all">Todos</option>
						@foreach ($managers as $manager)
							<option value="{{ $manager->id }}">{{ $manager->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="flex flex-col">
					<label class="flex items-center ml-4 mt-5 cursor-pointer">
						<input type="checkbox" class="toggle appearance-none relative w-10 h-5 transition-all duration-200 ease-in-out bg-gray-300 hover:bg-gray-400 focus:bg-gray-400 rounded-full shadow-inner outline-none" wire:model="hidePlayed"/>
						<span class="ml-2 text-xs uppercase">Ocultar jugados</span>
					</label>
				</div>
			</div>

			<div class="sm:hidden flex items-center select-none mt-3">
				<div class="flex-1 flex flex-col">
					<label for="teams2" class="text-xs uppercase">
						Equipo
					</label>
					<select id="teams2" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="team">
						<option value="all">Todos</option>
						@foreach ($season_teams as $season_team)
							<option value="{{ $season_team->id }}">{{ $season_team->team->medium_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="flex-1 flex flex-col ml-4">
					<label for="manager2" class="text-xs uppercase">
						Manager
					</label>
					<select id="manager2" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="manager">
						<option value="all">Todos</option>
						@foreach ($managers as $manager)
							<option value="{{ $manager->id }}">{{ $manager->name }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="flex items-center select-none mt-3">
				<div class="flex-1 flex flex-col">
					<input type="search" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" placeholder='Buscar...' wire:model="search">
				</div>
			</div>
		@endif
    </div>
</header>