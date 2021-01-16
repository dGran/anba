<div>
	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8">
		<div class="text-xs tracking-wider uppercase font-miriam pt-4 px-4 sm:px-0">
	    	<a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 focus:text-gray-900 dark:text-gray-300 dark:hover:text-white dark:focus:text-white">Inicio</a>
	    	<span>/</span>
	    	<a href="{{ route('matches') }}" class="text-gray-600 hover:text-gray-900 focus:text-gray-900 dark:text-gray-300 dark:hover:text-white dark:focus:text-white">Partidos</a>
		</div>
		<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-6 px-4 py-8">
			<div class="flex items-center justify-between">
				<div class="flex-1">
					<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" class="mx-auto w-24 h-24 md:w-44 md:h-44">
					<div class="text-base text-center">{{ $match->localTeam->team->medium_name }}</div>
					<div class="text-sm text-center light:text-gray-500 dark:text-gray-300">{{ $match->localTeam->team->user ? $match->localTeam->team->user->name : 'sin manager' }}</div>
				</div>
				<div class="flex-initial">
					<p class="font-bold text-2xl md:text-3xl">{{ $match->score() }}</p>
				</div>
				<div class="flex-1">
					<img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->short_name }}" class="mx-auto w-24 h-24 md:w-44 md:h-44">
					<div class="text-base text-center">{{ $match->visitorTeam->team->medium_name }}</div>
					<div class="text-sm text-center light:text-gray-500 dark:text-gray-300">{{ $match->visitorTeam->team->user ? $match->visitorTeam->team->user->name : 'sin manager' }}</div>
				</div>

			</div>
		</div>

		<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-6 px-4 py-4">
			<div class="">
				<p class="uppercase pb-3 text-sm font-bold tracking-wider">game tops</p>
				@foreach ($match->playerStats->sortByDesc('PTS')->take(1) as $stat)
					@if ($stat->PTS > 0)
						<div class="flex justify-between text-sm items-center border-b border-gray-200 dark:border-gray-650 py-0.5">
							<div class="flex items-center">
								<img src="{{ $stat->player->team->getImg() }}" alt="{{ $stat->player->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
								<span class="uppercase font-bold light:text-gray-600 dark:text-gray-200 text-center" style="width: 20px">{{ $stat->player->position }}</span>
								<span class="ml-2">{{ $stat->player->name }}</span>
							</div>
							<div class="flex items-center uppercase text-sm font-bold">
								<span class="light:text-gray-500 dark:text-gray-300">puntos</span>
								<span class="light:text-gray-600 dark:text-gray-200 text-center ml-2" style="min-width: 20px">{{ $stat->PTS }}</span>
							</div>
						</div>
					@endif
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
			</div>
		</div>
	</div>
</div>