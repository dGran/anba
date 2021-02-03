<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0 my-6">

	<div class="px-4 py-3">

		<p class="uppercase text-sm md:text-2xl font-bold tracking-wider border-b border-gray-150 dark:border-gray-650 pb-2">boxscore</p>

		@if ($players_stats)

	        {{-- local --}}
	        <div class="mt-1.5 flex items-center text-sm md:text-base">
	            <img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->name }}" class="w-12 h-12 object-cover">
	            <div class="ml-2.5">
	                <span class="uppercase tracking-wider font-bold">{{ $match->localTeam->team->name }}</span>
	            </div>
	        </div>
	        <div class="overflow-x-auto text-sm md:text-base">
	            @if ($match->localTeam->team->players->count()>0)
	                <table>
	                    <thead>
	                        <tr>
	                            <th class="text-left py-1.5 bg-white dark:bg-gray-750" style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;">JUGADOR</th>
	                            <th class="text-center"></th>
	                            <th class="text-center w-14">MIN</th>
	                            <th class="text-center w-14">PTS</th>
	                            <th class="text-center w-14">REB</th>
	                            <th class="text-center w-14">AST</th>
	                            <th class="text-center w-14">ROB</th>
	                            <th class="text-center w-14">TAP</th>
	                            <th class="text-center w-14">PER</th>
	                            <th class="text-center w-14">FGM</th>
	                            <th class="text-center w-14">FGA</th>
	                            <th class="text-center w-14">3PM</th>
	                            <th class="text-center w-14">3PA</th>
	                            <th class="text-center w-14">TLM</th>
	                            <th class="text-center w-14">TLA</th>
	                            <th class="text-center w-14">RO</th>
	                            <th class="text-center w-14">FP</th>
	                            <th class="text-center w-14">+/-</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach ($players_stats as $key => $player)
	                            @if ($player['team_id'] == $match->localTeam->team->id)
	                                <tr class="border-t border-gray-150 dark:border-gray-650">
	                                    <td style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;" class="truncate bg-white dark:bg-gray-750">
	                                        <div class="flex items-center justify-between my-1 border-r border-gray-150 dark:border-gray-650">
	                                            <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-full border border-gray-150 dark:border-gray-650 w-8 h-8 object-cover" style="{{ $player['player_injury'] ? 'filter: grayscale(100%)' : '' }}">
	                                            <div class="flex-1 truncate ml-2">
	                                                <span class="truncate {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}">{{ $player['player_name'] }}</span>
	                                                <span class="truncate block text-gray-500 dark:text-gray-400 uppercase text-xxs">{{ $player['player_pos'] }} - {{ $player['player_position'] }}</span>
	                                            </div>
	                                        </div>
	                                    </td>
	                                    <td class="pl-3">
	                                    	@if ($player['headline'])
												<span class="rounded-full w-6 h-6 border border-gray-150 dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
													T
												</span>
											@endif
											@if ($player['player_injury'])
												<span class="rounded-full w-6 h-6 border border-transparent text-sm flex flex-wrap justify-center content-center bg-pretty-red">
													<i class="fas fa-briefcase-medical text-white pb-0.5"></i>
												</span>
	                                    	@endif
	                                    </td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['MIN'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['PTS'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['REB'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['AST'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['STL'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['BLK'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['LOS'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['FGM'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['FGA'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['TPM'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['TPA'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['FTM'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['FTA'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['ORB'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['PF'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['ML'] ?: '- '}}</span></td>
	                                </tr>
	                            @endif
	                        @endforeach
	                    </tbody>
	                </table>
	            @else
	                <div class="p-3 border-top border-gray-150 dark:border-gray-650">
	                    No hay jugadores
	                </div>
	            @endif
	        </div>

	        {{-- visitor --}}
	        <div class="mt-3 flex items-center text-sm md:text-base">
	            <img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->name }}" class="w-12 h-12 object-cover">
	            <div class="ml-2.5">
	                <span class="uppercase tracking-wider font-bold">{{ $match->visitorTeam->team->name }}</span>
	            </div>
	        </div>
	        <div class="overflow-x-auto text-sm md:text-base">
	            @if ($match->visitorTeam->team->players->count()>0)
	                <table>
	                    <thead>
	                        <tr>
	                            <th class="text-left py-1.5 bg-white dark:bg-gray-750" style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;">JUGADOR</th>
	                            <th class="text-center"></th>
	                            <th class="text-center w-14">MIN</th>
	                            <th class="text-center w-14">PTS</th>
	                            <th class="text-center w-14">REB</th>
	                            <th class="text-center w-14">AST</th>
	                            <th class="text-center w-14">ROB</th>
	                            <th class="text-center w-14">TAP</th>
	                            <th class="text-center w-14">PER</th>
	                            <th class="text-center w-14">FGM</th>
	                            <th class="text-center w-14">FGA</th>
	                            <th class="text-center w-14">3PM</th>
	                            <th class="text-center w-14">3PA</th>
	                            <th class="text-center w-14">TLM</th>
	                            <th class="text-center w-14">TLA</th>
	                            <th class="text-center w-14">RO</th>
	                            <th class="text-center w-14">FP</th>
	                            <th class="text-center w-14">+/-</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach ($players_stats as $key => $player)
	                            @if ($player['team_id'] == $match->visitorTeam->team->id)
	                                <tr class="border-t border-gray-150 dark:border-gray-650">
	                                    <td style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;" class="truncate bg-white dark:bg-gray-750">
	                                        <div class="flex items-center justify-between my-1 border-r border-gray-150 dark:border-gray-650">
	                                            <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-full border border-gray-150 dark:border-gray-650 w-8 h-8 object-cover" style="{{ $player['player_injury'] ? 'filter: grayscale(100%)' : '' }}">
	                                            <div class="flex-1 truncate ml-2">
	                                                <span class="truncate {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}">{{ $player['player_name'] }}</span>
	                                                <span class="truncate block text-gray-500 dark:text-gray-400 uppercase text-xxs">{{ $player['player_pos'] }} - {{ $player['player_position'] }}</span>
	                                            </div>
	                                        </div>
	                                    </td>
	                                    <td class="pl-3">
	                                    	@if ($player['headline'])
												<span class="rounded-full w-6 h-6 border border-gray-150 dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
													T
												</span>
											@endif
											@if ($player['player_injury'])
												<span class="rounded-full w-6 h-6 border border-transparent text-sm flex flex-wrap justify-center content-center bg-pretty-red">
													<i class="fas fa-briefcase-medical text-white pb-0.5"></i>
												</span>
	                                    	@endif
	                                    </td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['MIN'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['PTS'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['REB'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['AST'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['STL'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['BLK'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['LOS'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['FGM'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['FGA'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['TPM'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['TPA'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['FTM'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['FTA'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['ORB'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['PF'] ?: '-' }}</span></td>
	                                    <td class="text-center w-14 {{ $player['player_injury'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem"><span>{{ $player['ML'] ?: '- '}}</span></td>
	                                </tr>
	                            @endif
	                        @endforeach
	                    </tbody>
	                </table>
	            @else
	                <div class="p-3 border-top border-gray-150 dark:border-gray-650">
	                    No hay jugadores
	                </div>
	            @endif
	        </div>

		@else
			<div class="text-sm py-2.5 w-full text-gray-500 dark:text-gray-300">
				No hay estadísticas registradas
			</div>
		@endif

	</div>

</div>