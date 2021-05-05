<p class="font-semibold text-xl px-3 md:px-0 mt-8 pb-2">
	PlayOffs provisionales
</p>
<div class="shadow-md rounded-lg mx-3 md:mx-0">
	<div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg p-4">

		{{-- <img src="https://www.pngkey.com/png/full/42-422915_western-conference-2018-nba-playoffs-logo.png" alt="Playoffs" class="py-4 w-72 mx-auto"> --}}

		<table class="w-full">
			<tr>
				{{-- left side --}}
				<td class="border-b border-gray-300 dark:border-gray-600 w-48 h-14" style="min-width: 12em; max-width: 12em">
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
				<td class="border-b border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
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
				<td class="border-b border-gray-300 dark:border-gray-600 w-48 h-14" style="min-width: 12em; max-width: 12em">
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
				<td class="border-l border-gray-300 dark:border-gray-600"></td>
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
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
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
				<td class="border-r border-gray-300 dark:border-gray-600"></td>
				<td class="border-b border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="border-b border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-6 border-b border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-b border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td class="border-r border-gray-300 dark:border-gray-600"></td>
				<td></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="border-b border-gray-300 dark:border-gray-600 w-48 h-14" style="min-width: 12em; max-width: 12em">
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
				<td class="border-b border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				{{-- right side --}}
				<td></td>
				<td></td>
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border-b border-gray-300 dark:border-gray-600 w-48 h-14" style="min-width: 12em; max-width: 12em">
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
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
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
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="w-6 border-b border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-b border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="w-6 border-b border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-b border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="border-r border-gray-300 dark:border-gray-600"></td>
				<td></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="border-b border-gray-300 dark:border-gray-600 w-48 h-14" style="min-width: 12em; max-width: 12em">
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
				<td class="border-b border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="border-r border-gray-300 dark:border-gray-600"></td>
				{{-- right side --}}
				<td></td>
				<td></td>
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-b border-gray-300 dark:border-gray-600 w-48 h-14" style="min-width: 12em; max-width: 12em">
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
				<td class="border-l border-gray-300 dark:border-gray-600"></td>
				<td></td>
				<td class="border-r border-gray-300 dark:border-gray-600"></td>
				<td></td>
				<td colspan="4" class="align-top">
					<div class="h-14 mx-auto" style="min-width: 10em; max-width: 10em; min-height: 1.75em; max-height: 1.75em">
						<div class="border border-gray-300 dark:border-gray-600 w-full h-7"></div>
						<div class="border-l border-r border-b border-gray-300 dark:border-gray-600 w-full h-7"></div>

					</div>
				</td>
{{-- 				<td></td>
				<td></td> --}}
				{{-- <td></td> --}}
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td></td>
				<td></td>
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
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
				<td class="border-r border-gray-300 dark:border-gray-600"></td>
				<td class="border-b border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="border-b border-r border-gray-300 dark:border-gray-600"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border-b border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-b border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				<td class="h-8"></td>
				<td class="border-r border-gray-300 dark:border-gray-600"></td>
				<td></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="border border-gray-300 dark:border-gray-600 w-40 h-7" style="min-width: 9em; max-width: 9em; min-height: 1.75em; max-height: 1.75em"></td>
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="border-b border-gray-300 dark:border-gray-600 w-48 h-14" style="min-width: 12em; max-width: 12em">
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
				<td class="border-b border-r border-gray-300 dark:border-gray-600 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
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
				<td class="w-6 border-r border-gray-300 dark:border-gray-600" style="min-width: 1.5em; max-width: 1.5em"></td>
				<td class="border-b border-gray-300 dark:border-gray-600 w-48 h-14" style="min-width: 12em; max-width: 12em">
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