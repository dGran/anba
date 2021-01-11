@if ($forecastsModal && $regEdit)
	<x-modals.dialog maxWidth="md" wire:model="forecastsModal" >
	    <x-slot name="title">
			<div class="p-4">
				<p class="uppercase text-sm font-bold tracking-wider">PRONOSTICOS</p>
				<p class="text-sm pt-2">Vota por el ganador del partido</p>
			</div>
	    </x-slot>

	    <x-slot name="content">
			<div class="px-4 pb-2">

				<div class="flex mb-4 mt-2">
					<div class="flex-1 border-r border-gray-200 dark:border-gray-650 py-1">
						<div class="px-1 flex items-center border-b border-gray-200 dark:border-gray-650">
							<img src="{{ $regEdit->localTeam->team->getImg() }}" alt="{{ $regEdit->localTeam->team->short_name }}" style="width: 32px; height: 32px">
							<div class="text-sm ml-2">{{ $regEdit->localTeam->team->medium_name }}</div>
						</div>
						<div class="text-center">
							<p class="text-2xl font-bold {{ $regEdit->votes()['local'] > $regEdit->votes()['visitor'] ? '' : 'light:text-gray-400 dark:text-gray-500' }}">
								{{ $regEdit->votes()['local'] ? number_format($regEdit->votesPercent()['local'], 2) : '0' }}%
							</p>
							@auth
								@if (!$regEdit->userHasVoted())
					                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 mt-2 tracking-wide leading-6" wire:click="pollVote({{ $regEdit->id }}, 'local')">
					                    votar
					                </x-buttons.primary>
								@endif
							@endauth
						</div>
					</div>

					<div class="flex-1 py-1">
						<div class="px-1 flex items-center justify-end border-b border-gray-200 dark:border-gray-650">
							<div class="text-sm mr-2">{{ $regEdit->visitorTeam->team->medium_name }}</div>
							<img src="{{ $regEdit->visitorTeam->team->getImg() }}" alt="{{ $regEdit->visitorTeam->team->short_name }}" style="width: 32px; height: 32px">
						</div>
						<div class="text-center">
							<p class="text-2xl font-bold {{ $regEdit->votes()['visitor'] > $regEdit->votes()['local'] ? '' : 'light:text-gray-400 dark:text-gray-500' }}">
								{{ $regEdit->votes()['visitor'] ? number_format($regEdit->votesPercent()['visitor'], 2) : '0' }}%
							</p>
							@auth
								@if (!$regEdit->userHasVoted())
					                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 mt-2 tracking-wide leading-6" wire:click="pollVote({{ $regEdit->id }}, 'visitor')">
					                    votar
					                </x-buttons.primary>
								@endif
							@endauth
						</div>
					</div>
				</div>

				<div class="text-center text-xs w-full my-2">
					@auth
						@if ($regEdit->userHasVoted())
							<p>Has votado por la victoria de {{ $regEdit->userVote() == 'local' ? $regEdit->localTeam->team->medium_name : $regEdit->visitorTeam->team->medium_name }}</p>
			                <x-buttons.danger-outline class="uppercase text-xs px-2 py-0.5 mt-1" wire:click="pollDestroy({{ $regEdit->id }}, {{ auth()->user()->id }})">
			                    Eliminar voto
			                </x-buttons.danger-outline>
						@endif
					@endauth
					<p class="block light:text-gray-600 dark:text-gray-300 pt-3">
						@if ($regEdit->votes()['local'] + $regEdit->votes()['visitor'] > 0)
							{{ $regEdit->votes()['local'] + $regEdit->votes()['visitor'] }}
							@if ($regEdit->votes()['local'] + $regEdit->votes()['visitor'] == 1)
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
@endif