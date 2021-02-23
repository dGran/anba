<div class="px-4 py-3">

	<p class="uppercase text-sm md:text-2xl font-bold tracking-wider border-b border-gray-150 dark:border-gray-650 pb-2">tops del partido</p>

	@if ($match->playerStats->count() == 0)
		<div class="text-sm py-2.5 w-full text-gray-500 dark:text-gray-300">
			No hay estadisticas registradas
		</div>
	@else
		@if ($match->hasLocalPlayerStats() && $match->hasVisitorPlayerStats())
			<div class="md:py-3">

				@foreach ($match->playerStats->sortByDesc('PTS')->take(1) as $stat)
					<div class="flex justify-between text-sm items-center border-b border-gray-150 dark:border-gray-650 py-0.5">
						@if ($stat->PTS > 0)
							<div class="flex items-center">
								<img src="{{ $stat->seasonTeam->team->getImg() }}" alt="{{ $stat->seasonTeam->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
								<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
								<span class="ml-2">{{ $stat->player->name }}</span>
							</div>
							<div class="flex items-center uppercase text-sm font-bold">
								<span class="light:text-gray-500 dark:text-gray-300">puntos</span>
								<span class="light:text-gray-600 dark:text-gray-200 text-right ml-2" style="min-width: 20px">{{ $stat->PTS }}</span>
							</div>
						@else
							No hay estadisticas
						@endif
					</div>
				@endforeach
				@foreach ($match->playerStats->sortByDesc('REB')->take(1) as $stat)
					@if ($stat->REB > 0)
						<div class="flex justify-between text-sm items-center border-b border-gray-150 dark:border-gray-650 py-0.5">
							<div class="flex items-center">
								<img src="{{ $stat->seasonTeam->team->getImg() }}" alt="{{ $stat->seasonTeam->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
								<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
								<span class="ml-2">{{ $stat->player->name }}</span>
							</div>
							<div class="flex items-center uppercase text-sm font-bold">
								<span class="light:text-gray-500 dark:text-gray-300">rebotes</span>
								<span class="light:text-gray-600 dark:text-gray-200 text-right ml-2" style="min-width: 20px">{{ $stat->REB }}</span>
							</div>
						</div>
					@endif
				@endforeach
				@foreach ($match->playerStats->sortByDesc('AST')->take(1) as $stat)
					@if ($stat->AST > 0)
						<div class="flex justify-between text-sm items-center border-b border-gray-150 dark:border-gray-650 py-0.5">
							<div class="flex items-center">
								<img src="{{ $stat->seasonTeam->team->getImg() }}" alt="{{ $stat->seasonTeam->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
								<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
								<span class="ml-2">{{ $stat->player->name }}</span>
							</div>
							<div class="flex items-center uppercase text-sm font-bold">
								<span class="light:text-gray-500 dark:text-gray-300">asistencias</span>
								<span class="light:text-gray-600 dark:text-gray-200 text-right ml-2" style="min-width: 20px">{{ $stat->AST }}</span>
							</div>
						</div>
					@endif
				@endforeach
				@foreach ($match->playerStats->sortByDesc('STL')->take(1) as $stat)
					@if ($stat->STL > 0)
						<div class="flex justify-between text-sm items-center border-b border-gray-150 dark:border-gray-650 py-0.5">
							<div class="flex items-center">
								<img src="{{ $stat->seasonTeam->team->getImg() }}" alt="{{ $stat->seasonTeam->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
								<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
								<span class="ml-2">{{ $stat->player->name }}</span>
							</div>
							<div class="flex items-center uppercase text-sm font-bold">
								<span class="light:text-gray-500 dark:text-gray-300">robos</span>
								<span class="light:text-gray-600 dark:text-gray-200 text-right ml-2" style="min-width: 20px">{{ $stat->STL }}</span>
							</div>
						</div>
					@endif
				@endforeach
				@foreach ($match->playerStats->sortByDesc('BLK')->take(1) as $stat)
					@if ($stat->BLK > 0)
						<div class="flex justify-between text-sm items-center">
							<div class="flex items-center">
								<img src="{{ $stat->seasonTeam->team->getImg() }}" alt="{{ $stat->seasonTeam->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
								<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
								<span class="ml-2">{{ $stat->player->name }}</span>
							</div>
							<div class="flex items-center uppercase text-sm font-bold">
								<span class="light:text-gray-500 dark:text-gray-300">tapones</span>
								<span class="light:text-gray-600 dark:text-gray-200 text-right ml-2" style="min-width: 20px">{{ $stat->BLK }}</span>
							</div>
						</div>
					@endif
				@endforeach
			</div>
		@else
			<div class="text-sm py-2.5 w-full text-gray-500 dark:text-gray-300">
				@if (!$match->hasLocalPlayerStats())
					Reporte de los {{ $match->localTeam->team->medium_name }} pendiente
				@endif
				@if (!$match->hasVisitorPlayerStats())
					Reporte de los {{ $match->visitorTeam->team->medium_name }} pendiente
				@endif
			</div>
		@endif
	@endif

</div>
