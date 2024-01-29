<div class="gap-4 mb-2 md:mx-0">
	<div class="bg-white dark:bg-gray-750 overflow-hidden shadow-md rounded-md text-gray-900 dark:text-gray-200 xs:col-span-2 lg:col-span-4 xl:col-span-3">

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 my-4 px-4 gap-8">
			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Puntos
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($filterType == 'player')
						@if (count($tops_records_player_PTS) > 0)
							@foreach ($tops_records_player_PTS as $top_records)
								<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
									<p class="flex-none w-4 text-right text-xs md:text-sm">
										{{ $loop->iteration }}.
									</p>
									<a href="{{ route('player', $top_records->playerslug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
										{{ $top_records->playername }}
									</a>
									<a href="{{ route('team.home', ['t' => $top_records->teamslug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
										{{ $top_records->teamname }}
									</a>
									<p class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | focus:outline-none">
										-
									</p>
									<p class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | focus:outline-none">
										{{ $top_records->seasonname }}
									</p>
									<p class="flex-grow text-right">
										{{ number_format($top_records->records, 0, ',', '.') }}
									</p>
								</div>
							@endforeach
						@else
							<p class="">
								No hay datos registrados
							</p>
						@endif
					@elseif ($filterType == 'team')
						@if ($tops_records_team_AST->count() > 0)
							@foreach ($tops_records_team_AST as $top_records)
								<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
									<p class="flex-none w-4 text-right text-xs md:text-sm">
										{{ $loop->iteration }}.
									</p>
									<a href="{{ route('team.home', ['t' => $top_records->seasonTeam->team->slug]) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
										{{ $top_records->seasonTeam->team->name }}
									</a>
									<p class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | focus:outline-none">
										-
									</p>
									<p class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | focus:outline-none">
										{{ $top_records->seasonTeam->season->name }} 
									</p>
									<p class="flex-grow text-right">
										{{ number_format($top_records->highest_AST, 0, ',', '.') }}
									</p>
								</div>
							@endforeach
						@else
							<p class="">
								No hay datos registrados
							</p>
						@endif
					@endif
				</div>
			</div>

			
		</div>
	</div>
</div>

