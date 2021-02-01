<div class="w-full md:w-1/2">
	<div class="flex justify-between items-center py-3 lg:py-8">
		<div class="flex-1">
			<img src="{{ $reg->localTeam->team->getImg() }}" alt="{{ $reg->localTeam->team->short_name }}" style="width: 52px; height: 52px" class="mb-3 mx-auto">
			<div class="text-center text-sm">{{ $reg->localTeam->team->medium_name }}</div>
			<div class="text-center text-sm">{{ $current_season->get_table_data_team_record($reg->localTeam->id)['w'] }}-{{ $current_season->get_table_data_team_record($reg->localTeam->id)['l'] }}</div>
			<div class="text-center text-xs light:text-gray-500 dark:text-gray-300">{{ $reg->localTeam->team->user ? $reg->localTeam->team->user->name : 'sin manager' }}</div>
		</div>

		<div class="flex-1 text-center truncate">
	    	<p class="text-xs truncate">{{ $reg->stadium }}</p>
	    	<p class="font-bold text-2xl md:text-3xl my-1">{{ $reg->score() }}</p>
	    	<p class="text-xs">
		    	@if ($reg->scores->count()>0)
		    		{{ $reg->scores->first()->getUpdatedAt() }}
		    	@else
	    			<div class="text-xs">
		                <x-buttons.primary class="lg:hidden uppercase text-xs px-2 py-0 leading-6 block mx-auto mb-1" wire:click.prevent="openForecastsModal({{ $reg->id }})">
							Pronósticos
		                </x-buttons.primary>
	    				@if ($reg->votes()['local'] > 0 || $reg->votes()['visitor'] > 0)
		    				<p class="hidden lg:block font-bold uppercase">Pronósticos</p>
		    				<span>{{ $reg->votes()['local'] ? number_format($reg->votesPercent()['local'], 2) : '0' }}%</span>
		    				<span class="ml-3">{{ $reg->votes()['visitor'] ? number_format($reg->votesPercent()['visitor'], 2) : '0' }}%</span>
	    				@endif
	    			</div>
		    	@endif
	    	</p>
		</div>

	    <div class="flex-1">
			<img src="{{ $reg->visitorTeam->team->getImg() }}" alt="{{ $reg->visitorTeam->team->short_name }}" style="width: 52px; height: 52px" class="mb-3 mx-auto">
			<div class="text-center text-sm">{{ $reg->visitorTeam->team->medium_name }}</div>
			<div class="text-center text-sm">{{ $current_season->get_table_data_team_record($reg->visitorTeam->id)['w'] }}-{{ $current_season->get_table_data_team_record($reg->visitorTeam->id)['l'] }}</div>
			<div class="text-center text-xs light:text-gray-500 dark:text-gray-300">{{ $reg->visitorTeam->team->user ? $reg->visitorTeam->team->user->name : 'sin manager' }}</div>
	    </div>
	</div>

	<div class="border-t border-gray-200 dark:border-gray-650 px-4 h-16">
		<div class="h-full flex items-center justify-center">
			@if ($reg->played())
				<a href="{{ route('match', $reg->id) }}" class="transform hover:scale-125 focus:scale-125 transition duration-300 ease-in-out || text-blue-500 dark:text-dark-link rounded focus:outline-none border border-blue-500 dark:border-dark-link hover:bg-blue-500 focus:bg-blue-500 dark:hover:bg-blue-300 dark:focus:bg-blue-300 hover:text-white focus:text-white dark:hover:text-gray-900 dark:focus:text-gray-900 transition duration-150 ease-in-out">
	                <span class="uppercase text-xs px-3 py-0.5 leading-5">
	                    ficha del partido
	                </span>
                </a>
			@else
				@auth
					@if ($reg->userIsParticipant())
		                <x-buttons.primary class="uppercase text-xs px-2 py-0.5 leading-6">
							reportar resultado
		                </x-buttons.primary>
		                <x-buttons.primary class="ml-3 uppercase text-xs px-2 py-0.5 leading-6">
							reportar estadisticas
		                </x-buttons.primary>
		            @else
		            	<span class="text-md uppercase light:text-gray-500 dark:text-gray-400 font-bold lg:tracking-wider">Partido no disputado</span>
					@endif
	            @endauth
	            @guest
	            	<span class="text-md uppercase light:text-gray-500 dark:text-gray-400 font-bold lg:tracking-wider">Partido no disputado</span>
	            @endguest
			@endif
		</div>
	</div>
</div>
