<h4 class="text-base font-bold uppercase tracking-wide mt-6 pb-2">
	Jugadores
</h4>


@if ($season)
	@if ($players_stats->count() > 0)
		<div class="bg-white dark:bg-gray-750 overflow-x-auto md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
			<table class="players-stats">
				<thead>
					<tr class="text-gray-600 bg-gray-150 dark:bg-gray-700 dark:text-gray-100 select-none">
						<th class="text-right" style="min-width: 1.5rem"></th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'players.name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'players.name' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'players.name' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('players.name')"
						style="width: 8rem; max-width: 8rem; text-align: left;">
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
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_MIN' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_MIN' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_MIN' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_MIN')">
							MIN
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_PTS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_PTS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_PTS')">
							PTS
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_FGM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_FGM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_FGM')">
							FGM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_FGA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_FGA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_FGA')">
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
						{{ $order == 'AVG_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_TPM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_TPM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_TPM')">
							3PM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_TPA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_TPA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_TPA')">
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
						{{ $order == 'AVG_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_FTM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_FTM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_FTM')">
							TLM
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_FTA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_FTA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_FTA')">
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
						{{ $order == 'AVG_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_ORB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_ORB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_ORB')">
							R.O
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_DRB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_DRB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_DRB')">
							R.D
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_REB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_REB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_REB')">
							REB
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_AST' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_AST' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_AST')">
							AST
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_STL' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_STL' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_STL')">
							ROB
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_LOS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_LOS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_LOS')">
							PER
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_BLK' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_BLK' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_BLK')">
							TAP
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_PF' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_PF' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_PF')">
							FP
						</th>
						<th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
						{{ $order == 'AVG_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
						{{ $order == 'AVG_ML' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
						{{ $order == 'AVG_ML' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
						wire:click="change_order('AVG_ML')">
							+/-
						</th>
					</tr>
				</thead>
				<tbody wire:loading.class="opacity-50">
					@foreach ($players_stats as $stat)
						<tr class="hover:bg-gray-150 dark:hover:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
							<td class="w-6 text-right" style="min-width: 1.7rem">
								{{ $players_stats->currentPage() == 1 ? $loop->iteration : $loop->iteration + $players_stats->perPage() }}
							</td>
							<td class="w-32 truncate {{-- pl-3 --}} {{ $order == 'players.name' ? 'bg-gray-100 dark:bg-gray-650' : '' }}" style="min-width: 4rem">
								<div class="flex items-center truncate">
									<img src="{{ $stat->player->getImg() }}" alt="" class="h-6 w-6 object-cover rounded-full border border-gray-300 dark:border-gray-650">
									<p class="pl-2 truncate w-32">
										{{ $stat->player->name }}
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
							<td class="text-right {{ $order == 'AVG_MIN' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_MIN, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_PTS' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_PTS, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_FGM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_FGM, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_FGA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_FGA, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'PER_FG' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->PER_FG, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_TPM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_TPM, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_TPA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_TPA, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'PER_TP' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->PER_TP, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_FTM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_FTM, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_FTA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_FTA, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'PER_FT' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->PER_FT, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_ORB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_ORB, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_DRB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_DRB, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_REB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_REB, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_AST' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_AST, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_STL' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_STL, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_LOS' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_LOS, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_BLK' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_BLK, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_PF' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_PF, 1, ',', '.') }}
							</td>
							<td class="text-right {{ $order == 'AVG_ML' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
								{{ number_format($stat->AVG_ML, 1, ',', '.') }}
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