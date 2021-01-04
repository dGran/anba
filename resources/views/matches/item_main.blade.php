<div class="score w-full md:w-1/2 md:border-r border-gray-200 dark:border-gray-700">
	<div class="flex justify-between items-center py-6">
		<div class="flex-1">
			<img src="{{ $reg->localTeam->team->getImg() }}" alt="{{ $reg->localTeam->team->short_name }}" style="width: 52px; height: 52px" class="mb-3 mx-auto">
			<div class="text-center text-sm">{{ $reg->localTeam->team->medium_name }}</div>
			<div class="text-center text-sm">{{ $current_season->get_table_data_team_record($reg->localTeam->id)['w'] }}-{{ $current_season->get_table_data_team_record($reg->localTeam->id)['l'] }}</div>
			<div class="text-center text-xs light:text-gray-500 dark:text-gray-300">{{ $reg->localTeam->team->user ? $reg->localTeam->team->user->name : 'sin manager' }}</div>
		</div>

		<div class="flex-1 text-center truncate">
	    	<p class="text-xs truncate">{{ $reg->stadium }}</p>
	    	<p class="font-bold text-3xl">{{ $reg->score() }}</p>
	    	<p class="text-xs">
		    	@if ($reg->scores->count()>0)
		    		{{ $reg->scores->first()->updated_at }}
		    	@else
		    		@if ($reg->votes()['local'] > 0 || $reg->votes()['visitor'] > 0)
		    			<div class="text-xs">
			    			<p>Pronósticos</p>
			    			<span>{{ $reg->votes()['local'] ? number_format($reg->votesPercent()['local'], 0) : '0' }}% - {{ $reg->votes()['visitor'] ? number_format($reg->votesPercent()['visitor'], 0) : '0' }}%</span>
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

	@if ($reg->played())
		<div class="border-t border-gray-200 dark:border-gray-700 py-4 px-3 text-center">
			<button class="px-2 py-0.5 uppercase text-xs text-blue-500 rounded focus:outline-none border border-blue-500 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
				boxscore
			</button>
		</div>
	@else
		<div class="border-t border-gray-200 dark:border-gray-700 py-4 px-3 text-center">
			<button class="px-2 py-0.5 uppercase text-xs text-blue-500 rounded focus:outline-none border border-blue-500 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
				reportar resultado
			</button>
			<button class="px-2 py-0.5 uppercase text-xs text-blue-500 rounded focus:outline-none border border-blue-500 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white">
				reportar estadisticas
			</button>
		</div>
	@endif
</div>