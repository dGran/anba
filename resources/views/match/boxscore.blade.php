<div class="{{ !$localBoxscoreReport && !$visitorBoxscoreReport ?: 'hidden' }} bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0 my-6">

	<div class="px-4 py-3">

		<div class="flex items-center justify-between border-b border-gray-150 dark:border-gray-650 pb-2">
			<p class="uppercase text-sm md:text-2xl font-bold tracking-wider">boxscore</p>
			<button class="text-sm focus:outline-none hover:underline focus:underline" wire:click="setOrder('default')">Orden por defecto</button>
		</div>

		{{-- @if ($players_stats) --}}

	        {{-- local --}}
	        <div class="mt-1.5 flex items-center text-sm md:text-base">
	            <img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->name }}" class="w-12 h-12 object-cover">
	            <div class="ml-2.5">
	                <span class="uppercase tracking-wider font-bold">{{ $match->localTeam->team->name }}</span>
	            </div>
	        </div>
	        @if ($match->hasLocalPlayerStats())
		        <div class="overflow-x-auto text-sm md:text-base">
		            @if ($match->localTeam->team->players->count()>0)
		                <table>
		                    <thead>
		                        <tr>
		                            <th class="text-left py-1.5 bg-white dark:bg-gray-750" style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;">JUGADOR</th>
		                            <th class="text-center"></th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'MIN')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('MIN_desc')">MIN<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'MIN_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('MIN')">MIN<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('MIN_desc')">MIN</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'PTS')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('PTS_desc')">PTS<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'PTS_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('PTS')">PTS<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('PTS_desc')">PTS</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'REB')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('REB_desc')">REB<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'REB_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('REB')">REB<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('REB_desc')">REB</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'AST')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('AST_desc')">AST<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'AST_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('AST')">AST<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('AST_desc')">AST</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'ROB')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('ROB_desc')">ROB<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'ROB_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('ROB')">ROB<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('ROB_desc')">ROB</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'TAP')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TAP_desc')">TAP<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'TAP_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TAP')">TAP<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('TAP_desc')">TAP</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'PER')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('PER_desc')">PER<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'PER_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('PER')">PER<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('PER_desc')">PER</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'FGM')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FGM_desc')">FGM<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'FGM_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FGM')">FGM<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('FGM_desc')">FGM</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'FGA')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FGA_desc')">FGA<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'FGA_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FGA')">FGA<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('FGA_desc')">FGA</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == '3PM')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('3PM_desc')">3PM<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == '3PM_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('3PM')">3PM<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('3PM_desc')">3PM</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == '3PA')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('3PA_desc')">3PA<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == '3PA_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('3PA')">3PA<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('3PA_desc')">3PA</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'TLM')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TLM_desc')">TLM<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'TLM_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TLM')">TLM<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('TLM_desc')">TLM</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'TLA')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TLA_desc')">TLA<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'TLA_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TLA')">TLA<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('TLA_desc')">TLA</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'RO')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('RO_desc')">RO<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'RO_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('RO')">RO<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('RO_desc')">RO</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'FP')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FP_desc')">FP<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'FP_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FP')">FP<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('FP_desc')">FP</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == '+/-')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('+/-_desc')">+/-<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == '+/-_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('+/-')">+/-<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('+/-_desc')">+/-</span>
										@endif
		                            </th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        @foreach ($players_stats as $key => $player)
		                            @if ($player['season_team_id'] == $match->localTeam->id)
		                                <tr class="border-t border-gray-150 dark:border-gray-650">
		                                    <td style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;" class="truncate bg-white dark:bg-gray-750">
		                                        <div class="flex items-center justify-between my-1 border-r border-gray-150 dark:border-gray-650">
		                                            <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-full border border-gray-150 dark:border-gray-650 w-8 h-8 object-cover" style="{{ $player['injury_id'] && !$player['injury_playable'] ? 'filter: grayscale(100%)' : '' }}">
		                                            <div class="flex-1 truncate ml-2">
		                                                <span class="truncate {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}">{{ $player['player_name'] }}</span>
		                                                <span class="truncate block text-gray-500 dark:text-gray-400 uppercase text-xxs">{{ $player['player_pos'] }} - {{ $player['player_position'] }}</span>
		                                            </div>
													@if ($player['injury_id'] && $player['injury_playable'])
														<span class="mr-3 rounded-full w-6 h-6 border border-transparent text-sm flex flex-wrap justify-center content-center bg-yellow-300">
															<i class="fas fa-briefcase-medical text-white pb-0.5"></i>
														</span>
			                                    	@endif
		                                        </div>
		                                    </td>
		                                    <td class="pl-3">
		                                    	@if ($player['headline'])
													<span class="rounded-full w-6 h-6 border border-gray-150 dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
														T
													</span>
												@endif
												@if ($player['injury_id'] && !$player['injury_playable'])
													<span class="rounded-full w-6 h-6 border border-transparent text-sm flex flex-wrap justify-center content-center bg-pretty-red">
														<i class="fas fa-briefcase-medical text-white pb-0.5"></i>
													</span>
		                                    	@endif
		                                    </td>
		                                    @if ($player['injury_id'] && !$player['injury_playable'])
		                                    	<td colspan="99" class="px-3 text-gray-500 dark:text-gray-400">
		                                    		{{ $player['injury_name'] }}
		                                    	</td>
		                                    @else
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['MIN']) && $player['MIN'] > 0 ? $player['MIN'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['PTS']) ? $player['PTS'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['REB']) ? $player['REB'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['AST']) ? $player['AST'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['STL']) ? $player['STL'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['BLK']) ? $player['BLK'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['LOS']) ? $player['LOS'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['FGM']) ? $player['FGM'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['FGA']) ? $player['FGA'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['TPM']) ? $player['TPM'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['TPA']) ? $player['TPA'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['FTM']) ? $player['FTM'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['FTA']) ? $player['FTA'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['ORB']) ? $player['ORB'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['PF']) ? $player['PF'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['ML']) ? $player['ML'] : '- '}}</span>
			                                    </td>
		                                    @endif
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
				<div class="text-sm py-1.5 w-full text-gray-500 dark:text-gray-300 animate-pulse">
					Reporte de estadísticas pendiente
				</div>
			@endif

	        {{-- visitor --}}
	        <div class="mt-6 flex items-center text-sm md:text-base">
	            <img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->name }}" class="w-12 h-12 object-cover">
	            <div class="ml-2.5">
	                <span class="uppercase tracking-wider font-bold">{{ $match->visitorTeam->team->name }}</span>
	            </div>
	        </div>
	        @if ($match->hasvisitorPlayerStats())
		        <div class="overflow-x-auto text-sm md:text-base">
		            @if ($match->visitorTeam->team->players->count()>0)
		                <table>
		                    <thead>
		                        <tr>
		                            <th class="text-left py-1.5 bg-white dark:bg-gray-750" style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;">JUGADOR</th>
		                            <th class="text-center"></th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'MIN')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('MIN_desc')">MIN<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'MIN_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('MIN')">MIN<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('MIN_desc')">MIN</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'PTS')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('PTS_desc')">PTS<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'PTS_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('PTS')">PTS<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('PTS_desc')">PTS</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'REB')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('REB_desc')">REB<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'REB_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('REB')">REB<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('REB_desc')">REB</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'AST')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('AST_desc')">AST<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'AST_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('AST')">AST<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('AST_desc')">AST</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'ROB')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('ROB_desc')">ROB<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'ROB_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('ROB')">ROB<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('ROB_desc')">ROB</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'TAP')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TAP_desc')">TAP<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'TAP_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TAP')">TAP<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('TAP_desc')">TAP</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'PER')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('PER_desc')">PER<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'PER_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('PER')">PER<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('PER_desc')">PER</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'FGM')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FGM_desc')">FGM<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'FGM_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FGM')">FGM<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('FGM_desc')">FGM</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'FGA')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FGA_desc')">FGA<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'FGA_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FGA')">FGA<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('FGA_desc')">FGA</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == '3PM')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('3PM_desc')">3PM<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == '3PM_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('3PM')">3PM<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('3PM_desc')">3PM</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == '3PA')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('3PA_desc')">3PA<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == '3PA_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('3PA')">3PA<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('3PA_desc')">3PA</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'TLM')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TLM_desc')">TLM<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'TLM_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TLM')">TLM<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('TLM_desc')">TLM</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'TLA')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TLA_desc')">TLA<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'TLA_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('TLA')">TLA<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('TLA_desc')">TLA</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'RO')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('RO_desc')">RO<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'RO_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('RO')">RO<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('RO_desc')">RO</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == 'FP')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FP_desc')">FP<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == 'FP_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('FP')">FP<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('FP_desc')">FP</span>
										@endif
		                            </th>
		                            <th class="text-center w-14 select-none">
										@if ($boxscore_order == '+/-')
									    	<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('+/-_desc')">+/-<i class="fas fa-sort-amount-up-alt pl-1 text-xs"></i></span>
											</div>
										@elseif ($boxscore_order == '+/-_desc')
											<div class="w-14 flex items-center justify-center">
												<span class="cursor-pointer" wire:click="setOrder('+/-')">+/-<i class="fas fa-sort-amount-down pl-1 text-xs"></i></span>
											</div>
										@else
											<span class="cursor-pointer" wire:click="setOrder('+/-_desc')">+/-</span>
										@endif
		                            </th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        @foreach ($players_stats as $key => $player)
		                            @if ($player['season_team_id'] == $match->visitorTeam->id)
		                                <tr class="border-t border-gray-150 dark:border-gray-650">
		                                    <td style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;" class="truncate bg-white dark:bg-gray-750">
		                                        <div class="flex items-center justify-between my-1 border-r border-gray-150 dark:border-gray-650">
		                                            <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-full border border-gray-150 dark:border-gray-650 w-8 h-8 object-cover" style="{{ $player['injury_id'] && !$player['injury_playable'] ? 'filter: grayscale(100%)' : '' }}">
		                                            <div class="flex-1 truncate ml-2">
		                                                <span class="truncate {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}">{{ $player['player_name'] }}</span>
		                                                <span class="truncate block text-gray-500 dark:text-gray-400 uppercase text-xxs">{{ $player['player_pos'] }} - {{ $player['player_position'] }}</span>
		                                            </div>
													@if ($player['injury_id'] && $player['injury_playable'])
														<span class="mr-3 rounded-full w-6 h-6 border border-transparent text-sm flex flex-wrap justify-center content-center bg-yellow-300">
															<i class="fas fa-briefcase-medical text-white pb-0.5"></i>
														</span>
			                                    	@endif
		                                        </div>
		                                    </td>
		                                    <td class="pl-3">
		                                    	@if ($player['headline'])
													<span class="rounded-full w-6 h-6 border border-gray-150 dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
														T
													</span>
												@endif
												@if ($player['injury_id'] && !$player['injury_playable'])
													<span class="rounded-full w-6 h-6 border border-transparent text-sm flex flex-wrap justify-center content-center bg-pretty-red">
														<i class="fas fa-briefcase-medical text-white pb-0.5"></i>
													</span>
		                                    	@endif
		                                    </td>
		                                    @if ($player['injury_id'] && !$player['injury_playable'])
		                                    	<td colspan="99" class="px-3 text-gray-500 dark:text-gray-400">
		                                    		{{ $player['injury_name'] }}
		                                    	</td>
		                                    @else
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['MIN']) && $player['MIN'] > 0 ? $player['MIN'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['PTS']) ? $player['PTS'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['REB']) ? $player['REB'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['AST']) ? $player['AST'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['STL']) ? $player['STL'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['BLK']) ? $player['BLK'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['LOS']) ? $player['LOS'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['FGM']) ? $player['FGM'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['FGA']) ? $player['FGA'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['TPM']) ? $player['TPM'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['TPA']) ? $player['TPA'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['FTM']) ? $player['FTM'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['FTA']) ? $player['FTA'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['ORB']) ? $player['ORB'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['PF']) ? $player['PF'] : '-' }}</span>
			                                    </td>
			                                    <td class="text-center w-14 {{ $player['injury_id'] && !$player['injury_playable'] ? 'text-gray-500 dark:text-gray-400' : '' }}" style="min-width: 2.5rem">
			                                    	<span>{{ isset($player['ML']) ? $player['ML'] : '- '}}</span>
			                                    </td>
											@endif
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
				<div class="text-sm py-1.5 w-full text-gray-500 dark:text-gray-300 animate-pulse">
					Reporte de estadísticas pendiente
				</div>
			@endif

{{-- 		@else
			<div class="text-sm py-2.5 w-full text-gray-500 dark:text-gray-300">
				No hay estadísticas registradas
			</div>
		@endif --}}

	</div>

</div>