<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-8">
	<div class="px-4 py-3">

		<div class="grid grid-cols-1 md:grid-cols-2">

			<div class="md:border-r border-gray-150 dark:border-gray-650 md:pr-4">
				<p class="uppercase text-sm font-bold tracking-wider pb-3">bajas para el partido</p>

				<div class="text-sm py-2.5 w-full border-t border-gray-150 dark:border-gray-650 text-gray-500 dark:text-gray-300">
					No hay jugadores lesionados
				</div>

			</div>


			<div class="mt-3 md:mt-0 md:pl-4">

				<p class="uppercase text-sm font-bold tracking-wider pb-3">tops</p>

				<table class="w-full mt-1">
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
										<img src="{{ $currentSeason->top_player($match->localTeam->id) ? $currentSeason->top_player($match->localTeam->id)->player->getImg() : '' }}" alt="{{ $currentSeason->top_player($match->localTeam->id) ? $currentSeason->top_player($match->localTeam->id)->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 32px; height: 32px">
									@endif
									<div class="flex flex-col leading-3 ml-2">
										<span class="text-sm">{{ $currentSeason->top_player($match->localTeam->id) ? $currentSeason->top_player($match->localTeam->id)->player->name : '-' }}</span>
										<div class="text-xs uppercase leading-5">
											<span>{{ $currentSeason->top_player($match->localTeam->id) ? $currentSeason->top_player($match->localTeam->id)->player->team->short_name : '' }}</span>
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
										<img src="{{ $currentSeason->top_player($match->visitorTeam->id) ? $currentSeason->top_player($match->visitorTeam->id)->player->getImg() : '' }}" alt="{{ $currentSeason->top_player($match->visitorTeam->id) ? $currentSeason->top_player($match->visitorTeam->id)->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 32px; height: 32px">
									@endif
									<div class="flex flex-col leading-3 ml-2">
										<span class="text-sm">{{ $currentSeason->top_player($match->visitorTeam->id) ? $currentSeason->top_player($match->visitorTeam->id)->player->name : '-' }}</span>
										<div class="text-xs uppercase leading-5">
											<span>{{ $currentSeason->top_player($match->visitorTeam->id) ? $currentSeason->top_player($match->visitorTeam->id)->player->team->short_name : '' }}</span>
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