<tbody>
	@foreach ($regs as $reg)
		<tr class="{{ $regsSelected->find($reg->id) ? 'selected' : '' }}" wire:click.stop="checkSelected({{ $reg->id }})">
			<td style="min-width: 200px; padding: 0">
				<div class="d-flex align-items-center" style="height: inherit; padding: .5em 1em; {{ $fixedFirstColumn ? 'border-right: 1px solid #e2e8f0;' : 'border-right: 1px solid transparent;' }}">
				    <div class="pretty p-svg p-curve p-jelly p-has-focus mr-2">
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
				    @if ($showTableImages)
						<img class="image rounded-circle" src="{{ $reg->getImg() }}" alt="{{ $reg->name }}" style="width: 40px; {{ $reg->retired ? '-webkit-filter: grayscale(100%); filter: grayscale(100%);' : '' }}">
				    @endif
					<div class="pl-2">
						<div class="name d-flex align-items-center" wire:click.stop="view({{ $reg->id }})">
							{{-- <span class="text-xxs text-uppercase mr-2 {{ $reg->retired ?: 'd-none' }}" style="color: rgba(239, 68, 68, 1)">Retirado</span> --}}
							<span class="{{ !$reg->retired ?: 'text-gray-500' }}">{{ $reg->name }}</span>
							@if ($showNicknames)
								<span class="text-xxs ml-2 {{ $reg->nickname ?: 'd-none' }} {{ !$reg->retired ?: 'text-gray-500' }}">"{{ $reg->nickname }}"</span>
							@endif
						</div>
						<p class="text-muted text-xxs m-0">
							<strong class="mr-1">ID:</strong>
							{{ $reg->id }}
						</p>
					</div>
				</div>
			</td>
			<td class="{{ $colTeam ?: 'd-none' }}" style="width: 300px; min-width: 300px; min-width: 300px">
				<div class="d-flex align-items-center">
					@if (!$reg->retired)
						@if ($showTableImages)
							<img class="image rounded-circle pr-2" src="{{ $reg->getTeamImg() }}" alt="{{ $reg->team ? $reg->team->name : 'Free Agent' }}" style="width: 40px;">
						@endif
						<span class="{{ !$reg->team ? 'text-muted' : '' }}">
							{{ $reg->team ? $reg->team->name : 'Free Agent' }}
						</span>
					@else
						<span class="text-gray-500 text-uppercase text-sm">
							***Jugador retirado
						</span>
					@endif
				</div>
			</td>
			<td class="{{ $colPosition ?: 'd-none' }}" style="width: 175px; min-width: 175px; min-width: 175px">
				<div class="d-flex align-items-center">
					<div class="mr-2 d-inline-block text-xs font-weight-bold text-uppercase" style="width: 20px">{{ $reg->position }}</div>{{ $reg->getPosition() }}
				</div>
			</td>
			<td class="truncate {{ $colNation ?: 'd-none' }}" style="width: 200px; min-width: 200px; max-width: 200px">
				<span>
					{{ $reg->nation_name }}
				</span>
			</td>
			<td class="text-center {{ $colAge ?: 'd-none' }}" style="width: 90px; min-width: 90px; min-width: 90px">
				<span>
					{{ $reg->age() }}
				</span>
			</td>
			<td class="text-center {{ $colHeight ?: 'd-none' }}" style="width: 100px; min-width: 100px">
				<span>
					{{ $reg->height ? $reg->getHeight() . ' ft' : '' }}
				</span>
			</td>
			<td class="text-center {{ $colWeight ?: 'd-none' }}" style="width: 90px; min-width: 90px; min-width: 90px">
				<span>
					{{ $reg->weight ? $reg->weight . ' lbs' : '' }}
				</span>
			</td>
			<td class="text-center {{ $colDraftYear ?: 'd-none' }}" style="width: 130px; min-width: 130px; max-width: 130px">
				<span>
					{{ $reg->draft_year }}
				</span>
			</td>
			<td class="truncate {{ $colCollege ?: 'd-none' }}" style="width: 300px; min-width: 300px; max-width: 300px">
				<span>
					{{ $reg->college }}
				</span>
			</td>
		</tr>
	@endforeach
</tbody>

