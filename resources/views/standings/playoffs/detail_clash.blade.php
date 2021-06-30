@if ($detailClash)
	<x-modals.dialog maxWidth="" wire:model="detailClash" >
	    <x-slot name="title">
			<div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-650 bg-gray-50 dark:bg-gray-700">
				<p class="uppercase text-sm font-bold tracking-wider">
					{{ $currentDetailClash->localTeam->team->medium_name }} vs {{ $currentDetailClash->visitorTeam->team->medium_name }}
				</p>
				<p class="uppercase text-sm font-bold tracking-wider">
					{{ $currentDetailClash->round->name }}
				</p>
			</div>
	    </x-slot>

	    <x-slot name="content">
			<div class="px-4 py-4">
	            @if ($currentDetailClash->localTeam && $currentDetailClash->visitorTeam)
                	<table class="detail-clash">
                		<thead>
	                		<tr>
	                			<td class="team w-32"></td>
	                			<td class="result">P1</td>
	                			<td class="result">P2</td>
	                			<td class="result">P3</td>
	                			<td class="result">P4</td>
	                			<td class="result">P5</td>
	                			<td class="result">P6</td>
	                			<td class="result">P7</td>
	                		</tr>
                		</thead>
                		<tbody>
	                		<tr>
	                			<td class="team">
	                				{{ $currentDetailClash->localTeam->team->medium_name }}
	                			</td>
				                @foreach ($currentDetailClash->matches as $match)
				                    <td class="result">
				                        @foreach ($match->scores as $score)
				                            @if ($currentDetailClash->local_team_id == $match->local_team_id)
				                                <span class="{{ $score->local_score > $score->visitor_score ? 'text-sm font-bold' : '' }}">{{ $score->local_score }}</span>
				                            @else
				                                <span class="{{ $score->visitor_score > $score->local_score ? 'text-sm font-bold' : '' }}">{{ $score->visitor_score }}</span>
				                            @endif
				                        @endforeach
				                    </td>
				                @endforeach
	                		</tr>
	                		<tr>
	                			<td class="team">
	                				{{ $currentDetailClash->visitorTeam->team->medium_name }}
	                			</td>
				                @foreach ($currentDetailClash->matches->sortBy('order') as $match)
				                    <td class="result">
				                        @foreach ($match->scores as $score)
				                            @if ($currentDetailClash->visitor_team_id == $match->local_team_id)
				                                <span class="{{ $score->local_score > $score->visitor_score ? 'text-sm font-bold' : '' }}">{{ $score->local_score }}</span>
				                            @else
				                                <span class="{{ $score->visitor_score > $score->local_score ? 'text-sm font-bold' : '' }}">{{ $score->visitor_score }}</span>
				                            @endif
				                        @endforeach
				                    </td>
				                @endforeach
	                		</tr>
                		</tbody>
                	</table>
	            @endif

			</div>
	    </x-slot>
	</x-modals.dialog>
@endif