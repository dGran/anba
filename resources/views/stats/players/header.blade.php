<div class="my-2">

	{{-- work in progress --}}
	<figure class="pb-8">
		<img src="{{ asset('img/in_progress.png') }}" alt="" class="w-64 animate-pulse">
		<figcaption class="italic text-sm">
			*Tanto los datos mostrados como las opciones están en desarrollo
		</figcaption>
	</figure>


	<h4 class="text-base font-bold uppercase tracking-wide mt-6">
		Jugadores
	</h4>

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
			<label for="per_page" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Reg / Página
			</label>
			<select id="per_page" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="per_page">
				<option value="10">10</option>
				<option value="20">20</option>
				<option value="30">30</option>
				<option value="40">40</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</div>
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<a class="appearance-none rounded text-base text-right text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-2.5 md:pt-5 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none | cursor-pointer" wire:click="$toggle('advanced_filters')">
				Filtros avanzados
			</a>
		</div>
	</div>


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
	</div>

	<div class="{{ $advanced_filters ? 'pb-2' : 'py-4' }}">
		<h4 class="text-xs uppercase font-bold text-gray-500 dark:text-gray-300 select-none pb-0.5 pl-1">
			Buscar jugador
		</h4>
		<div class="flex flex-col md:flex-row items-center select-none">
			<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
				<label for="name" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
					Nombre
				</label>
				<input type="search" id="name" wire:model="name" class="appearance-none rounded text-sm | h-12 md:h-16 pt-5 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none | text-sm text-blue-500 dark:text-dark-link font-bold" placeholder="Buscar..." autofocus="true">
			</div>
		</div>
	</div>

{{-- 	<div class="py-2">
		<p>
			orden = {{ $order }}
		</p>
		<p>
			orden_direction = {{ $order_direction }}
		</p>

	</div> --}}
</div>