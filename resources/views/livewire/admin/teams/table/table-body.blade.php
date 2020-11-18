<tbody>
	@foreach ($regs as $team)
		<tr class="{{ $regsSelected->find($team->id) ? 'selected' : '' }}" wire:click.stop="checkSelected({{ $team->id }})">
			<td class="check">
			    <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
			        <input type="checkbox" id="check{{ $team->id }}" class="mousetrap form-checkbox h-4 w-4 sm:h-5 sm:w-5 text-indigo-400"
					wire:model="regsSelectedArray.{{ $team->id }}" value="{{ $team->id }}"
					wire:change="checkSelected({{ $team->id }})">
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
					<img class="image rounded-circle" src="{{ $team->profile_photo_url }}" alt="{{ $team->name }}" style="height: 40px">
					<div class="pl-2">
						<span class="name truncate" wire:click.stop="edit({{ $team->id }})">
							{{ $team->name }}
						</span>
						<span class="d-block text-sm text-gray-600 truncate">
							{{-- {{ $team->email }} --}}
						</span>
					</div>
				</div>
			</td>
			<td class="d-none d-md-table-cell text-center" style="width: 12rem;">
				<div class="text-xs text-uppercase">
					<span class="d-block">{{ $team->getCreatedAtDate() }}</span>
					<span class="text-secondary">
						<i class="far fa-clock mr-1"></i>
						{{ $team->getCreatedAtTime() }}
					</span>
				</div>
			</td>
		</tr>
	@endforeach
</tbody>