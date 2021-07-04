<h4 class="text-base font-bold uppercase tracking-wide mt-6 pb-2">
	Jugadores
</h4>


@if ($season)
	@if ($players_stats->count() > 0)
		<div class="bg-white dark:bg-gray-700 overflow-x-auto md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200">
			<table class="players-stats">
				<thead>
					<tr class="text-gray-600 bg-gray-50 dark:bg-gray-650 dark:text-gray-100">
						<th class="text-right" style="min-width: 1.5rem"></th>
						<th class="player hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900" style="width: 8rem; max-width: 8rem;">Jugador</th>
						<th class="w-16 text-right hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900" style="min-width: 4.5rem;">POS</th>
						<th class="w-12 text-right hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900" style="min-width: 3rem">Equipo</th>
						<th class="w-12 text-right hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900" style="min-width: 3rem">Edad</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">PJ</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">MIN</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">PTS</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">FGM</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">FGA</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">FG%</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">3PM</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">3PA</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">3P%</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">TLM</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">TLA</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">TL%</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">R.O</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">R.D</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">REB</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">AST</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">ROB</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">PER</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">TAP</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">FP</th>
						<th class="hover:bg-gray-650 hover:text-gray-100 dark:hover:bg-gray-900">+/-</th>
					</tr>
				</thead>
				<tbody wire:loading.class="opacity-50">
					@foreach ($players_stats as $stat)
						<tr class="hover:bg-gray-100 dark:hover:bg-gray-900 border-t border-gray-200 dark:border-gray-650">
							<td class="w-6 text-right" style="min-width: 1.7rem">
								{{ $players_stats->currentPage() == 1 ? $loop->iteration : $loop->iteration + $players_stats->perPage() }}
							</td>
							<td class="w-32 truncate {{-- pl-3 --}}" style="min-width: 4rem">
								<div class="flex items-center truncate">
									<img src="{{ $stat->player->getImg() }}" alt="" class="h-6 w-6 object-cover rounded-full border border-gray-300 dark:border-gray-650">
									<p class="pl-2 truncate w-32">
										{{ $stat->player->name }}
									</p>
								</div>
							</td>
							<td class="text-right">
								{{ $stat->player->getPosition() }}
							</td>
							<td class="text-right">
								<div class="flex items-center justify-end">
									<img src="{{ $stat->player->team ? $stat->player->team->getImg() : asset('storage/teams/default.png') }}" alt="" class="h-6 w-6 object-cover">
									<p class="w-6 pl-1">
										{{ $stat->player->team ? $stat->player->team->short_name : 'N/D' }}
									</p>
								</div>
							</td>
							<td class="text-right">
								{{ $stat->player->age() }}
							</td>
							<td class="text-right">
								{{ number_format($stat->PJ, 0, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_MIN, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_PTS, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_FGM, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_FGA, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ $stat->AVG_FGA > 0 ? number_format(($stat->AVG_FGM / $stat->AVG_FGA) *100, 1, ',', '.') : '0,0' }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_TPM, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_TPA, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ $stat->AVG_TPA > 0 ? number_format(($stat->AVG_TPM / $stat->AVG_TPA) *100, 1, ',', '.') : '0,0' }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_FTM, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_FTA, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ $stat->AVG_FTA > 0 ? number_format(($stat->AVG_FTM / $stat->AVG_FTA) *100, 1, ',', '.') : '0,0' }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_ORB, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_REB - $stat->AVG_ORB, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_REB, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_AST, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_STL, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_LOS, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_BLK, 1, ',', '.') }}
							</td>
							<td class="text-right">
								{{ number_format($stat->AVG_PF, 1, ',', '.') }}
							</td>
							<td class="text-right">
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