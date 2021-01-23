<tbody>
	@foreach ($regs as $reg)
		<tr class="{{ $regsSelected->find($reg->id) ? 'selected' : '' }}" wire:click.stop="checkSelected({{ $reg->id }})">
			<td class="check" style="min-width: 250px; padding: 0">
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
				    @if ($showTableImages)
						<img class="image rounded-circle non-selectable" src="{{ $reg->getImg() }}" alt="{{ $reg->title }}" style="width: 40px;">
				    @endif
					<div class="pl-2" style="width: 150px; min-width: 150px; max-width: 150px">
						<div class="name d-flex align-items-center" wire:click.stop="view({{ $reg->id }})">
							<span class="truncate">{{ $reg->title }}</span>
						</div>
						<p class="text-xxs m-0">
							<strong class="mr-1">ID:</strong>
							{{ $reg->id }}
						</p>
					</div>
				</div>
			</td>
			<td class="{{ $colType ?: 'd-none' }}" style="width: 175px; min-width: 175px; max-width: 175px">
				<span class="text-uppercase">
					{{ $reg->type }}
				</span>
			</td>
			<td class="{{ $colCategory ?: 'd-none' }}" style="width: 175px; min-width: 175px; max-width: 175px">
				<span>
					{{ $reg->category }}
				</span>
			</td>
			<td class="{{ $colDescription ?: 'd-none' }} truncate" style="width: 350px; min-width: 350px; max-width: 350px">
				<span>
					{{ $reg->description }}
				</span>
			</td>
			<td class="{{ $colDate ?: 'd-none' }}" style="width: 180px; min-width: 180px; max-width: 180px">
				<span>
					{{ $reg->getCreatedAtDate() }} - {{ $reg->getCreatedAtTime() }}
				</span>
			</td>
		</tr>
	@endforeach
</tbody>

