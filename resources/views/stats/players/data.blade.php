@if ($season)
	@if (count($players_stats) > 0)
		<div class="bg-white dark:bg-gray-750 overflow-x-auto md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
			<table class="players-stats">
				<thead>
					<tr class="text-gray-600 bg-gray-150 dark:bg-gray-700 dark:text-gray-100 select-none">
						<th class="text-right" style="min-width: 1.5rem"></th>
						<th class="bg-gray-150 dark:bg-gray-700 hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'player_name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'player_name' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'player_name' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('player_name')"
						style="width: 8rem; min-width: 8rem; max-width: 8rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
							Jugador
						</th>
						<th class="w-16 text-right" style="min-width: 4.5rem;">
							POS
						</th>
						<th class="w-16 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'teams.short_name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'teams.short_name' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'teams.short_name' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('teams.short_name')"
						style="min-width: 4.5rem">
							Equipo
						</th>
						<th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AGE' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AGE' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AGE' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AGE')"
						style="min-width: 3rem">
							Edad
						</th>
						<th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PJ' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PJ' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PJ' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('PJ')">
							PJ
						</th>
						<th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PT' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PT' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('PT')">
							PT
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_MIN' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_MIN' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_MIN' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_MIN' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_MIN' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_MIN' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('MIN')">
							MIN
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_PTS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_PTS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PTS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PTS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('PTS')">
							PTS
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FGM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FGM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('FGM')">
							FGM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FGA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FGA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('FGA')">
							FGA
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PER_FG' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PER_FG' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PER_FG' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('PER_FG')">
							FG%
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_TPM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_TPM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('TPM')">
							3PM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_TPA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_TPA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('TPA')">
							3PA
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PER_TP' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PER_TP' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PER_TP' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('PER_TP')">
							3P%
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FTM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FTM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('FTM')">
							TLM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FTA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FTA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('FTA')">
							TLA
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PER_FT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PER_FT' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PER_FT' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('PER_FT')">
							TL%
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_ORB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_ORB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ORB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ORB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('ORB')">
							R.O
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_DRB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_DRB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_DRB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_DRB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('DRB')">
							R.D
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_REB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_REB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_REB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_REB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('REB')">
							REB
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_AST' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_AST' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_AST' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_AST' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AST')">
							AST
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_STL' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_STL' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_STL' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_STL' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('STL')">
							ROB
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_LOS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_LOS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_LOS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_LOS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('LOS')">
							PER
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_BLK' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_BLK' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_BLK' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_BLK' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('BLK')">
							TAP
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_PF' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_PF' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PF' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PF' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('PF')">
							FP
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_ML' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_ML' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ML' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ML' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('ML')">
							+/-
						</th>
					</tr>
				</thead>
				<tbody wire:loading.class="opacity-50">
					@foreach ($players_stats as $key=>$stat)
						<tr class="group hover:bg-gray-150 dark:hover:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
							<td class="w-6 text-right" style="min-width: 1.7rem">
								@if ($order != 'player_name' && $order != 'teams.short_name' && $order != 'AGE')
									{{ $page == 1 ? $key+1 : (($page-1) * $per_page) + $key+1 }}
								@endif
							</td>
							<td class="w-32 truncate {{ $order == 'player_name' ? 'bg-gray-100 dark:bg-gray-650' : 'bg-white dark:bg-gray-750 group-hover:bg-gray-150 dark:group-hover:bg-gray-700' }}" style="width: 8rem; min-width: 8rem; max-width: 8rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
								<div class="flex items-center truncate">
									<img src="{{ $stat->player->getImg() }}" alt="" class="h-6 w-6 object-cover rounded-full border border-gray-300 dark:border-gray-650">
									<p class="pl-2 truncate w-32">
										{{ $stat->player_name }}
									</p>
								</div>
							</td>
							<td class="text-right">
								{{ $stat->player->getPosition() ?: 'N/D' }}
							</td>
							<td class="text-right {{ $order == 'teams.short_name' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								<div class="flex items-center justify-end">
									<img src="{{ $stat->seasonTeam->team->getImg() }}" alt="" class="h-6 w-6 object-cover">
									<p class="w-6 pl-1">
										{{ $stat->seasonTeam->team->short_name }}
									</p>
								</div>
							</td>
							<td class="text-right {{ $order == 'AGE' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ $stat->AGE ?: 'N/D' }}
							</td>
							<td class="text-right {{ $order == 'PJ' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->PJ, 0, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'PT' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->PT, 0, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_MIN' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_MIN, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_MIN, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_PTS' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_PTS, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_PTS, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_FGM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_FGM, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_FGM, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_FGA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_FGA, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_FGA, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'PER_FG' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->PER_FG, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_TPM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_TPM, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_TPM, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_TPA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_TPA, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_TPA, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'PER_TP' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->PER_TP, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_FTM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_FTM, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_FTM, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_FTA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_FTA, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_FTA, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'PER_FT' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->PER_FT, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_ORB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_ORB, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_ORB, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_DRB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_DRB, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_DRB, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_REB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_REB, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_REB, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_AST' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_AST, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_AST, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_STL' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_STL, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_STL, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_LOS' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_LOS, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_LOS, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_BLK' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_BLK, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_BLK, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_PF' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_PF, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_PF, 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_ML' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat->AVG_ML, 1, ',', '.') }}
								@else
									{{ number_format($stat->SUM_ML, 0, ',', '.') }}
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="pagination-wrapper text-sm pt-4">
			{{ $players_stats->links('vendor.pagination.tailwind') }}
		</div>
	@else
		<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200">
			<p class="px-4 py-2">
				No se han encontrado datos
			</p>
		</div>
	@endif
@else
	<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200">
		<p class="px-4 py-2">
			Temporada actual no encontrada
		</p>
	</div>
@endif