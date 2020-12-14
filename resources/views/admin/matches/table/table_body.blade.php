<tbody>
	@foreach ($regs as $reg)
		<tr class="{{ $regsSelected->find($reg->id) ? 'selected' : '' }} {{-- {{ $reg->active ?: 'text-gray-500' }} --}}" wire:click.stop="checkSelected({{ $reg->id }})">
			<td clas="check" style="min-width: 160px; padding: 0">
				<div class="d-flex align-items-center" style="height: inherit; padding: .5em 1em; {{ $fixedFirstColumn ? 'border-right: 1px solid #e2e8f0;' : 'border-right: 1px solid transparent;' }}">
				    <div class="pretty p-svg p-curve p-jelly p-has-focus mr-2 non-selectable">
				        <input type="checkbox" id="check{{ $reg->id }}" class="mousetrap"
						wire:model="regsSelectedArray.{{ $reg->id }}" value="{{ $reg->id }}"
						wire:change="checkSelected({{ $reg->id }})">
				        <div class="state p-primary">
				            <svg class="svg svg-icon" viewBox="0 0 20 20">
				                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
				            </svg>
				            <label></label>
				        </div>
				    </div>
					<div class="pl-2">
						<div class="name d-flex align-items-center" wire:click.stop="view({{ $reg->id }})">
							<span>{{ $reg->getName() }}</span>
						</div>
						<p class="{{-- {{ !$reg->active ?: 'text-muted' }} --}} text-xxs m-0">
							<strong class="mr-1">ID:</strong>
							{{ $reg->id }}
						</p>
					</div>
				</div>
			</td>
{{-- 			<td class="{{ $colConference ?: 'd-none' }}" style="width: 150px; min-width: 150px; max-width: 150px">
				<div class="d-flex align-items-center">
					@if ($showTableImages && $reg->conference)
						<img class="image rounded-circle non-selectable" src="{{ $reg->getConferenceImg() }}" alt="{{ $reg->conference ? $reg->conference->name : 'Conferencia' }}" style="width: 40px; {{ $reg->active ?: '-webkit-filter: grayscale(100%); filter: grayscale(100%);' }}">
					@endif
					<span class="{{ !$showTableImages ?: 'pl-2' }}">
						{{ $reg->conference ? $reg->conference->name : '' }}
					</span>
				</div>
			</td> --}}
			<td class="truncate {{ $colScores ?: 'd-none' }}" style="width: 300px; min-width: 300px; max-width: 300px">
				<div class="d-flex align-items-center">
					<div>
						<div style="min-width: 40px" class="text-right d-inline-block">{{ $reg->localTeam->team->short_name }}</div>
						<img src="{{ $reg->localTeam->team->getImg() }}" alt="{{ $reg->localTeam->team->short_name }}" style="width: 32px; height: 32px" class="rounded-circle border ml-1">
					</div>
					<div class="mx-3 text-center" style="min-width: 90px">
						@if ($reg->played())
		                	{{ $reg->score() }}
						@else
			                <button type="button" class="btn btn-primary text-xs text-uppercase tracking-widest text-white" wire:click.stop="boxscore({{ $reg->id }})">
			                    BoxScore
			                </button>
						@endif
					</div>
	                <div>
						<img src="{{ $reg->visitorTeam->team->getImg() }}" alt="{{ $reg->visitorTeam->team->short_name }}" style="width: 32px; height: 32px" class="rounded-circle border mr-1">
						<div style="min-width: 40px" class="text-left d-inline-block">{{ $reg->visitorTeam->team->short_name }}</div>
	                </div>
				</div>
			</td>
			<td class="truncate {{ $colLocalManager ?: 'd-none' }}" style="width: 200px; min-width: 200px; max-width: 200px">
				<div class="d-flex align-items-center">
					@if ($showTableImages && $reg->localManager)
						<img class="image rounded-circle non-selectable mr-2" src="{{ $reg->localManager->getImg() }}" alt="{{ $reg->localManager ? $reg->localManager->name : 'Sin manager' }}" style="width: 40px;">
					@endif
					<span>{{ $reg->localManager ? $reg->localManager->name : '' }}</span>
				</div>
			</td>
			<td class="truncate {{ $colVisitorManager ?: 'd-none' }}" style="width: 200px; min-width: 200px; max-width: 200px">
				<div class="d-flex align-items-center">
					@if ($showTableImages && $reg->visitorManager)
						<img class="image rounded-circle non-selectable mr-2" src="{{ $reg->visitorManager->getImg() }}" alt="{{ $reg->visitorManager ? $reg->visitorManager->name : 'Sin manager' }}" style="width: 40px;">
					@endif
					<span>{{ $reg->visitorManager ? $reg->visitorManager->name : '' }}</span>
				</div>
			</td>
			<td class="truncate {{ $colStadium ?: 'd-none' }}" style="width: 300px; min-width: 300px; max-width: 300px">
				{{ $reg->stadium }}
			</td>
		</tr>
	@endforeach
</tbody>

