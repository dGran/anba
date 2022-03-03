@if ($season)
	@if (count($teams_stats) > 0)
		<div class="bg-white dark:bg-gray-750 overflow-x-auto md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
			<table class="players-stats">

				<thead>
					<tr class="text-gray-600 bg-gray-150 dark:bg-gray-700 dark:text-gray-100 select-none">
						<th class="text-right" style="min-width: 2rem"></th>
						<th class="bg-gray-150 dark:bg-gray-700 hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'team_name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'team_name' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'team_name' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('team_name')"
						style="width: 10rem; min-width: 10rem; max-width: 10rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
							Equipo
						</th>
						<th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PJ' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PJ' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PJ' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('PJ')"
						style="width: 2rem; min-width: 2rem; max-width: 2rem">
							PJ
						</th>
						<th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'W' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'W' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'W' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('W')"
						style="width: 2rem; min-width: 2rem; max-width: 2rem">
							V
						</th>
						<th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'L' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'L' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'L' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('L')"
						style="width: 2rem; min-width: 2rem; max-width: 2rem">
							D
						</th>
						<th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PER_W' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PER_W' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PER_W' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('PER_W')">
							VIC%
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_PTS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_PTS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PTS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PTS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('PTS')">
							PTS
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FGM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FGM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('FGM')">
							FGM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FGA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FGA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FGA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('FGA')">
							FGA
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PER_FG' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PER_FG' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PER_FG' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('PER_FG')">
							FG%
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_TPM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_TPM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('TPM')">
							3PM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_TPA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_TPA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_TPA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('TPA')">
							3PA
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PER_TP' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PER_TP' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PER_TP' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('PER_TP')">
							3P%
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FTM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FTM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('FTM')">
							TLM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FTA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_FTA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_FTA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('FTA')">
							TLA
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'PER_FT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'PER_FT' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'PER_FT' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('PER_FT')">
							TL%
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_ORB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_ORB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ORB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ORB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('ORB')">
							R.O
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_DRB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_DRB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_DRB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_DRB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('DRB')">
							R.D
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_REB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_REB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_REB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_REB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('REB')">
							REB
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_AST' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_AST' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_AST' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_AST' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('AST')">
							AST
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_STL' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_STL' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_STL' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_STL' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('STL')">
							ROB
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_LOS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_LOS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_LOS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_LOS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('LOS')">
							PER
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_BLK' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_BLK' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_BLK' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_BLK' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('BLK')">
							TAP
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_PF' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_PF' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PF' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_PF' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('PF')">
							FP
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_ML' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_ML' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ML' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_ML' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('ML')">
							+/-
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_counterattack' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_counterattack' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_counterattack' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_counterattack' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_counterattack' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_counterattack' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('counterattack')">
							Contra
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_zone' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_zone' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_zone' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_zone' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_zone' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_zone' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('zone')">
							Zona
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_second_oportunity' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_second_oportunity' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_second_oportunity' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_second_oportunity' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_second_oportunity' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_second_oportunity' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('second_oportunity')">
							Segunda
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_substitute' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_substitute' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_substitute' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_substitute' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_substitute' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_substitute' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('substitute')">
							Banquillo
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $mode == 'per_game' && $order == 'AVG_advantage' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_advantage' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'per_game' && $order == 'AVG_advantage' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_advantage' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_advantage' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $mode == 'totals' && $order == 'SUM_advantage' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="setOrder('advantage')">
							Ventaja
						</th>
					</tr>
				</thead>

				<tbody wire:loading.class="opacity-75">
					@foreach ($teams_stats as $key => $stat)
						<tr class="group hover:bg-gray-150 dark:hover:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
							<td class="w-8 text-right">
								{{ $loop->iteration }}
							</td>
							<td class="w-32 truncate {{ $order == 'team_name' ? 'bg-gray-100 dark:bg-gray-650' : 'bg-white dark:bg-gray-750 group-hover:bg-gray-150 dark:group-hover:bg-gray-700' }}" style="width: 10rem; min-width: 10rem; max-width: 10rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
								<div class="flex items-center truncate">
									<p class="truncate w-32">
										<x-link href="{{ route('team.home', ['t' => $stat['team_slug']]) }}" class="hover:underline focus:underline">
											{{ $stat['team_name'] }}
										</x-link>

									</p>
								</div>
							</td>
							<td class="text-right {{ $order == 'PJ' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat['PJ'], 0, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'W' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat['W'], 0, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'L' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat['L'], 0, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'PER_W' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ $stat['PER_W'] < 1 ? substr(number_format($stat['PER_W'], 3, '.', ','), 1) : number_format($stat['PER_W'], 3, '.', ',') }}
							</td>
							<td class="text-right {{ $order == 'AVG_PTS' || $order == 'SUM_PTS' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_PTS'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_PTS'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_FGM' || $order == 'SUM_FGM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_FGM'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_FGM'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_FGA' || $order == 'SUM_FGA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_FGA'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_FGA'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'PER_FG' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat['PER_FG'], 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_TPM' || $order == 'SUM_TPM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_TPM'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_TPM'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_TPA' || $order == 'SUM_TPA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_TPA'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_TPA'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'PER_TP' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat['PER_TP'], 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_FTM' || $order == 'SUM_FTM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_FTM'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_FTM'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_FTA' || $order == 'SUM_FTA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_FTA'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_FTA'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'PER_FT' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat['PER_FT'], 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_ORB' || $order == 'SUM_ORB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_ORB'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_ORB'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_DRB' || $order == 'SUM_DRB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_DRB'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_DRB'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_REB' || $order == 'SUM_REB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_REB'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_REB'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_AST' || $order == 'SUM_AST' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_AST'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_AST'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_STL' || $order == 'SUM_STL' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_STL'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_STL'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_LOS' || $order == 'SUM_LOS' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_LOS'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_LOS'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_BLK' || $order == 'SUM_BLK' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_BLK'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_BLK'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_PF' || $order == 'SUM_PF' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_PF'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_PF'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_ML' || $order == 'SUM_ML' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_ML'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_ML'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_counterattack' || $order == 'SUM_counterattack' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_counterattack'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_counterattack'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_zone' || $order == 'SUM_zone' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_zone'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_zone'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_second_oportunity' || $order == 'SUM_second_oportunity' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_second_oportunity'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_second_oportunity'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_substitute' || $order == 'SUM_substitute' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_substitute'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_substitute'], 0, ',', '.') }}
								@endif
							</td>
							<td class="text-right {{ $order == 'AVG_advantage' || $order == 'SUM_advantage' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								@if ($mode == 'per_game')
									{{ number_format($stat['AVG_advantage'], 1, ',', '.') }}
								@else
									{{ number_format($stat['SUM_advantage'], 0, ',', '.') }}
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
			<p class="px-4 py-8 text-xl md:text-3xl text-center">
				No hay estadísticas disponibles para los filtros seleccionados.
			</p>
		</div>
	@endif

@else
	<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
		<p class="px-4 py-2 text-2xl">
			Temporada no encontrada
		</p>
	</div>
@endif
