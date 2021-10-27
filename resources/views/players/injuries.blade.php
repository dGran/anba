<div>
	<div class="max-w-7xl mx-auto p-4 mb-2 sm:px-6 lg:px-8 border-b md:border-b-0 border-gray-300 dark:border-gray-650">
		<h4 class="text-lg font-semibold mb-1.5">Jugadores lesionados</h4>

		<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
			@foreach ($injuriePlayers as $player)
				<div class="bg-gray-150 dark:bg-gray-700 border rounded relative | border border-gray-200 dark:border-gray-700">
					<img src="{{ $player->getImg() }}" alt="" class="h-20 mx-auto mt-1.5">
					<div class="text-white rounded-b | py-1 px-3 | text-center" style="background-color: {{ $player->team->color }}">
						<p>{{ $player->name }}</p>
						<p class="text-xs">{{ $player->team->name }}</p>
					</div>
					<span class="absolute top-0 left-0 mt-1 ml-1.5">
						<i class="fas fa-briefcase-medical text-lg {{ $player->injury_playable ? 'text-yellow-400 dark:text-yellow-300' : 'text-pretty-red' }}" title="{{ $player->injury_playable ? 'Jugable' : 'No jugable' }}"></i>
					</span>
					<span class="rounded-full w-6 h-6 | text-white {{ $player->injury_playable ? 'bg-yellow-400 dark:bg-yellow-300 text-gray-900' : 'bg-pretty-red' }} | absolute top-0 right-0 mt-1 mr-1.5 | text-xs font-semibold | flex items-center justify-center">
						<span>{{ $player->injury_days }}</span>
					</span>
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
			@endforeach
		</div>
	</div>
</div>