<div class="score w-full md:w-1/2 md:border-r border-gray-200 dark:border-gray-650">
	<div class="flex justify-between items-center py-8">
		<div class="flex-1">
			<img src="{{ $reg->localTeam->team->getImg() }}" alt="{{ $reg->localTeam->team->short_name }}" style="width: 52px; height: 52px" class="mb-3 mx-auto">
			<div class="text-center text-sm">{{ $reg->localTeam->team->medium_name }}</div>
			<div class="text-center text-sm">{{ $current_season->get_table_data_team_record($reg->localTeam->id)['w'] }}-{{ $current_season->get_table_data_team_record($reg->localTeam->id)['l'] }}</div>
			<div class="text-center text-xs light:text-gray-500 dark:text-gray-300">{{ $reg->localTeam->team->user ? $reg->localTeam->team->user->name : 'sin manager' }}</div>
		</div>

		<div class="flex-1 text-center truncate">
	    	<p class="text-xs truncate">{{ $reg->stadium }}</p>
	    	<p class="font-bold text-3xl my-1">{{ $reg->score() }}</p>
	    	<p class="text-xs">
		    	@if ($reg->scores->count()>0)
		    		{{ $reg->scores->first()->updated_at }}
		    	@else
		    		@if ($reg->votes()['local'] > 0 || $reg->votes()['visitor'] > 0)
		    			<div class="text-xs">
			    			<p class="font-bold">Pronósticos</p>
			    			<span>{{ $reg->votes()['local'] ? number_format($reg->votesPercent()['local'], 2) : '0' }}%</span>
			    			<span class="ml-3">{{ $reg->votes()['visitor'] ? number_format($reg->votesPercent()['visitor'], 2) : '0' }}%</span>
		    			</div>
		    		@endif
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
		<div class="h-full flex items-center justify-center gap-3">
			@if ($reg->played())
                <x-buttons.primary-outline class="uppercase text-xs px-2 py-0.5 leading-5">
                    boxscore
                </x-buttons.primary-outline>
			@else
				@auth
					@if ($reg->userIsParticipant())
		                <x-buttons.primary class="uppercase text-xs px-2 py-0.5 leading-6">
							reportar resultado
		                </x-buttons.primary>
		                <x-buttons.primary class="uppercase text-xs px-2 py-0.5 leading-6">
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