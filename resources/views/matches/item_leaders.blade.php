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
						<div class="flex items-center gap-2 py-3">
							@if ($reg->top_local_player())
								<img src="{{ $reg->top_local_player() ? $reg->top_local_player()->player->getImg() : '' }}" alt="{{ $reg->top_local_player() ? $reg->top_local_player()->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 26px; height: 26px">
							@endif
							<div class="flex flex-col leading-3">
								<span class="text-sm">{{ $reg->top_local_player() ? $reg->top_local_player()->player->name : '-' }}</span>
								<div class="text-xs uppercase leading-5">
									<span>{{ $reg->top_local_player() ? $reg->top_local_player()->player->team->short_name : '' }}</span>
									<span class="mx-1">{{ $reg->top_local_player() ? '|' : '' }}</span>
									<span>{{ $reg->top_local_player() ? $reg->top_local_player()->player->position : '' }}</span>
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
						<div class="flex items-center gap-2 py-3">
							@if ($reg->top_visitor_player())
								<img src="{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->getImg() : '' }}" alt="{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 26px; height: 26px">
							@endif
							<div class="flex flex-col leading-3">
								<span class="text-sm">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->name : '-' }}</span>
								<div class="text-xs uppercase leading-5">
									<span>{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->team->short_name : '' }}</span>
									<span class="mx-1">{{ $reg->top_visitor_player() ? '|' : '' }}</span>
									<span>{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->position : '' }}</span>
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
						<div class="flex items-center gap-2 py-3">
							@if ($current_season->top_player($reg->localTeam->id))
								<img src="{{ $current_season->top_player($reg->localTeam->id) ? $current_season->top_player($reg->localTeam->id)->player->getImg() : '' }}" alt="{{ $current_season->top_player($reg->localTeam->id) ? $current_season->top_player($reg->localTeam->id)->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 26px; height: 26px">
							@endif
							<div class="flex flex-col leading-3">
								<span class="text-sm">{{ $current_season->top_player($reg->localTeam->id) ? $current_season->top_player($reg->localTeam->id)->player->name : '-' }}</span>
								<div class="text-xs uppercase leading-5">
									<span>{{ $current_season->top_player($reg->localTeam->id) ? $current_season->top_player($reg->localTeam->id)->player->team->short_name : '' }}</span>
									<span class="mx-1">{{ $current_season->top_player($reg->localTeam->id) ? '|' : '' }}</span>
									<span>{{ $current_season->top_player($reg->localTeam->id) ? $current_season->top_player($reg->localTeam->id)->player->position : '' }}</span>
								</div>
							</div>
						</div>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $current_season->top_player($reg->localTeam->id) ? number_format($current_season->top_player($reg->localTeam->id)->AVG_PTS, 1) : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $current_season->top_player($reg->localTeam->id) ? number_format($current_season->top_player($reg->localTeam->id)->AVG_REB, 1) : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $current_season->top_player($reg->localTeam->id) ? number_format($current_season->top_player($reg->localTeam->id)->AVG_AST, 1) : '-' }}</span>
					</td>
				</tr>

				<tr>
					<td style="min-width: 150px">
						<div class="flex items-center gap-2 py-3">
							@if ($current_season->top_player($reg->visitorTeam->id))
								<img src="{{ $current_season->top_player($reg->visitorTeam->id) ? $current_season->top_player($reg->visitorTeam->id)->player->getImg() : '' }}" alt="{{ $current_season->top_player($reg->visitorTeam->id) ? $current_season->top_player($reg->visitorTeam->id)->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 26px; height: 26px">
							@endif
							<div class="flex flex-col leading-3">
								<span class="text-sm">{{ $current_season->top_player($reg->visitorTeam->id) ? $current_season->top_player($reg->visitorTeam->id)->player->name : '-' }}</span>
								<div class="text-xs uppercase leading-5">
									<span>{{ $current_season->top_player($reg->visitorTeam->id) ? $current_season->top_player($reg->visitorTeam->id)->player->team->short_name : '' }}</span>
									<span class="mx-1">{{ $current_season->top_player($reg->visitorTeam->id) ? '|' : '' }}</span>
									<span>{{ $current_season->top_player($reg->visitorTeam->id) ? $current_season->top_player($reg->visitorTeam->id)->player->position : '' }}</span>
								</div>
							</div>
						</div>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $current_season->top_player($reg->visitorTeam->id) ? number_format($current_season->top_player($reg->visitorTeam->id)->AVG_PTS, 1) : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $current_season->top_player($reg->visitorTeam->id) ? number_format($current_season->top_player($reg->visitorTeam->id)->AVG_REB, 1) : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-base uppercase">{{ $current_season->top_player($reg->visitorTeam->id) ? number_format($current_season->top_player($reg->visitorTeam->id)->AVG_AST, 1) : '-' }}</span>
					</td>
				</tr>

			@endif
		</tbody>
	</table>
</div>