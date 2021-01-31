<div class="px-4 py-3">
	<p class="uppercase text-sm font-bold tracking-wider pb-3">pronósticos</p>

	<div class="px-4 pb-2">
		<div class="flex mb-4">
			<div class="flex-1 border-r border-gray-200 dark:border-gray-650 py-1">
				<div class="px-1 flex items-center border-b border-gray-200 dark:border-gray-650">
					<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" class="w-10 h-10 object-cover">
					<div class="text-base ml-2">{{ $match->localTeam->team->medium_name }}</div>
				</div>
				<div class="text-center">
					<p class="text-2xl font-bold {{ $match->votes()['local'] > $match->votes()['visitor'] ? '' : 'light:text-gray-400 dark:text-gray-500' }}">
						{{ $match->votes()['local'] ? number_format($match->votesPercent()['local'], 2) : '0' }}%
					</p>
					@auth
						@if (!$match->userHasVoted())
			                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 mt-2 tracking-wide leading-6" wire:click="pollVote({{ $match->id }}, 'local')">
			                    votar
			                </x-buttons.primary>
						@endif
					@endauth
				</div>
			</div>

			<div class="flex-1 py-1">
				<div class="px-1 flex items-center justify-end border-b border-gray-200 dark:border-gray-650">
					<div class="text-base mr-2">{{ $match->visitorTeam->team->medium_name }}</div>
					<img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->short_name }}" class="w-10 h-10 object-cover">
				</div>
				<div class="text-center">
					<p class="text-2xl font-bold {{ $match->votes()['visitor'] > $match->votes()['local'] ? '' : 'light:text-gray-400 dark:text-gray-500' }}">
						{{ $match->votes()['visitor'] ? number_format($match->votesPercent()['visitor'], 2) : '0' }}%
					</p>
					@auth
						@if (!$match->userHasVoted())
			                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 mt-2 tracking-wide leading-6" wire:click="pollVote({{ $match->id }}, 'visitor')">
			                    votar
			                </x-buttons.primary>
						@endif
					@endauth
				</div>
			</div>
		</div>

		<div class="text-center text-xs w-full my-2">
			@auth
				@if ($match->userHasVoted())
					<p>Has votado por la victoria de {{ $match->userVote() == 'local' ? $match->localTeam->team->medium_name : $match->visitorTeam->team->medium_name }}</p>
	                <x-buttons.danger-outline class="uppercase text-xs px-2 py-0.5 mt-1" wire:click="pollDestroy({{ $match->id }}, {{ auth()->user()->id }})">
	                    Eliminar voto
	                </x-buttons.danger-outline>
				@endif
			@endauth
			<p class="block light:text-gray-600 dark:text-gray-300 pt-3">
				@if ($match->votes()['local'] + $match->votes()['visitor'] > 0)
					{{ $match->votes()['local'] + $match->votes()['visitor'] }}
					@if ($match->votes()['local'] + $match->votes()['visitor'] == 1)
						voto
					@else
						votos
					@endif
				@else
					No existen votos
				@endif
			</p>
			@guest
				<p class="pt-3">
					<span>Debes</span>
	                <x-link :href="route('login')" class="mx-1">
	                    iniciar sesión
	                </x-link>
	                <span>para poder votar</span>
				</p>
			@endguest
		</div>
	</div>
</div>