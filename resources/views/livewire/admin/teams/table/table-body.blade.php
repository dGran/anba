<tbody>
	@foreach ($regs as $reg)
		<tr class="{{ $regsSelected->find($reg->id) ? 'selected' : '' }}" wire:click.stop="checkSelected({{ $reg->id }})">
			<td class="check">
			    <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
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
			</td>
			<td>
				<div class="d-flex align-items-center">
					<img class="image rounded" src="{{ $reg->getImg() }}" alt="{{ $reg->name }}">
					<div class="pl-2">
						<span class="name truncate" wire:click.stop="edit({{ $reg->id }})">
							{{ $reg->name }}
						</span>
					</div>
				</div>
			</td>
			<td class="d-none d-md-table-cell text-center" style="width: 12rem;">
				<div class="text-xs text-uppercase">
					<span class="d-block">{{ $reg->getCreatedAtDate() }}</span>
					<span class="text-secondary">
						<i class="far fa-clock mr-1"></i>
						{{ $reg->getCreatedAtTime() }}
					</span>
				</div>
			</td>
		</tr>
	@endforeach
</tbody>