@if ($pending_matches->count() == 0)
	<div class="text-2xl md:text-3xl font-bold">
		Bravo!
		{{ Spatie\Emoji\Emoji::clapping_hands() }}
	</div>
	<p class="pt-1.5">No tienes partidos pendientes</p>
@else
	<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    	@foreach ($pending_matches as $match)
	        <div class="bg-white dark:bg-gray-750 overflow-hidden shadow-md rounded-md md:mx-0 p-2 text-gray-900 dark:text-gray-200">
	            <div class="py-1.5">
	                <div class="flex items-center justify-between text-xs px-4">
		            	@if ($match['round_id'] == null)
		            		Liga regular
		            	@else
		            		Playoffs
		            	@endif
	                    <span>{{ $match["stadium"] }}</span>
	                </div>
	                <div class="flex items-center justify-center text-center py-2">
	                     <span class="flex-1 text-right md:hidden mr-3">{{ $match['localTeam_short_name'] }}</span>
	                     <span class="flex-1 text-right hidden md:block mr-3">{{ $match['localTeam_medium_name'] }}</span>
	                     <img src="{{ $match['localTeam_img'] }}" alt="{{ $match['localTeam_short_name'] }}" class="w-8 h-8 object-cover">
	                     <div class="flex flex-col">
	                         <a href="{{ route('match', $match['id']) }}" class="flex-0 flex flex-col mx-3 rounded px-2 py-0.5 w-30 text-center bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-transparent | hover:bg-white focus:bg-white focus:outline-none dark:hover:bg-dark-link dark:hover:text-gray-900 dark:focus:bg-dark-link dark:focus:text-gray-900 text-xs uppercase">
	                             ir al partido
	                         </a>
	                     </div>
	                     <img src="{{ $match['visitorTeam_img'] }}" alt="{{ $match['visitorTeam_short_name'] }}" class="w-8 h-8 object-cover">
	                     <span class="flex-1 text-left md:hidden ml-3">{{ $match['visitorTeam_short_name'] }}</span>
	                     <span class="flex-1 text-left hidden md:block ml-3">{{ $match['visitorTeam_medium_name'] }}</span>
	                </div>
	            </div>
			</div>
    	@endforeach
	</div>
@endif