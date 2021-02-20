<div class="leaders hidden sm:block md:w-1/2 p-4 border-l border-gray-200 dark:border-gray-650">
	<p class="uppercase pb-3 text-sm font-bold tracking-wider">{{ $reg->played() ? 'Game Leaders' : 'Season Leaders' }}</p>

	<table class="w-full mt-1">
		<thead>
			<tr class="border-b border-gray-300 dark:border-gray-550">
				<th class="text-xs font-normal text-left pb-2">JUGADOR</th>
				@if ($reg->played())
					<th class="text-xs font-normal text-right">PTS</th>
					<th class="text-xs font-normal text-right">REB</th>
					<th class="text-xs font-normal text-right">AST</th>
				@else
					<th class="text-xs font-normal text-right">PPG</th>
					<th class="text-xs font-normal text-right">RPG</th>
					<th class="text-xs font-normal text-right">APG</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@if ($reg->played())

				<tr class="border-b border-gray-200 dark:border-gray-650">
					<td style="min-width: 150px">
						<div class="flex items-center py-3">
							@php
								$top_local_player = $reg->top_local_player();
							@endphp
							@if ($top_local_player)
								<img src="{{ $top_local_player->player_img ? asset('storage/' . $top_local_player->player_img) : asset('storage/players/default.png') }}" alt="{{ $top_local_player ? $top_local_player->player_name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 26px; height: 26px">
							@endif
							<div class="flex flex-col ml-2 leading-3">
								<span class="text-sm">{{ $top_local_player ? $top_local_player->player_name : '-' }}</span>
								<div class="text-xs uppercase leading-5">
									<span>{{ $top_local_player ? $top_local_player->team_short_name : '' }}</span>
									<span class="mx-1">{{ $top_local_player ? '|' : '' }}</span>
									<span>{{ $top_local_player ? $top_local_player->player_position : '' }}</span>
								</div>
							</div>
						</div>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->PTS : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->REB : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->AST : '-' }}</span>
					</td>
				</tr>

				<tr>
					<td style="min-width: 150px">
						<div class="flex items-center py-3">
							@php
								$top_visitor_player = $reg->top_visitor_player();
							@endphp
							@if ($top_visitor_player)
								<img src="{{ $top_visitor_player->player_img ? asset('storage/' . $top_visitor_player->player_img) : asset('storage/players/default.png') }}" alt="{{ $top_visitor_player ? $top_visitor_player->player_name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 26px; height: 26px">
							@endif
							<div class="flex flex-col ml-2 leading-3">
								<span class="text-sm">{{ $top_visitor_player ? $top_visitor_player->player_name : '-' }}</span>
								<div class="text-xs uppercase leading-5">
									<span>{{ $top_visitor_player ? $top_visitor_player->team_short_name : '' }}</span>
									<span class="mx-1">{{ $top_visitor_player ? '|' : '' }}</span>
									<span>{{ $top_visitor_player ? $top_visitor_player->player_position : '' }}</span>
								</div>
							</div>
						</div>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->PTS : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->REB : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->AST : '-' }}</span>
					</td>
				</tr>

			@else

				<tr class="border-b border-gray-200 dark:border-gray-650">
					<td style="min-width: 150px">
						<div class="flex items-center py-3">
							@php
								$season_top_local_player = $current_season->top_player($reg->localTeam->id);
							@endphp
							@if ($season_top_local_player)
								<img src="{{ $season_top_local_player ? $season_top_local_player->player->getImg() : '' }}" alt="{{ $season_top_local_player ? $season_top_local_player->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 26px; height: 26px">
							@endif
							<div class="flex flex-col leading-3 ml-2">
								<span class="text-sm">{{ $season_top_local_player ? $season_top_local_player->player->name : '-' }}</span>
								<div class="text-xs uppercase leading-5">
									<span>{{ $season_top_local_player ? $season_top_local_player->player->team->short_name : '' }}</span>
									<span class="mx-1">{{ $season_top_local_player ? '|' : '' }}</span>
									<span>{{ $season_top_local_player ? $season_top_local_player->player->position : '' }}</span>
								</div>
							</div>
						</div>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $season_top_local_player ? number_format($season_top_local_player->AVG_PTS, 1) : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $season_top_local_player ? number_format($season_top_local_player->AVG_REB, 1) : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $season_top_local_player ? number_format($season_top_local_player->AVG_AST, 1) : '-' }}</span>
					</td>
				</tr>

				<tr>
					<td style="min-width: 150px">
						<div class="flex items-center py-3">
							@php
								$season_top_visitor_player = $current_season->top_player($reg->visitorTeam->id);
							@endphp
							@if ($season_top_visitor_player)
								<img src="{{ $season_top_visitor_player ? $season_top_visitor_player->player->getImg() : '' }}" alt="{{ $season_top_visitor_player ? $season_top_visitor_player->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 26px; height: 26px">
							@endif
							<div class="flex flex-col leading-3 ml-2">
								<span class="text-sm">{{ $season_top_visitor_player ? $season_top_visitor_player->player->name : '-' }}</span>
								<div class="text-xs uppercase leading-5">
									<span>{{ $season_top_visitor_player ? $season_top_visitor_player->player->team->short_name : '' }}</span>
									<span class="mx-1">{{ $season_top_visitor_player ? '|' : '' }}</span>
									<span>{{ $season_top_visitor_player ? $season_top_visitor_player->player->position : '' }}</span>
								</div>
							</div>
						</div>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $season_top_visitor_player ? number_format($season_top_visitor_player->AVG_PTS, 1) : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $season_top_visitor_player ? number_format($season_top_visitor_player->AVG_REB, 1) : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $season_top_visitor_player ? number_format($season_top_visitor_player->AVG_AST, 1) : '-' }}</span>
					</td>
				</tr>

			@endif
		</tbody>
	</table>
</div>