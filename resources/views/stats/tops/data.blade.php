<div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-4 mb-2 md:mx-0">
	{{-- left side --}}
	<div class="bg-white dark:bg-gray-750 overflow-hidden shadow-md rounded-md text-gray-900 dark:text-gray-200 xs:col-span-2 lg:col-span-4 xl:col-span-3">

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 my-4 px-4 gap-8">
			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Puntos por partido
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_PTS->count() > 0)
						@foreach ($tops_PTS as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->AVG_PTS, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>

			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Rebotes por partido
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_REB->count() > 0)
						@foreach ($tops_REB as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->AVG_REB, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>

			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Asistencias por partido
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_AST->count() > 0)
						@foreach ($tops_AST as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->AVG_AST, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>

			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Tapones por partido
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_BLK->count() > 0)
						@foreach ($tops_BLK as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->AVG_BLK, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>

			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Robos por partido
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_STL->count() > 0)
						@foreach ($tops_STL as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->AVG_STL, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>

			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						MVP
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_MVP->count() > 0)
						@foreach ($tops_MVP as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->AVG_TOTAL, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>

			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Tiros de campo
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_FG->count() > 0)
						@foreach ($tops_FG as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->PER_FG, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>

			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Tiros de 3 puntos
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_TP->count() > 0)
						@foreach ($tops_TP as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->PER_TP, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>

			<div>
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-sm md:text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 focus:outline-none | py-3">
						Tiros libres
					</a>
				</div>
				<div class="text-sm md:text-base" wire:loading.class="opacity-75">
					@if ($tops_FT->count() > 0)
						@foreach ($tops_FT as $top)
							<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
								<p class="flex-none w-4 text-right text-xs md:text-sm">
									{{ $loop->iteration }}.
								</p>
								<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
									{{ $top->player->name }}
								</a>
								<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
									{{ $top->seasonTeam->team->short_name }}
								</a>
								<p class="flex-grow text-right">
									{{ number_format($top->PER_FT, 1, ',', '.') }}
								</p>
							</div>
						@endforeach
					@else
						<p class="">
							No hay datos registrados
						</p>
					@endif
				</div>
			</div>
		</div>
	</div>

	{{-- right side --}}
	<div class="hidden xl:block bg-white dark:bg-gray-750 overflow-hidden md:shadow-md md:rounded-md text-gray-900 dark:text-gray-200 p-4">
		<h4 class="text-sm md:text-base | font-bold uppercase | border-b border-gray-200 dark:border-gray-650 | mb-2 pb-2">
			Quinteto {{ $phase == "regular" ? 'liga regular' : '' }} {{ $phase == "playoffs" ? 'playoffs' : '' }}
		</h4>
		<ul class="text-sm md:text-base" wire:loading.class="opacity-75">
			<li class="flex items-center">
				<span class="w-6 text-sm text-gray-400 uppercase font-normal pt-0.5">
					B
				</span>
				@if ($top_PG)
					<p class="text-base hover:text-blue-500 dark:hover:text-blue-300 cursor-pointer">
						{{ $top_PG->player->name }}
					</p>
					<p class="text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
						{{ $top_PG->seasonTeam->team->short_name }}
					</p>
				@endif
			</li>
			<li class="flex items-center">
				<span class="w-6 text-sm text-gray-400 uppercase font-normal pt-0.5">
					ES
				</span>
				@if ($top_SG)
					<p class="text-base hover:text-blue-500 dark:hover:text-blue-300 cursor-pointer">
						{{ $top_SG->player->name }}
					</p>
					<p class="text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
						{{ $top_SG->seasonTeam->team->short_name }}
					</p>
				@endif
			</li>
			<li class="flex items-center">
				<span class="w-6 text-sm text-gray-400 uppercase font-normal pt-0.5">
					AL
				</span>
				@if ($top_SF)
					<p class="text-base hover:text-blue-500 dark:hover:text-blue-300 cursor-pointer">
						{{ $top_SF->player->name }}
					</p>
					<p class="text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
						{{ $top_SF->seasonTeam->team->short_name }}
					</p>
				@endif
			</li>
			<li class="flex items-center">
				<span class="w-6 text-sm text-gray-400 uppercase font-normal pt-0.5">
					AP
				</span>
				@if ($top_PF)
					<p class="text-base hover:text-blue-500 dark:hover:text-blue-300 cursor-pointer">
						{{ $top_PF->player->name }}
					</p>
					<p class="text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
						{{ $top_PF->seasonTeam->team->short_name }}
					</p>
				@endif
			</li>
			<li class="flex items-center">
				<span class="w-6 text-sm text-gray-400 uppercase font-normal pt-0.5">
					P
				</span>
				@if ($top_C)
					<p class="text-base hover:text-blue-500 dark:hover:text-blue-300 cursor-pointer">
						{{ $top_C->player->name }}
					</p>
					<p class="text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
						{{ $top_C->seasonTeam->team->short_name }}
					</p>
				@endif
			</li>
		</ul>

		<h4 class="text-sm md:text-base | font-bold uppercase | border-b border-gray-200 dark:border-gray-650 | mb-2 pt-6 pb-2">
			Total puntos
		</h4>
		<div class="text-sm md:text-base" wire:loading.class="opacity-75">
			@if ($tops_SUM_PTS->count() > 0)
				@foreach ($tops_SUM_PTS as $top)
					<div class="flex items-center py-0.5">
						<p class="flex-none w-4 text-right text-xs md:text-sm">
							{{ $loop->iteration }}.
						</p>
						<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
							{{ $top->player->name }}
						</a>
						<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
							{{ $top->seasonTeam->team->short_name }}
						</a>
						<p class="flex-grow text-right">
							{{ number_format($top->SUM_PTS, 0, ',', '.') }}
						</p>
					</div>
				@endforeach
			@endif
		</div>

		<h4 class="text-sm md:text-base | font-bold uppercase | border-b border-gray-200 dark:border-gray-650 | mb-2 pt-6 pb-2">
			Total rebotes
		</h4>
		<div class="text-sm md:text-base" wire:loading.class="opacity-75">
			@if ($tops_SUM_REB->count() > 0)
				@foreach ($tops_SUM_REB as $top)
					<div class="flex items-center py-0.5">
						<p class="flex-none w-4 text-right text-xs md:text-sm">
							{{ $loop->iteration }}.
						</p>
						<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
							{{ $top->player->name }}
						</a>
						<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
							{{ $top->seasonTeam->team->short_name }}
						</a>
						<p class="flex-grow text-right">
							{{ number_format($top->SUM_REB, 0, ',', '.') }}
						</p>
					</div>
				@endforeach
			@endif
		</div>

		<h4 class="text-sm md:text-base | font-bold uppercase | border-b border-gray-200 dark:border-gray-650 | mb-2 pt-6 pb-2">
			Total asistencias
		</h4>
		<div class="text-sm md:text-base" wire:loading.class="opacity-75">
			@if ($tops_SUM_AST->count() > 0)
				@foreach ($tops_SUM_AST as $top)
					<div class="flex items-center py-0.5">
						<p class="flex-none w-4 text-right text-xs md:text-sm">
							{{ $loop->iteration }}.
						</p>
						<a href="{{ route('player', $top->player->slug) }}" class="flex-none | ml-3 | hover:text-blue-500 dark:hover:text-blue-300 | focus:text-blue-500 dark:focus:text-blue-300 | focus:outline-none">
							{{ $top->player->name }}
						</a>
						<a href="{{ route('team.home', ['t' => $top->seasonTeam->team->slug]) }}" class="flex-none | text-xs | ml-1.5 | uppercase font-normal pt-0.5 | opacity-50 | hover:opacity-100 focus:opacity-100 | focus:outline-none">
							{{ $top->seasonTeam->team->short_name }}
						</a>
						<p class="flex-grow text-right">
							{{ number_format($top->SUM_AST, 0, ',', '.') }}
						</p>
					</div>
				@endforeach
			@endif
		</div>


	</div>
</div>

