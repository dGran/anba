<p class="font-semibold text-xl px-3 md:px-0 mt-8 pb-2">
	PlayOffs provisionales
</p>
<div class="shadow-md rounded-lg mx-3 md:mx-0">
	<div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg p-4">
		<table class="w-full mb-2">
			<tr>
				<td colspan="5">
					<div class="flex items-center mb-6">
						<img src="{{ $seasons_conferences[0]->conference->getImg() }}" alt="{{ $seasons_conferences[0]->conference->name }}" style="width: 60px; height: 60px" class="mr-2">
						<p class="text-blue-600 dark:text-blue-500 font-bold uppercase text-xl">{{ $seasons_conferences[0]->conference->name }} Conference</p>
					</div>
				</td>
				<td colspan="5">
					<img src="{{ asset('img/playoffs.png') }}" alt="Playoffs" class="w-60 mx-auto pt-4">
				</td>
				<td colspan="5">
					<div class="flex items-center justify-end mb-6">
						<p class="text-red-600 dark:text-red-500 font-bold uppercase text-xl">{{ $seasons_conferences[1]->conference->name }} Conference</p>
						<img src="{{ $seasons_conferences[1]->conference->getImg() }}" alt="{{ $seasons_conferences[1]->conference->name }}" style="width: 60px; height: 60px" class="ml-2">
					</div>
				</td>
			</tr>
			<tr>
				{{-- left side --}}
				<td class="border-b border-blue-500 dark:border-blue-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						<img src="{{ $table_positions[0][0]['team']->team->getImg() }}" alt="{{ $table_positions[0][0]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						<div class="ml-1.5 flex flex-col text-left">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[0][0]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[0][0]['team']->team->user->name }}
							</p>
						</div>
					</div>
				</td>
				<td class="border-b border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				{{-- right side --}}
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-b border-red-500 dark:border-red-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center justify-end">
						<div class="mr-1.5 flex flex-col text-right">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[1][0]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[1][0]['team']->team->user->name }}
							</p>
						</div>
						<img src="{{ $table_positions[1][0]['team']->team->getImg() }}" alt="{{ $table_positions[1][0]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
					</div>
				</td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						@if ($current_season->hasPlayIn())
							<img src="{{ $table_positions[0][6]['team']->team->getImg() }}" alt="{{ $table_positions[0][6]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
							<img src="{{ $table_positions[0][7]['team']->team->getImg() }}" alt="{{ $table_positions[0][7]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
							<img src="{{ $table_positions[0][8]['team']->team->getImg() }}" alt="{{ $table_positions[0][8]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
							<img src="{{ $table_positions[0][9]['team']->team->getImg() }}" alt="{{ $table_positions[0][9]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
						@else
							<img src="{{ $table_positions[0][7]['team']->team->getImg() }}" alt="{{ $table_positions[0][7]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
							<div class="ml-1.5 flex flex-col text-left">
								<p class="text-sm uppercase leading-4">
									{{ $table_positions[0][7]['team']->team->medium_name }}
								</p>
								<p class="text-xs">
									{{ $table_positions[0][7]['team']->team->user->name }}
								</p>
							</div>
						@endif
					</div>
				</td>
				<td></td>
				<td class="border-l border-blue-500 dark:border-blue-500"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				{{-- right side --}}
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center justify-end">
						@if ($current_season->hasPlayIn())
							<img src="{{ $table_positions[1][6]['team']->team->getImg() }}" alt="{{ $table_positions[1][6]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
							<img src="{{ $table_positions[1][7]['team']->team->getImg() }}" alt="{{ $table_positions[1][7]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
							<img src="{{ $table_positions[1][8]['team']->team->getImg() }}" alt="{{ $table_positions[1][8]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
							<img src="{{ $table_positions[1][9]['team']->team->getImg() }}" alt="{{ $table_positions[1][9]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
						@else
							<div class="mr-1.5 flex flex-col text-right">
								<p class="text-sm uppercase leading-4">
									{{ $table_positions[1][7]['team']->team->medium_name }}
								</p>
								<p class="text-xs">
									{{ $table_positions[1][7]['team']->team->user->name }}
								</p>
							</div>
							<img src="{{ $table_positions[1][7]['team']->team->getImg() }}" alt="{{ $table_positions[1][7]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						@endif
					</div>
				</td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td class="border-r border-blue-500 dark:border-blue-500"></td>
				<td class="border-b border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="bg-blue-300 dark:bg-blue-400 border border-blue-500 dark:border-blue-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="border-b border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-6 border-b border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="bg-red-300 dark:bg-red-400 border border-red-500 dark:border-red-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-b border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td class="border-r border-blue-500 dark:border-blue-500"></td>
				<td></td>
				<td class="bg-blue-300 dark:bg-blue-400 border border-blue-500 dark:border-blue-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="border-r border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td class="bg-red-300 dark:bg-red-400 border border-red-500 dark:border-red-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="border-b border-blue-500 dark:border-blue-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						<img src="{{ $table_positions[0][3]['team']->team->getImg() }}" alt="{{ $table_positions[0][3]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						<div class="ml-1.5 flex flex-col text-left">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[0][3]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[0][3]['team']->team->user->name }}
							</p>
						</div>
					</div>
				</td>
				<td class="border-b border-r border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="border-r border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				{{-- right side --}}
				<td></td>
				<td></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border-b border-red-500 dark:border-red-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center justify-end">
						<div class="mr-1.5 flex flex-col text-right">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[1][3]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[1][3]['team']->team->user->name }}
							</p>
						</div>
						<img src="{{ $table_positions[1][3]['team']->team->getImg() }}" alt="{{ $table_positions[1][3]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
					</div>
				</td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						<img src="{{ $table_positions[0][4]['team']->team->getImg() }}" alt="{{ $table_positions[0][4]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						<div class="ml-1.5 flex flex-col text-left">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[0][4]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[0][4]['team']->team->user->name }}
							</p>
						</div>
					</div>
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-r border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center justify-end">
						<div class="mr-1.5 flex flex-col text-right">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[1][4]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[1][4]['team']->team->user->name }}
							</p>
						</div>
						<img src="{{ $table_positions[1][4]['team']->team->getImg() }}" alt="{{ $table_positions[1][4]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
					</div>
				</td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-r border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="w-6 border-b border-blue-500 dark:border-blue-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="bg-blue-300 dark:bg-blue-400 border border-blue-500 dark:border-blue-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-b border-blue-500 dark:border-blue-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="w-6 border-b border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="bg-red-300 dark:bg-red-400 border border-red-500 dark:border-red-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-b border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-r border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td class="bg-blue-300 dark:bg-blue-400 border border-blue-500 dark:border-blue-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="border-r border-yellow-400 dark:border-yellow-300"></td>
				<td></td>
				<td class="bg-red-300 dark:bg-red-400 border border-red-500 dark:border-red-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="border-b border-blue-500 dark:border-blue-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						<img src="{{ $table_positions[0][2]['team']->team->getImg() }}" alt="{{ $table_positions[0][2]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						<div class="ml-1.5 flex flex-col text-left">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[0][2]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[0][2]['team']->team->user->name }}
							</p>
						</div>
					</div>
				</td>
				<td class="border-b border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="border-r border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="border-r border-yellow-400 dark:border-yellow-300"></td>
				{{-- right side --}}
				<td></td>
				<td></td>
				<td class="border-r border-red-500 dark:border-red-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-b border-red-500 dark:border-red-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center justify-end">
						<div class="mr-1.5 flex flex-col text-right">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[1][2]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[1][2]['team']->team->user->name }}
							</p>
						</div>
						<img src="{{ $table_positions[1][2]['team']->team->getImg() }}" alt="{{ $table_positions[1][2]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
					</div>
				</td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						<img src="{{ $table_positions[0][5]['team']->team->getImg() }}" alt="{{ $table_positions[0][5]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						<div class="ml-1.5 flex flex-col text-left">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[0][5]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[0][5]['team']->team->user->name }}
							</p>
						</div>
					</div>
				</td>
				<td class="w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border-l border-blue-500 dark:border-blue-500"></td>
				<td></td>
				<td class="border-r border-blue-500 dark:border-blue-500"></td>
				<td></td>
				<td colspan="4" class="align-top">
					<div class="h-14 mx-auto" style="min-width: 10em; max-width: 10em; min-height: 1.75em; max-height: 1.75em">
						<div class="bg-yellow-200 dark:bg-yellow-100 border border-yellow-400 dark:border-yellow-300 w-full h-7"></div>
						<div class="bg-yellow-200 dark:bg-yellow-100 border-l border-r border-b border-yellow-400 dark:border-yellow-300 w-full h-7"></div>

					</div>
				</td>
{{-- 				<td></td>
				<td></td> --}}
				{{-- <td></td> --}}
				<td class="border-r border-red-500 dark:border-red-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center justify-end">
						<div class="mr-1.5 flex flex-col text-right">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[1][5]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[1][5]['team']->team->user->name }}
							</p>
						</div>
						<img src="{{ $table_positions[1][5]['team']->team->getImg() }}" alt="{{ $table_positions[1][5]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
					</div>
				</td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td class="border-r border-blue-500 dark:border-blue-500"></td>
				<td class="border-b border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="bg-blue-300 dark:bg-blue-400 border border-blue-500 dark:border-blue-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="border-b border-r border-blue-500 dark:border-blue-500"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-r border-red-500 dark:border-red-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border-b border-red-500 dark:border-red-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="bg-red-300 dark:bg-red-400 border border-red-500 dark:border-red-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-b border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td class="border-r border-blue-500 dark:border-blue-500"></td>
				<td></td>
				<td class="bg-blue-300 dark:bg-blue-400 border border-blue-500 dark:border-blue-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="bg-red-300 dark:bg-red-400 border border-red-500 dark:border-red-500 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="border-b border-blue-500 dark:border-blue-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						<img src="{{ $table_positions[0][1]['team']->team->getImg() }}" alt="{{ $table_positions[0][1]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						<div class="ml-1.5 flex flex-col text-left">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[0][1]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[0][1]['team']->team->user->name }}
							</p>
						</div>
					</div>
				</td>
				<td class="border-b border-r border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				{{-- right side --}}
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-red-500 dark:border-red-500" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border-b border-red-500 dark:border-red-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center justify-end">
						<div class="mr-1.5 flex flex-col text-right">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[1][1]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[1][1]['team']->team->user->name }}
							</p>
						</div>
						<img src="{{ $table_positions[1][1]['team']->team->getImg() }}" alt="{{ $table_positions[1][1]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
					</div>
				</td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						@if ($current_season->hasPlayIn())
							<img src="{{ $table_positions[0][6]['team']->team->getImg() }}" alt="{{ $table_positions[0][6]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
							<img src="{{ $table_positions[0][7]['team']->team->getImg() }}" alt="{{ $table_positions[0][7]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
						@else
							<img src="{{ $table_positions[0][6]['team']->team->getImg() }}" alt="{{ $table_positions[0][6]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
							<div class="ml-1.5 flex flex-col text-left">
								<p class="text-sm uppercase leading-4">
									{{ $table_positions[0][6]['team']->team->medium_name }}
								</p>
								<p class="text-xs">
									{{ $table_positions[0][6]['team']->team->user->name }}
								</p>
							</div>
						@endif
					</div>
					<div class="flex items-center">
					</div>
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				{{-- right side --}}
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center justify-end">
						@if ($current_season->hasPlayIn())
							<img src="{{ $table_positions[1][6]['team']->team->getImg() }}" alt="{{ $table_positions[1][6]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
							<img src="{{ $table_positions[1][7]['team']->team->getImg() }}" alt="{{ $table_positions[1][7]['team']->team->short_name }}" class="w-9 h-9 object-cover m-1">
						@else
							<div class="mr-1.5 flex flex-col text-right">
								<p class="text-sm uppercase leading-4">
									{{ $table_positions[1][6]['team']->team->medium_name }}
								</p>
								<p class="text-xs">
									{{ $table_positions[1][6]['team']->team->user->name }}
								</p>
							</div>
							<img src="{{ $table_positions[1][6]['team']->team->getImg() }}" alt="{{ $table_positions[1][6]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						@endif
					</div>
				</td>
			</tr>

		</table>
	</div>
</div>

{{-- 	<div class="clash mt-40">
		<div class="flex items-center py-4">
			<div class="p-1 text-xl uppercase font-bold text-white bg-blue-800 border border-blue-600 w-10 rounded-full text-center z-10">
				1
			</div>
			<div class="relative -mx-2 z-0 h-8 w-40" style="background-color: {{ $table_positions[0][0]['team']->team->color }}">
				<p class="text-sm pl-4 pt-1.5">{{ $table_positions[0][0]['team']->team->short_name }}</p>
				<img src="{{ $table_positions[0][0]['team']->team->getImg() }}" alt="{{ $table_positions[0][0]['team']->team->short_name }}" class="w-20 h-20 mx-auto absolute top-0 right-0 -mt-6">
			</div>
		</div>
		<div class="flex items-center py-4">
			<div class="p-1 text-xl uppercase font-bold text-white bg-blue-800 border border-blue-600 w-10 rounded-full text-center z-10">
				8
			</div>
			<div class="relative -mx-2 z-0 h-8 w-40" style="background-color: {{ $table_positions[0][7]['team']->team->color }}">
				<p class="text-sm pl-4 pt-1.5">{{ $table_positions[0][7]['team']->team->short_name }}</p>
				<img src="{{ $table_positions[0][7]['team']->team->getImg() }}" alt="{{ $table_positions[0][7]['team']->team->short_name }}" class="w-20 h-20 mx-auto absolute top-0 right-0 -mt-6">
			</div>
		</div>
	</div>

	<div class="clash mt-8">
		<div class="flex items-center py-4">
			<div class="p-1 text-xl uppercase font-bold text-white bg-blue-800 border border-blue-600 w-10 rounded-full text-center z-10">
				4
			</div>
			<div class="relative -mx-2 z-0 h-8 w-40" style="background-color: {{ $table_positions[0][3]['team']->team->color }}">
				<p class="text-sm pl-4 pt-1.5">{{ $table_positions[0][3]['team']->team->short_name }}</p>
				<img src="{{ $table_positions[0][3]['team']->team->getImg() }}" alt="{{ $table_positions[0][3]['team']->team->short_name }}" class="w-20 h-20 mx-auto absolute top-0 right-0 -mt-6">
			</div>
		</div>
		<div class="flex items-center py-4">
			<div class="p-1 text-xl uppercase font-bold text-white bg-blue-800 border border-blue-600 w-10 rounded-full text-center z-10">
				5
			</div>
			<div class="relative -mx-2 z-0 h-8 w-40" style="background-color: {{ $table_positions[0][4]['team']->team->color }}">
				<p class="text-sm pl-4 pt-1.5">{{ $table_positions[0][4]['team']->team->short_name }}</p>
				<img src="{{ $table_positions[0][4]['team']->team->getImg() }}" alt="{{ $table_positions[0][4]['team']->team->short_name }}" class="w-20 h-20 mx-auto absolute top-0 right-0 -mt-6">
			</div>
		</div>
	</div>

	<div class="clash mt-8">
		<div class="flex items-center py-4">
			<div class="p-1 text-xl uppercase font-bold text-white bg-blue-800 border border-blue-600 w-10 rounded-full text-center z-10">
				3
			</div>
			<div class="relative -mx-2 z-0 h-8 w-40" style="background-color: {{ $table_positions[0][2]['team']->team->color }}">
				<p class="text-sm pl-4 pt-1.5">{{ $table_positions[0][2]['team']->team->short_name }}</p>
				<img src="{{ $table_positions[0][2]['team']->team->getImg() }}" alt="{{ $table_positions[0][2]['team']->team->short_name }}" class="w-20 h-20 mx-auto absolute top-0 right-0 -mt-6">
			</div>
		</div>
		<div class="flex items-center py-4">
			<div class="p-1 text-xl uppercase font-bold text-white bg-blue-800 border border-blue-600 w-10 rounded-full text-center z-10">
				6
			</div>
			<div class="relative -mx-2 z-0 h-8 w-40" style="background-color: {{ $table_positions[0][5]['team']->team->color }}">
				<p class="text-sm pl-4 pt-1.5">{{ $table_positions[0][5]['team']->team->short_name }}</p>
				<img src="{{ $table_positions[0][5]['team']->team->getImg() }}" alt="{{ $table_positions[0][5]['team']->team->short_name }}" class="w-20 h-20 mx-auto absolute top-0 right-0 -mt-6">
			</div>
		</div>
	</div>

	<div class="clash mt-8">
		<div class="flex items-center py-4">
			<div class="p-1 text-xl uppercase font-bold text-white bg-blue-800 border border-blue-600 w-10 rounded-full text-center z-10">
				2
			</div>
			<div class="relative -mx-2 z-0 h-8 w-40" style="background-color: {{ $table_positions[0][1]['team']->team->color }}">
				<p class="text-sm pl-4 pt-1.5">{{ $table_positions[0][1]['team']->team->short_name }}</p>
				<img src="{{ $table_positions[0][1]['team']->team->getImg() }}" alt="{{ $table_positions[0][1]['team']->team->short_name }}" class="w-20 h-20 mx-auto absolute top-0 right-0 -mt-6">
			</div>
		</div>
		<div class="flex items-center py-4">
			<div class="p-1 text-xl uppercase font-bold text-white bg-blue-800 border border-blue-600 w-10 rounded-full text-center z-10">
				7
			</div>
			<div class="relative -mx-2 z-0 h-8 w-40" style="background-color: {{ $table_positions[0][6]['team']->team->color }}">
				<p class="text-sm pl-4 pt-1.5">{{ $table_positions[0][6]['team']->team->short_name }}</p>
				<img src="{{ $table_positions[0][6]['team']->team->getImg() }}" alt="{{ $table_positions[0][6]['team']->team->short_name }}" class="w-20 h-20 mx-auto absolute top-0 right-0 -mt-6">
			</div>
		</div>
	</div> --}}