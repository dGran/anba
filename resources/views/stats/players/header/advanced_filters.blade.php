<div class="py-4 {{ $advanced_filters ? 'block' : 'hidden' }}">

	<h4 class="text-xs uppercase font-bold text-gray-500 dark:text-gray-300 select-none pb-0.5 pl-1">
		Filtros Avanzados
	</h4>
	<div class="flex flex-col md:flex-row items-center select-none">
		<div class="flex-1 w-full flex flex-col relative">
			<label for="position" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Posición
			</label>
			<select id="position" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="position">
				<option value="all">Todas</option>
				@foreach ($positions as $position)
					<option value="{{ $position['id'] }}">{{ $position['name'] }}</option>
				@endforeach
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="experience" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Experiencia
			</label>
			<select id="experience" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="experience">
				<option value="all">Todas</option>
				<option value="rookie">Rookie</option>
				<option value="sophomore">Sophomore</option>
				<option value="veterano">Veterano</option>
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="draft_year" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Año Draft
			</label>
			<select id="draft_year" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="draft_year">
				<option value="all">Todos</option>
				@foreach ($draft_years as $draft_year)
					<option value="{{ $draft_year->draft_year }}">{{ $draft_year->draft_year }}</option>
				@endforeach
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="college" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Universidad
			</label>
			<select id="college" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="college">
				<option value="all">Todas</option>
				@foreach ($colleges as $college)
					<option value="{{ $college->college }}">{{ $college->college }}</option>
				@endforeach
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="nation" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				País
			</label>
			<select id="nation" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="nation">
				<option value="all">Todos</option>
				@foreach ($nations as $nation)
					<option value="{{ $nation->nation_name }}">{{ $nation->nation_name }}</option>
				@endforeach
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="position" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Altura
			</label>
			<select id="position" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="position">
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="position" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Peso
			</label>
			<select id="position" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="position">
			</select>
		</div>
	</div>

	<div class="flex flex-col md:flex-row items-center select-none pt-0.5">
		<div class="flex-1 w-full flex flex-col relative">
			<label for="team" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Equipo
			</label>
			<select id="team" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="team">
				<option value="all">Todos</option>
				@foreach ($teams as $team)
					<option value="{{ $team->team_id }}">{{ $team->team_name }}</option>
				@endforeach
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="division" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Division
			</label>
			<select id="division" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="division">
				<option value="all">Todas</option>
				@foreach ($divisions as $division)
					<option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
				@endforeach
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="conference" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Conferencia
			</label>
			<select id="conference" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="conference">
				<option value="all">Todas</option>
				@foreach ($conferences as $conference)
					<option value="{{ $conference->conference_id }}">{{ $conference->conference_name }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="pt-2">
		<p class="text-right text-sm">
			<a class="text-sm | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | cursor-pointer" wire:click="reset_all_filters">
				<i class="fas fa-sync-alt mr-2"></i>Resetear filtros
			</a>
		</p>
	</div>
</div>