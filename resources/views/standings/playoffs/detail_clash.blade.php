@if ($detailClash)
	<x-modals.dialog maxWidth="" wire:model="detailClash" >
	    <x-slot name="title">
			<div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-650 bg-gray-50 dark:bg-gray-700">
				<p class="uppercase text-sm font-bold tracking-wider">
					<span class="sm:hidden">{{ $currentDetailClash->localTeam->team->short_name }} vs {{ $currentDetailClash->visitorTeam->team->short_name }}</span>
					<span class="hidden sm:block">{{ $currentDetailClash->localTeam->team->medium_name }} vs {{ $currentDetailClash->visitorTeam->team->medium_name }}</span>
				</p>
				<p class="uppercase text-sm font-bold tracking-wider">
					{{ $currentDetailClash->round->name }}
				</p>
			</div>
	    </x-slot>

	    <x-slot name="content">
			<div class="px-4 py-4">

				<div class="overflow-x-auto">
	            	<table class="detail-clash">
	            		<thead>
	                		<tr class="border-b dark:border-gray-650">
	                			<td class="team border-r dark:border-gray-650"></td>
	                			@if ($currentDetailClash->matches->count() > $currentDetailClash->round->matches_to_win)
					            	@foreach ($currentDetailClash->matches->sortBy('order') as $key => $match)
					            		@if ($match->played)
					            			<td class="result">P{{ $key+1 }}</td>
					            		@endif
					            	@endforeach
					            @else
					            	@for ($i = 1; $i < $currentDetailClash->round->matches_to_win+1; $i++)
					            		<td class="result">P{{ $i }}</td>
					            	@endfor
	                			@endif
	                		</tr>
	            		</thead>
	            		<tbody>
	                		<tr>
	                			<td class="team border-r dark:border-gray-650" style="min-width: 120px">
	                				<div class="flex items-center">
	                					<img src="{{ $currentDetailClash->localTeam->team->getImg() }}" alt="{{ $currentDetailClash->localTeam->team->short_name }}" class="w-8 h-8 object-cover mr-2">
	                					<span class="sm:hidden">{{ $currentDetailClash->localTeam->team->short_name }}</span>
	                					<span class="hidden sm:block">{{ $currentDetailClash->localTeam->team->medium_name }}</span>
	                				</div>
	                			</td>
				                @foreach ($currentDetailClash->matches as $match)
	                        		@if ($match->played)
					                    <td class="result">
					                        @foreach ($match->scores as $score)
					                            @if ($currentDetailClash->local_team_id == $match->local_team_id)
					                                <span class="{{ $score->local_score > $score->visitor_score ? 'font-bold' : '' }}">{{ $score->local_score }}</span>
					                            @else
					                                <span class="{{ $score->visitor_score > $score->local_score ? 'font-bold' : '' }}">{{ $score->visitor_score }}</span>
					                            @endif
					                        @endforeach
					                    </td>
									@endif
				                @endforeach
				                @if ($currentDetailClash->matches->count() < $currentDetailClash->round->matches_to_win)
					            	@for ($i = $currentDetailClash->matches->count(); $i < $currentDetailClash->round->matches_to_win+1; $i++)
					            		<td class="result">-</td>
					            	@endfor
				                @endif
	                		</tr>
	                		<tr>
	                			<td class="team border-r dark:border-gray-650">
	                				<div class="flex items-center">
	                					<img src="{{ $currentDetailClash->visitorTeam->team->getImg() }}" alt="{{ $currentDetailClash->visitorTeam->team->short_name }}" class="w-8 h-8 object-cover mr-2">
	                					<span class="sm:hidden">{{ $currentDetailClash->visitorTeam->team->short_name }}</span>
	                					<span class="hidden sm:block">{{ $currentDetailClash->visitorTeam->team->medium_name }}</span>
	                				</div>
	                			</td>
				                @foreach ($currentDetailClash->matches->sortBy('order') as $match)
		                        	@if ($match->played)
					                    <td class="result">
					                        @foreach ($match->scores as $score)
					                            @if ($currentDetailClash->visitor_team_id == $match->local_team_id)
					                                <span class="{{ $score->local_score > $score->visitor_score ? 'font-bold' : '' }}">{{ $score->local_score }}</span>
					                            @else
					                                <span class="{{ $score->visitor_score > $score->local_score ? 'font-bold' : '' }}">{{ $score->visitor_score }}</span>
					                            @endif
					                        @endforeach
					                    </td>
			                        @endif
				                @endforeach
				                @if ($currentDetailClash->matches->count() < $currentDetailClash->round->matches_to_win)
					            	@for ($i = $currentDetailClash->matches->count(); $i < $currentDetailClash->round->matches_to_win+1; $i++)
					            		<td class="result">-</td>
					            	@endfor
				                @endif
	                		</tr>
	            		</tbody>
	            	</table>
				</div>

            	<div class="pt-4 overflow-y-auto h-80 md:h-auto">
	            	@foreach ($currentDetailClash->matches->sortBy('order') as $key => $match)
	            		@if ($match->played)
		            		<div class="border-t dark:border-gray-650 py-2 px-2">
		            			<div class="flex items-center justify-between">
			            			<span class="text-sm">Partido {{ $key+1 }}</span>
			            			<span class="text-xs">{{ $match->stadium }}</span>
		            			</div>
			            		<div class="flex items-center justify-between py-2">
			            			<div class="flex-1 flex items-center justify-end">
	                					<span class="sm:hidden text-right text-sm">{{ $match->localTeam->team->short_name }}</span>
	                					<span class="hidden sm:block text-right text-sm">{{ $match->localTeam->team->medium_name }}</span>
			            				<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" class="w-8 h-8 object-cover ml-2">
			            			</div>
			            			{{-- <span class="px-2 w-32 text-center text-base">{{ $match->score() }}</span> --}}
									<a href="{{ route('match', $match->id) }}" target="_blank" class="text-center text-base rounded px-2 py-0.5 w-20 text-center bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-transparent | hover:bg-white focus:bg-white focus:outline-none dark:hover:bg-dark-link dark:hover:text-gray-900 dark:focus:bg-dark-link dark:focus:text-gray-900 mx-3">
										<span class="text-sm">{{ $match->score() }}</span>
									</a>
			            			<div class="flex-1 flex items-center">
			            				<img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->short_name }}" class="w-8 h-8 object-cover mr-2">
	                					<span class="sm:hidden text-sm">{{ $match->visitorTeam->team->short_name }}</span>
	                					<span class="hidden sm:block text-sm">{{ $match->visitorTeam->team->medium_name }}</span>
			            			</div>
		            			</div>
	            			</div>
	            		@endif
	            	@endforeach
            	</div>

			</div>
	    </x-slot>
	</x-modals.dialog>
@endif