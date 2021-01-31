<div class="px-4 py-3">
	<p class="uppercase text-sm font-bold tracking-wider pb-3">últimos enfrentamientos</p>

	@if ($match->lastClashes()->count() > 0)
		<div class="flex items-center justify-between pb-1">
			<div class="flex-1 flex items-center justify-end">
				<div class="mr-2">
					<span>{{ $match->localTeam->team->short_name }}</span>
				</div>
				<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" class="w-10 h-10">
			</div>
			<div class="mx-6 font-bold text-xl">
				{{ $match->lastClashes_wins()['local'] }} - {{ $match->lastClashes_wins()['visitor'] }}
			</div>
			<div class="flex-1 flex items-center">
				<img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->short_name }}" class="w-10 h-10">
				<div class="ml-2">
					<span>{{ $match->visitorTeam->team->short_name }}</span>
				</div>
			</div>
		</div>
		@foreach ($match->lastClashes() as $clash)
			<div class="flex flex col">
				<div class="flex items-center justify-between text-sm py-2.5 w-full border-t border-gray-150 dark:border-gray-650">
					<div class="flex-1 flex items-center">
						<div class="flex-1 truncate flex items-center justify-end">
							<span class="sm:hidden">{{ $clash->localTeam->team->short_name }}</span>
							<span class="hidden sm:block">{{ $clash->localTeam->team->medium_name }}</span>
						</div>

						<a href="{{ route('match', $clash->id) }}" class="flex-0 flex flex-col mx-3 rounded px-2 py-0.5 w-20 text-center bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-transparent | hover:bg-white focus:bg-white focus:outline-none dark:hover:bg-dark-link dark:hover:text-gray-900 dark:focus:bg-dark-link dark:focus:text-gray-900">
							<span class="">{{ $clash->score() }}</span>
						</a>

						<div class="flex-1 truncate flex items-center justify-start">
							<span class="sm:hidden">{{ $clash->visitorTeam->team->short_name }}</span>
							<span class="hidden sm:block">{{ $clash->visitorTeam->team->medium_name }}</span>
						</div>

					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="text-sm py-2.5 w-full border-t border-gray-150 dark:border-gray-650 text-gray-500 dark:text-gray-300">
			No hay enfrentamientos previos
		</div>
	@endif
</div>