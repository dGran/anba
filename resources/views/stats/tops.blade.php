<h4 class="text-base font-bold uppercase tracking-wide mt-6 pb-2">
	tops jugadores
</h4>
<div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-4 mb-2 md:mx-0" wire:loading.class="opacity-50">
	{{-- left side --}}
	<div class="bg-white dark:bg-gray-750 overflow-hidden md:shadow-md md:rounded-md text-gray-900 dark:text-gray-200 xs:col-span-2 lg:col-span-3">

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-4 px-4 gap-8">
			<div class="">
{{-- 		    	<div class="text-center pb-4">
			    	<img src="{{ $tops_PTS->first()->player->getImg() }}" alt="" class="hidden xs:block h-36 w-36 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650 mx-auto" style="background-color: {{ $tops_PTS->first()->player->team ? $tops_PTS->first()->player->team->color : '' }}">
			    	<p class="pt-1.5 text-base">
			    		{{ $tops_PTS->first()->player->name }}
			    	</p>
			    	<p class="pt-1 text-xs">
			    		Total: {{ number_format($tops_PTS->first()->SUM_PTS, 0, ',', '.') }} / Partido: {{ number_format($tops_PTS->first()->AVG_PTS, 1, ',', '.') }}
			    	</p>
		    	</div> --}}
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						Puntos por partido
					</a>
				</div>
				<div>
					@foreach ($tops_PTS as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->AVG_PTS, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

			<div class="">
{{-- 		    	<div class="text-center pb-4">
			    	<img src="{{ $tops_REB->first()->player->getImg() }}" alt="" class="hidden xs:block h-36 w-36 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650 mx-auto" style="background-color: {{ $tops_REB->first()->player->team ? $tops_REB->first()->player->team->color : '' }}">
			    	<p class="pt-1.5 text-base">
			    		{{ $tops_REB->first()->player->name }}
			    	</p>
			    	<p class="pt-1 text-xs">
			    		Total: {{ number_format($tops_REB->first()->SUM_REB, 0, ',', '.') }} / Partido: {{ number_format($tops_REB->first()->AVG_REB, 1, ',', '.') }}
			    	</p>
		    	</div> --}}
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						Rebotes por partido
					</a>
				</div>
				<div>
					@foreach ($tops_REB as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->AVG_REB, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

			<div class="">
{{-- 		    	<div class="text-center pb-4">
			    	<img src="{{ $tops_AST->first()->player->getImg() }}" alt="" class="hidden xs:block h-36 w-36 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650 mx-auto" style="background-color: {{ $tops_AST->first()->player->team ? $tops_AST->first()->player->team->color : '' }}">
			    	<p class="pt-1.5 text-base">
			    		{{ $tops_AST->first()->player->name }}
			    	</p>
			    	<p class="pt-1 text-xs">
			    		Total: {{ number_format($tops_AST->first()->SUM_AST, 0, ',', '.') }} / Partido: {{ number_format($tops_AST->first()->AVG_AST, 1, ',', '.') }}
			    	</p>
		    	</div> --}}
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						Asistencias por partido
					</a>
				</div>
				<div>
					@foreach ($tops_AST as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->AVG_AST, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

			<div class="">
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						Tapones por partido
					</a>
				</div>
				<div>
					@foreach ($tops_BLK as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->AVG_BLK, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

			<div class="">
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						Robos por partido
					</a>
				</div>
				<div>
					@foreach ($tops_STL as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->AVG_STL, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

			<div class="">
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						MVP
					</a>
				</div>
				<div>
					@foreach ($tops_MVP as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->AVG_TOTAL, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

			<div class="">
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						Tiros de campo
					</a>
				</div>
				<div>
					@foreach ($tops_FG as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->PER_FG, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

			<div class="">
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						Tiros de 3 puntos
					</a>
				</div>
				<div>
					@foreach ($tops_TP as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->PER_TP, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

			<div class="">
				<div class="border-b border-gray-200 dark:border-gray-650 mb-2 pb-2">
					<a href="" class="text-base font-bold uppercase | text-blue-600 hover:text-blue-500 focus:text-blue-500 dark:text-dark-link dark:hover:text-blue-300 dark:focus:text-blue-300 | py-3">
						Tiros libres
					</a>
				</div>
				<div>
					@foreach ($tops_FT as $top)
						<div class="flex items-center py-0.5 {{ $loop->iteration == 1 ? 'font-bold' : '' }}">
							<p class="flex-none w-4 text-right text-sm">
								{{ $loop->iteration }}.
							</p>
							<p class="flex-none text-base ml-3">
								{{ $top->player->name }}
							</p>
							<p class="flex-none text-xs ml-1.5 text-gray-400 uppercase font-normal pt-0.5">
								{{ $top->seasonTeam->team->short_name }}
							</p>
							<p class="flex-grow text-right">
								{{ number_format($top->PER_FT, 1, ',', '.') }}
							</p>
						</div>
					@endforeach
				</div>
			</div>

		</div>
	</div>

	{{-- right side --}}
	<div class="hidden lg:block bg-white dark:bg-gray-750 overflow-hidden md:shadow-md md:rounded-md text-gray-900 dark:text-gray-200 p-4">
		<ul>
			<li>Mejor Base</li>
			<li>Mejor Escolta</li>
			<li>Mejor Ålero</li>
			<li>Mejor Ala-Pivot</li>
			<li>Mejor Pivot</li>
		</ul>
	</div>
</div>

