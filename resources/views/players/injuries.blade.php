<div>
	<div class="max-w-7xl mx-auto p-4 mb-2 sm:px-6 lg:px-8 border-b md:border-b-0 border-gray-300 dark:border-gray-650">
{{-- 		<div class=""> --}}
			<h4 class="text-lg font-semibold mb-1.5">
				Jugadores lesionados
			</h4>
		{{-- </div> --}}

		<div class="flex items-center justify-between space-x-3 | my-2.5 pb-3">
			<input type="search" class="appearance-none rounded text-sm | py-1.5 px-3 | w-full | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" placeholder='Buscar...' wire:model="search" autofocus>
			<div class="flex items-center space-x-2.5">
				<button class="text-2xl | cursor-pointer | {{ $view == 'table' ? 'opacity-50 pointer-events-none cursor-not-allowed' : '' }} focus:outline-none" wire:click="$set('view', 'table')">
					<i class="fas fa-table"></i>
				</button>
				<button class="text-2xl | cursor-pointer | {{ $view != 'table' ? 'opacity-50 pointer-events-none cursor-not-allowed' : '' }} focus:outline-none" wire:click="$set('view', 'bio')">
					<i class="fas fa-address-card"></i>
				</button>
			</div>
		</div>

		@if ($view == "table")
			<div class="overflow-x-auto md:overflow-hidden | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-transparent hover:scrollbar-thumb-gray-300 | dark:hover:scrollbar-thumb-gray-500">
			<table class="w-full">
				<thead class="bg-gray-150 dark:bg-gray-700">
					<tr>
						<th class="px-3 py-2 text-left">Jugador</th>
						<th class="px-3 py-2 text-left">Equipo</th>
						<th class="px-3 py-2 text-left w-20">Partidos</th>
						<th class="px-3 py-2 text-left">Lesión</th>
					</tr>
				</thead>
				<tbody class="{{-- border-l border-r border-gray-200 dark:border-gray-700 --}}">
					@foreach ($injuriePlayers as $player)
						<tr class="hover:bg-blue-100 dark:hover:bg-dark-link dark:hover:text-gray-900">
							<td class="px-3 py-1.5 | border-b border-gray-200 dark:border-gray-700 | text-sm | flex items-center justify-start space-x-3" style="min-width: 180px;">
								<img src="{{ $player->getImg() }}" alt="" class="h-9 w-9 object-cover rounded-full border border-gray-200 dark:border-gray-700">
								<span class="truncate">{{ $player->name }}</span>
							</td>
							<td class="px-3 py-1.5 border-b border-gray-200 dark:border-gray-700 | text-sm"  style="min-width: 150px;">
								<div class="flex items-center space-x-3">
									<img src="{{ $player->team ? $player->team->getImg() : asset('storage/teams/default.png') }}" alt="" class="w-8 object-cover">
									@if ($player->team)
										<a href="{{ route('team.home', $player->team->slug) }}" class="hover:underline focus:underline focus:outline-none">
											<span class="md:hidden">{{ $player->team->medium_name }}</span>
											<span class="hidden md:block">{{ $player->team->name }}</span>
										</a>
									@else
										<span class="text-gray-400">Sin equipo</span>
									@endif
								</div>
							</td>
							<td class="px-3 py-1.5 border-b border-gray-200 dark:border-gray-700 | text-sm | text-center">
								{{ $player->injury_matches }}
							</td>
							<td class="px-3 py-1.5 border-b border-gray-200 dark:border-gray-700 | text-sm">
								<div class="flex items-center justify-center md:justify-start space-x-3">
									<i class="fas fa-briefcase-medical text-base {{ $player->injury_playable ? 'text-yellow-400 dark:text-yellow-300' : 'text-pretty-red' }}" title="{{ $player->injury_playable ? 'Jugable' : 'No jugable' }}"></i>
									<span class="hidden md:block">{{ $player->injury->name }}</span>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		@else
			<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
				@foreach ($injuriePlayers as $player)
					<div>
						<div class="bg-gray-150 dark:bg-gray-700 border rounded relative | border border-gray-200 dark:border-gray-700">
							<img src="{{ $player->getImg() }}" alt="" class="h-20 mx-auto mt-1.5">
							<div class="text-white rounded-b | py-1 px-3 | text-center" style="background-color: {{ $player->team ? $player->team->color : '' }}">
								<p>{{ $player->name }}</p>
								<p class="text-xs">{{ $player->team ? $player->team->name : 'Sin equipo' }}</p>
							</div>
							<span class="absolute top-0 left-0 mt-1 ml-1.5">
								<i class="fas fa-briefcase-medical text-lg {{ $player->injury_playable ? 'text-yellow-400 dark:text-yellow-300' : 'text-pretty-red' }}" title="{{ $player->injury_playable ? 'Jugable' : 'No jugable' }}"></i>
							</span>
							<span class="rounded-full w-6 h-6 | text-white {{ $player->injury_playable ? 'bg-yellow-400 dark:bg-yellow-300 text-gray-900' : 'bg-pretty-red' }} | absolute top-0 right-0 mt-1 mr-1.5 | text-xs font-semibold | flex items-center justify-center">
								<span>{{ $player->injury_matches }}</span>
							</span>
						</div>

						<div class="bg-gray-150 dark:bg-gray-700 border rounded relative | border border-gray-200 dark:border-gray-700 mt-3">
							<div class="text-xs py-1.5 text-center px-3">
								{{ $player->injury->name }}
								<p>Recuperación en {{ $player->injury_days }} {{ $player->injury_days == 1 ? 'día' : 'días' }}</p>
								@if ($player->injury_playable)
									<p class="py-1.5 text-yellow-400 dark:text-yellow-300">Lesión jugable</p>
								@else
									<p class="py-1.5 text-pretty-red">Baja</p>
								@endif
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endif

	</div>
</div>
