<div class="w-full md:w-1/2">
	<div class="flex justify-between items-center py-3 lg:py-8">
		<div class="flex-1">
			<img src="{{ $reg->localTeam->team->getImg() }}" alt="{{ $reg->localTeam->team->short_name }}" style="width: 52px; height: 52px" class="mb-3 mx-auto">

			<div class="text-center text-sm">{{ $reg->localTeam->team->medium_name }}</div>
			<div class="text-center text-sm">{{ $current_season->get_table_data_team_record($reg->localTeam->id)['w'] }}-{{ $current_season->get_table_data_team_record($reg->localTeam->id)['l'] }}</div>
			<div class="text-center text-xs light:text-gray-500 dark:text-gray-300">{{ $reg->localManager ? $reg->localManager->name : 'sin manager' }}</div>
		</div>

		<div class="flex-1 text-center truncate">
	    	<p class="text-xs truncate">{{ $reg->stadium }}</p>
	    	<p class="font-bold text-2xl md:text-3xl my-1">{{ $reg->score() }}</p>
	    	<p class="text-xs">
		    	@if ($reg->scores->count()>0)
		    		{{ $reg->scores->first()->getUpdatedAt() }}
		    	@else
	    			<div class="text-xs">
		                <span class="lg:hidden uppercase font-bold underline text-xs px-2 py-0 hover:text-blue-600 focus:text-blue-600 dark:hover:text-dark-link dark:focus:text-dark-link block mx-auto mb-1 cursor-pointer focus:outline-none" wire:click.prevent="openForecastsModal({{ $reg->id }})">
							Pronósticos
		                </span>
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
			<div class="text-center text-xs light:text-gray-500 dark:text-gray-300">{{ $reg->visitorManager ? $reg->visitorManager->name : 'sin manager' }}</div>
	    </div>
	</div>

	<div class="border-t border-gray-200 dark:border-gray-650 px-4 h-16">
		<div class="h-full flex items-center justify-center">
			<a href="{{ route('match', $reg->id) }}">
				@if ($reg->played())
					@if (!count($reg->teamStats) || !count($reg->playerStats))
		                <x-buttons.warning class="uppercase text-xs px-2.5 py-0.5 leading-6">
							<i class="fas fa-exclamation mr-2 animate-pulse"></i>ficha del partido
		                </x-buttons.warning>
	                @else
		                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 leading-6">
							ficha del partido
		                </x-buttons.primary>
		            @endif
	            @else
	                <x-buttons.primary-outline class="uppercase text-xs px-2.5 py-0.5 leading-6">
						informe pre-partido
	                </x-buttons.primary-outline>
				@endif
            </a>
		</div>
	</div>
</div>
