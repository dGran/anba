<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0 my-6">
	<div class="px-4 py-3">

		<div class="grid grid-cols-1 md:grid-cols-2">

			<div class="md:border-r border-gray-150 dark:border-gray-650 md:pr-4">
				<p class="uppercase text-sm font-bold tracking-wider">bajas para el partido</p>

				<div class="text-sm pt-3 w-full">
					@if ($localInjuries->count() > 0 || $visitorInjuries->count() > 0)
						@if ($localInjuries->count() > 0)
							<p class="text-sm uppercase pb-1">
								{{ $match->localTeam->team->name }}
							</p>
							@foreach ($localInjuries as $injury)
								<div class="flex items-center py-1">
									<img src="{{ $injury->getImg() }}" alt="{{ $injury->name }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover h-10 w-10">
									<div class="flex flex-col ml-3 leading-5">
										<span>{{ $injury->name }}</span>
										<p class="text-gray-500 dark:text-gray-300">
											<i class="fas fa-briefcase-medical {{ $injury->injury_playable ? 'text-yellow-300' : 'text-pretty-red' }} mr-1.5"></i>
											{{ $injury->injury->name }}
										</p>
									</div>
								</div>
							@endforeach
						@endif
						@if ($visitorInjuries->count() > 0)
							<p class="text-sm uppercase pt-3 pb-1">
								{{ $match->visitorTeam->team->name }}
							</p>
							@foreach ($visitorInjuries as $injury)
								<div class="flex items-center py-1">
									<img src="{{ $injury->getImg() }}" alt="{{ $injury->name }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover h-10 w-10">
									<div class="flex flex-col ml-3 leading-5">
										<span>{{ $injury->name }}</span>
										<p class="text-gray-500 dark:text-gray-300">
											<i class="fas fa-briefcase-medical {{ $injury->injury_playable ? 'text-yellow-300' : 'text-pretty-red' }} mr-1.5"></i>
											{{ $injury->injury->name }}
										</p>
									</div>
								</div>
							@endforeach
						@endif
					@else
						<p class="text-gray-500 dark:text-gray-300 border-t border-gray-150 dark:border-gray-650 pt-2">
							No hay jugadores lesionados
						</p>
					@endif
				</div>

			</div>


			<div class="mt-3 md:mt-0 md:pl-4">

				<p class="uppercase text-sm font-bold tracking-wider pb-3">tops</p>

				<table class="w-full">
					<thead>
						<tr class="border-b border-gray-300 dark:border-gray-550">
							<th class="text-xs font-normal text-left pb-2">JUGADOR</th>
							<th class="text-xs font-normal text-right">PPG</th>
							<th class="text-xs font-normal text-right">RPG</th>
							<th class="text-xs font-normal text-right">APG</th>
						</tr>
					</thead>
					<tbody>
						<tr class="border-b border-gray-200 dark:border-gray-650">
							<td style="min-width: 150px">
								<div class="flex items-center py-3">
									@if ($currentSeason->top_player($match->localTeam->id))
										<img src="{{ $currentSeason->top_player($match->localTeam->id) ? $currentSeason->top_player($match->localTeam->id)->player->getImg() : '' }}" alt="{{ $currentSeason->top_player($match->localTeam->id) ? $currentSeason->top_player($match->localTeam->id)->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover h-8 w-8">
									@endif
									<div class="flex flex-col leading-4 ml-2">
										<span class="text-sm">{{ $currentSeason->top_player($match->localTeam->id) ? $currentSeason->top_player($match->localTeam->id)->player->name : '-' }}</span>
										<div class="text-xs uppercase">
											<span>{{ $currentSeason->top_player($match->localTeam->id) ? ($currentSeason->top_player($match->localTeam->id)->player->team ? $currentSeason->top_player($match->localTeam->id)->player->team->short_name : 'N/D') : '' }}</span>
											<span class="mx-1">{{ $currentSeason->top_player($match->localTeam->id) ? '|' : '' }}</span>
											<span>{{ $currentSeason->top_player($match->localTeam->id) ? $currentSeason->top_player($match->localTeam->id)->player->position : '' }}</span>
										</div>
									</div>
								</div>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-base uppercase">{{ $currentSeason->top_player($match->localTeam->id) ? number_format($currentSeason->top_player($match->localTeam->id)->AVG_PTS, 1) : '-' }}</span>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-base uppercase">{{ $currentSeason->top_player($match->localTeam->id) ? number_format($currentSeason->top_player($match->localTeam->id)->AVG_REB, 1) : '-' }}</span>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-base uppercase">{{ $currentSeason->top_player($match->localTeam->id) ? number_format($currentSeason->top_player($match->localTeam->id)->AVG_AST, 1) : '-' }}</span>
							</td>
						</tr>

						<tr>
							<td style="min-width: 150px">
								<div class="flex items-center py-3">
									@if ($currentSeason->top_player($match->visitorTeam->id))
										<img src="{{ $currentSeason->top_player($match->visitorTeam->id) ? $currentSeason->top_player($match->visitorTeam->id)->player->getImg() : '' }}" alt="{{ $currentSeason->top_player($match->visitorTeam->id) ? $currentSeason->top_player($match->visitorTeam->id)->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover h-8 w-8">
									@endif
									<div class="flex flex-col leading-4 ml-2">
										<span class="text-sm">{{ $currentSeason->top_player($match->visitorTeam->id) ? $currentSeason->top_player($match->visitorTeam->id)->player->name : '-' }}</span>
										<div class="text-xs uppercase">
											<span>{{ $currentSeason->top_player($match->visitorTeam->id) ? ($currentSeason->top_player($match->visitorTeam->id)->player->team ? $currentSeason->top_player($match->visitorTeam->id)->player->team->short_name : 'N/D') : '' }}</span>
											<span class="mx-1">{{ $currentSeason->top_player($match->visitorTeam->id) ? '|' : '' }}</span>
											<span>{{ $currentSeason->top_player($match->visitorTeam->id) ? $currentSeason->top_player($match->visitorTeam->id)->player->position : '' }}</span>
										</div>
									</div>
								</div>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-base uppercase">{{ $currentSeason->top_player($match->visitorTeam->id) ? number_format($currentSeason->top_player($match->visitorTeam->id)->AVG_PTS, 1) : '-' }}</span>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-base uppercase">{{ $currentSeason->top_player($match->visitorTeam->id) ? number_format($currentSeason->top_player($match->visitorTeam->id)->AVG_REB, 1) : '-' }}</span>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-base uppercase">{{ $currentSeason->top_player($match->visitorTeam->id) ? number_format($currentSeason->top_player($match->visitorTeam->id)->AVG_AST, 1) : '-' }}</span>
							</td>
						</tr>
					</tbody>
				</table>

			</div>

		</div> {{-- grid --}}
	</div>
</div>
