<tbody>
	@foreach ($regs as $reg)
		<tr class="{{ $regsSelected->find($reg->id) ? 'selected' : '' }}" wire:click.stop="checkSelected({{ $reg->id }})">
			<td clas="check" style="min-width: 200px; padding: 0">
				<div class="d-flex align-items-center" style="height: inherit; padding: .5em 1em; }}">
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
						<img class="image rounded-circle non-selectable" src="{{ $reg->getImg() }}" alt="{{ $reg->name }}" style="width: 40px; {{ !$reg->active ? '-webkit-filter: grayscale(100%); filter: grayscale(100%);' : '' }}">
				    @endif
					<div class="pl-2">
						<div class="name d-flex align-items-center" wire:click.stop="view({{ $reg->id }})">
							<span class="{{ $reg->active ?: 'text-gray-500' }}">{{ $reg->name }}</span>
						</div>
						<p class="text-muted text-xxs m-0">
							<strong class="mr-1">ID:</strong>
							{{ $reg->id }}
						</p>
					</div>
				</div>
			</td>
		</tr>
	@endforeach
</tbody>

