<div class="leaders hidden md:block md:w-1/2 p-4">
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
								<img src="{{ $reg->top_local_player() ? $reg->top_local_player()->player->getImg() : '' }}" alt="{{ $reg->top_local_player() ? $reg->top_local_player()->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 24px; height: 24px">
							@endif
							<div class="flex flex-col leading-3">
								<span class="text-sm">{{ $reg->top_local_player() ? $reg->top_local_player()->player->name : '-' }}</span>
								<div>
									<span class="text-xs uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->player->team->short_name : '' }}</span>
									<span class="text-xs uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->player->position : '' }}</span>
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
								<img src="{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->getImg() : '' }}" alt="{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 24px; height: 24px">
							@endif
							<div class="flex flex-col leading-3">
								<span class="text-sm">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->name : '-' }}</span>
								<div>
									<span class="text-xs uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->team->short_name : '' }}</span>
									<span class="text-xs uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->position : '' }}</span>
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
						{{-- {{ $reg->localTeam->team->playersStats($current_season->id) }} --}}
						<div class="flex items-center gap-2 py-3">
							@if ($reg->top_local_player())
								<img src="{{ $reg->top_local_player() ? $reg->top_local_player()->player->getImg() : '' }}" alt="{{ $reg->top_local_player() ? $reg->top_local_player()->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 24px; height: 24px">
							@endif
							<div class="flex flex-col leading-3">
								<span class="text-sm">{{ $reg->top_local_player() ? $reg->top_local_player()->player->name : '-' }}</span>
								<div>
									<span class="text-xs uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->player->team->short_name : '' }}</span>
									<span class="text-xs uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->player->position : '' }}</span>
								</div>
							</div>
						</div>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-sm uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->PTS : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-sm uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->REB : '-' }}</span>
					</td>
					<td style="min-width: 40px" class="text-right">
						<span class="text-sm uppercase">{{ $reg->top_local_player() ? $reg->top_local_player()->AST : '-' }}</span>
					</td>
				</tr>

				<tr>
					<td style="min-width: 150px">
						<div class="flex items-center gap-2 py-3">
							@if ($reg->top_visitor_player())
								<img src="{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->getImg() : '' }}" alt="{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover" style="width: 24px; height: 24px">
							@endif
							<div class="flex flex-col leading-3">
								<span class="text-sm">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->name : '-' }}</span>
								<div>
									<span class="text-xs uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->team->short_name : '' }}</span>
									<span class="text-xs uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->position : '' }}</span>
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
			@endif
		</tbody>
	</table>
</div>