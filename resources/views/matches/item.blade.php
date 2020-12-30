<div class="flex gap-4">
	<div class="bg-white dark:bg-gray-750 dark:text-white shadow-md rounded mx-3 md:mx-0 mb-6 w-full lg:w-4/6">
		<div class="flex">

			<div class="score w-full md:w-1/2 md:border-r border-gray-200 dark:border-gray-700">
				<div class="flex justify-between items-center py-3">
					<div class="flex-1">
						<img src="{{ $reg->localTeam->team->getImg() }}" alt="{{ $reg->localTeam->team->short_name }}" style="width: 52px; height: 52px" class="mb-3 mx-auto">
						<div class="text-center text-sm">{{ $reg->localTeam->team->medium_name }}</div>
					</div>

					<div class="flex-1 mx-3 text-center">
				    	<p class="text-xs">{{ $reg->stadium }}</p>
				    	<p class="font-bold text-3xl">{{ $reg->score() }}</p>
				    	{{-- <p class="text-xs">{{ $reg->scores ? $reg->scores->first()->updated_at : '' }}</p> --}}
					</div>

				    <div class="flex-1">
						<img src="{{ $reg->visitorTeam->team->getImg() }}" alt="{{ $reg->visitorTeam->team->short_name }}" style="width: 52px; height: 52px" class="mb-3 mx-auto">
						<div class="text-center text-sm">{{ $reg->visitorTeam->team->medium_name }}</div>
				    </div>
				</div>

				<div class="border-t border-gray-200 dark:border-gray-700 py-4 px-3 text-center">
					<a href="" class="uppercase font-bold text-sm text-blue-500 dark:text-dark-link hover:bg-blue-500 dark:hover:bg-dark-link focus:bg-blue-500 dark:focus:bg-dark-link hover:text-white dark:focus:text-gray-700 dark:hover:text-gray-700 focus:text-white focus:outline-none rounded px-2.5 py-1">
						boxscore
					</a>
				</div>
			</div>


			<div class="details hidden md:block md:w-1/2 p-4">
				<p class="text-xs font-bold">Game Leaders</p>
				<table class="w-full mt-1">
					<thead>
						<tr class="border-b border-gray-300 dark:border-gray-600">
							<th class="text-xs font-normal text-left pb-1">JUGADOR</th>
							<th class="text-xs font-normal text-right">PTS</th>
							<th class="text-xs font-normal text-right">REB</th>
							<th class="text-xs font-normal text-right">AST</th>
						</tr>
					</thead>
					<tbody>
						<tr class="border-b border-gray-200 dark:border-gray-700">
							<td style="min-width: 150px">
								<div class="flex items-center gap-2 py-2">
									@if ($reg->top_local_player())
										<img src="{{ $reg->top_local_player() ? $reg->top_local_player()->player->getImg() : '' }}" alt="{{ $reg->top_local_player() ? $reg->top_local_player()->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-700 object-cover" style="width: 24px; height: 24px">
									@endif
									<div class="flex flex-col leading-3">
										<span class="text-xs">{{ $reg->top_local_player() ? $reg->top_local_player()->player->name : '-' }}</span>
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
								<div class="flex items-center gap-2 py-2">
									@if ($reg->top_visitor_player())
										<img src="{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->getImg() : '' }}" alt="{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->name : '' }}" class="rounded-full border border-gray-200 dark:border-gray-700 object-cover" style="width: 24px; height: 24px">
									@endif
									<div class="flex flex-col leading-3">
										<span class="text-xs">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->name : '-' }}</span>
										<div>
											<span class="text-xs uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->team->short_name : '' }}</span>
											<span class="text-xs uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->player->position : '' }}</span>
										</div>
									</div>
								</div>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-sm uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->PTS : '-' }}</span>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-sm uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->REB : '-' }}</span>
							</td>
							<td style="min-width: 40px" class="text-right">
								<span class="text-sm uppercase">{{ $reg->top_visitor_player() ? $reg->top_visitor_player()->AST : '-' }}</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="bg-white dark:bg-gray-750 dark:text-white shadow-md rounded mx-3 md:mx-0 mb-6 w-2/6 hidden lg:block">
		<div class="flex overflow-y-auto text-xs">
			@php
			foreach ($teams_table_data as $team_table_date) {
				if ($team_table_date['team']['id'] == $reg->localTeam->id) {
					$local_team_data = $team_table_date;
				}
				if ($team_table_date['team']['id'] == $reg->visitorTeam->id) {
					$visitor_team_data = $team_table_date;
				}
			}
			@endphp
			<div class="flex-1 border-r border-gray-200 dark:border-gray-700 p-4">
				<div class="flex items-center border-b border-gray-200 dark:border-gray-700 gap-2">
					<img src="{{ $reg->localTeam->team->getImg() }}" alt="{{ $reg->localTeam->team->short_name }}" style="width: 32px; height: 32px" class="mb-1">
					<div class="text-sm">{{ $reg->localTeam->team->medium_name }}</div>
				</div>
				<div class="pt-1 flex pt-3">
					<p class="font-bold text-right" style="width: 25px">
						{{ $local_team_data['conference_position'] }}º
					</p>
					<p class="pl-2">{{ $reg->localTeam->seasonDivision->seasonConference->conference->name }}</p>
				</div>
				<div class="pt-1 flex">
					<p class="font-bold text-right" style="width: 25px">
						{{ $local_team_data['division_position'] }}º
					</p>
					<p class="pl-2">{{ $reg->localTeam->seasonDivision->division->name }}</p>
				</div>
				@if (!$reg->played())
					<div class="pt-1 flex">
						<p class="font-bold text-right" style="width: 25px">
							{{ $local_team_data['streak'] > 0 ? 'W' : 'L' }} {{ abs($local_team_data['streak']) }}
						</p>
						<p class="pl-2">Racha</p>
					</div>
					<div class="pt-1 flex">
						<p class="font-bold text-right" style="width: 25px">
							{{ $local_team_data['last10_w'] }}-{{ $local_team_data['last10_l'] }}
						</p>
						<p class="pl-2">Últimos 10</p>
					</div>
				@endif
			</div>
			<div class="flex-1 border-r border-gray-200 dark:border-gray-700 p-4">
				<div class="flex items-center border-b border-gray-200 dark:border-gray-700 gap-2">
					<img src="{{ $reg->visitorTeam->team->getImg() }}" alt="{{ $reg->visitorTeam->team->short_name }}" style="width: 32px; height: 32px" class="mb-1">
					<div class="text-sm">{{ $reg->visitorTeam->team->medium_name }}</div>
				</div>
				<div class="pt-1 flex pt-3">
					<p class="font-bold text-right" style="width: 25px">
						{{ $visitor_team_data['conference_position'] }}º
					</p>
					<p class="pl-2">{{ $reg->visitorTeam->seasonDivision->seasonConference->conference->name }}</p>
				</div>
				<div class="pt-1 flex">
					<p class="font-bold text-right" style="width: 25px">
						{{ $visitor_team_data['division_position'] }}º
					</p>
					<p class="pl-2">{{ $reg->visitorTeam->seasonDivision->division->name }}</p>
				</div>
				@if (!$reg->played())
					<div class="pt-1 flex">
						<p class="font-bold text-right" style="width: 25px">
							{{ $visitor_team_data['streak'] > 0 ? 'W' : 'L' }} {{ abs($visitor_team_data['streak']) }}
						</p>
						<p class="pl-2">Racha</p>
					</div>
					<div class="pt-1 flex">
						<p class="font-bold text-right" style="width: 25px">
							{{ $visitor_team_data['last10_w'] }}-{{ $visitor_team_data['last10_l'] }}
						</p>
						<p class="pl-2">Últimos 10</p>
					</div>
				@endif
			</div>
{{-- 			<button class="text-xs tracking-widest uppercase bg-blue-500 hover:bg-blue-600 text-white leading-6 rounded px-2.5 py-1">
				partidos
			</button> --}}
		</div>
	</div>
</div>