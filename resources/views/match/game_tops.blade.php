<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-6">
	<div class="px-4 py-3">
		<p class="uppercase text-sm font-bold tracking-wider">game tops</p>
		@if ($match->playerStats->count() == 0)
			<p class="text-sm pt-2">No hay estadisticas registradas</p>
		@else
			@foreach ($match->playerStats->sortByDesc('PTS')->take(1) as $stat)
				<div class="flex justify-between text-sm items-center border-b border-gray-200 dark:border-gray-650 py-0.5">
					@if ($stat->PTS > 0)
						<div class="flex items-center">
							<img src="{{ $stat->player->team->getImg() }}" alt="{{ $stat->player->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
							<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
							<span class="ml-2">{{ $stat->player->name }}</span>
						</div>
						<div class="flex items-center uppercase text-sm font-bold">
							<span class="light:text-gray-500 dark:text-gray-300">puntos</span>
							<span class="light:text-gray-600 dark:text-gray-200 text-center ml-2" style="min-width: 20px">{{ $stat->PTS }}</span>
						</div>
					@else
						No hay estadisticas
					@endif
				</div>
			@endforeach
			@foreach ($match->playerStats->sortByDesc('REB')->take(1) as $stat)
				@if ($stat->REB > 0)
					<div class="flex justify-between text-sm items-center border-b border-gray-200 dark:border-gray-650 py-0.5">
						<div class="flex items-center">
							<img src="{{ $stat->player->team->getImg() }}" alt="{{ $stat->player->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
							<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
							<span class="ml-2">{{ $stat->player->name }}</span>
						</div>
						<div class="flex items-center uppercase text-sm font-bold">
							<span class="light:text-gray-500 dark:text-gray-300">rebotes</span>
							<span class="light:text-gray-600 dark:text-gray-200 text-center ml-2" style="min-width: 20px">{{ $stat->REB }}</span>
						</div>
					</div>
				@endif
			@endforeach
			@foreach ($match->playerStats->sortByDesc('AST')->take(1) as $stat)
				@if ($stat->AST > 0)
					<div class="flex justify-between text-sm items-center border-b border-gray-200 dark:border-gray-650 py-0.5">
						<div class="flex items-center">
							<img src="{{ $stat->player->team->getImg() }}" alt="{{ $stat->player->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
							<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
							<span class="ml-2">{{ $stat->player->name }}</span>
						</div>
						<div class="flex items-center uppercase text-sm font-bold">
							<span class="light:text-gray-500 dark:text-gray-300">asistencias</span>
							<span class="light:text-gray-600 dark:text-gray-200 text-center ml-2" style="min-width: 20px">{{ $stat->AST }}</span>
						</div>
					</div>
				@endif
			@endforeach
			@foreach ($match->playerStats->sortByDesc('STL')->take(1) as $stat)
				@if ($stat->STL > 0)
					<div class="flex justify-between text-sm items-center border-b border-gray-200 dark:border-gray-650 py-0.5">
						<div class="flex items-center">
							<img src="{{ $stat->player->team->getImg() }}" alt="{{ $stat->player->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
							<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
							<span class="ml-2">{{ $stat->player->name }}</span>
						</div>
						<div class="flex items-center uppercase text-sm font-bold">
							<span class="light:text-gray-500 dark:text-gray-300">robos</span>
							<span class="light:text-gray-600 dark:text-gray-200 text-center ml-2" style="min-width: 20px">{{ $stat->STL }}</span>
						</div>
					</div>
				@endif
			@endforeach
			@foreach ($match->playerStats->sortByDesc('BLK')->take(1) as $stat)
				@if ($stat->BLK > 0)
					<div class="flex justify-between text-sm items-center">
						<div class="flex items-center">
							<img src="{{ $stat->player->team->getImg() }}" alt="{{ $stat->player->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
							<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
							<span class="ml-2">{{ $stat->player->name }}</span>
						</div>
						<div class="flex items-center uppercase text-sm font-bold">
							<span class="light:text-gray-500 dark:text-gray-300">tapones</span>
							<span class="light:text-gray-600 dark:text-gray-200 text-center ml-2" style="min-width: 20px">{{ $stat->BLK }}</span>
						</div>
					</div>
				@endif
			@endforeach
		@endif
	</div>
</div>