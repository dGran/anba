<x-modals.dialog maxWidth="md" wire:modal="modalForecast">
    <x-slot name="title">
		<div class="px-4 py-2">
			<p class="uppercase py-2 text-sm font-bold tracking-wider">PRONOSTICOS</p>
		</div>
    </x-slot>

    <x-slot name="content">
		<div class="px-4 py-2">

			<div class="flex mb-4 mt-2">
				<div class="flex-1 border-r border-gray-200 dark:border-gray-650 py-1">
					<div class="px-1 flex items-center border-b border-gray-200 dark:border-gray-650">
						<img src="{{ $reg->localTeam->team->getImg() }}" alt="{{ $reg->localTeam->team->short_name }}" style="width: 32px; height: 32px">
						<div class="text-sm ml-2">{{ $reg->localTeam->team->medium_name }}</div>
					</div>
					<div class="text-center">
						<p class="text-2xl font-bold {{ $reg->votes()['local'] > $reg->votes()['visitor'] ? '' : 'light:text-gray-400 dark:text-gray-500' }}">
							{{ $reg->votes()['local'] ? number_format($reg->votesPercent()['local'], 2) : '0' }}%
						</p>
						@auth
							@if (!$reg->userHasVoted())
				                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 mt-2 tracking-wide leading-6" wire:click="pollVote({{ $reg->id }}, 'local')">
				                    votar
				                </x-buttons.primary>
							@endif
						@endauth
					</div>
				</div>

				<div class="flex-1 py-1">
					<div class="px-1 flex items-center justify-end border-b border-gray-200 dark:border-gray-650">
						<div class="text-sm mr-2">{{ $reg->visitorTeam->team->medium_name }}</div>
						<img src="{{ $reg->visitorTeam->team->getImg() }}" alt="{{ $reg->visitorTeam->team->short_name }}" style="width: 32px; height: 32px">
					</div>
					<div class="text-center">
						<p class="text-2xl font-bold {{ $reg->votes()['visitor'] > $reg->votes()['visitor'] ? '' : 'light:text-gray-400 dark:text-gray-500' }}">
							{{ $reg->votes()['visitor'] ? number_format($reg->votesPercent()['visitor'], 2) : '0' }}%
						</p>
						@auth
							@if (!$reg->userHasVoted())
				                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 mt-2 tracking-wide leading-6" wire:click="pollVote({{ $reg->id }}, 'visitor')">
				                    votar
				                </x-buttons.primary>
							@endif
						@endauth
					</div>
				</div>
			</div>

			<div class="text-center text-xs w-full my-2">
				@auth
					@if ($reg->userHasVoted())
						<p>Has votado por la victoria de {{ $reg->userVote() == 'local' ? $reg->localTeam->team->medium_name : $reg->visitorTeam->team->medium_name }}</p>
		                <x-buttons.danger-outline class="uppercase text-xs px-2 py-0.5 mt-1" wire:click="pollDestroy({{ $reg->id }}, {{ auth()->user()->id }})">
		                    Eliminar voto
		                </x-buttons.danger-outline>
					@endif
				@endauth
				<p class="block light:text-gray-600 dark:text-gray-300 pt-3">
					@if ($reg->votes()['local'] + $reg->votes()['visitor'] > 0)
						{{ $reg->votes()['local'] + $reg->votes()['visitor'] }}
						@if ($reg->votes()['local'] + $reg->votes()['visitor'] == 1)
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
    </x-slot>
</x-jet-confirmation-modal>