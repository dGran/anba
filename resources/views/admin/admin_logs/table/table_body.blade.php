<tbody>
	@foreach ($data as $datum)
		<tr class="{{ $selectedData->find($datum->id) ? 'selected' : '' }}" wire:click.stop="checkSelected({{ $datum->id }})">
			<td clas="check" style="min-width: 200px; padding: 0">
				<div class="d-flex align-items-center" style="height: inherit; padding: .5em 1em; {{ $isFixedFirstColumn ? 'border-right: 1px solid #e2e8f0;' : 'border-right: 1px solid transparent;' }}">
				    <div class="pretty p-svg p-curve p-jelly p-has-focus mr-2 non-selectable">
				        <input type="checkbox" id="check{{ $datum->id }}" class="mousetrap"
						wire:model="regsSelectedArray.{{ $datum->id }}" value="{{ $datum->id }}"
						wire:change="checkSelected({{ $datum->id }})">
				        <div class="state p-primary">
				            <svg class="svg svg-icon" viewBox="0 0 20 20">
				                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
				            </svg>
				            <label></label>
				        </div>
				    </div>
					<div class="pl-2">
						<div class="name d-flex align-items-center" wire:click.stop="view({{ $datum->id }})">
							@if ($datum->detail_before == 'Registro importado')
								<span class="text-uppercase text-xs bg-light rounded mr-2 px-2 border text-gray-600 d-flex align-items-center">
									<i class="bx bxs-file-import mr-1"></i><span>importado</span>
								</span>
							@endif
							@if ($datum->detail_before == 'Registro duplicado')
								<span class="text-uppercase text-xs bg-light rounded mr-2 px-2 border text-gray-600 d-flex align-items-center">
									<i class='bx bxs-copy mr-1'></i><span>duplicado</span>
								</span>
							@endif
							<span>{{ $datum->reg_name }}</span>
						</div>
						<p class="text-muted text-xxs m-0">
							<strong class="mr-1">ID:</strong>
							{{ $datum->id }}
							<strong class="mx-1">/</strong>
							<strong class="mr-1">REG ID:</strong>
							{{ $datum->reg_id }}
						</p>
					</div>
				</div>
			</td>
			<td class="{{ $isShowTypeColumn ?: 'd-none' }}" style="width: 90px; min-width: 90px; max-width: 90px">
				<span class="text-uppercase text-xs rounded px-2 py-1"
					style="{{ $datum->type == 'INSERT' ? 'border: 1px solid rgba(167, 243, 208, 1); background-color: rgba(236, 253, 245, 1); color: rgba(52, 211, 153, 1)' : '' }}
					{{ $datum->type == 'UPDATE' ? 'border: 1px solid rgba(229, 231, 235, 1); background-color: rgba(249, 250, 251, 1); color: rgba(156, 163, 175, 1)' : '' }}
					{{ $datum->type == 'DELETE' ? 'border: 1px solid rgba(254, 202, 202, 1); background-color: rgba(254, 242, 242, 1); color: rgba(248, 113, 113, 1)' : '' }}">
					{{ $datum->type }}
				</span>
			</td>
			<td class="truncate {{ $isShowTableColumn ?: 'd-none' }}" style="width: 200px; min-width: 200px; max-width: 200px">
				<span>
					{{ $datum->table }}
				</span>
			</td>
			<td class="truncate {{ $isShowUserColumn ?: 'd-none' }}" style="width: 200px; min-width: 200px; max-width: 200px">
				<div class="d-flex align-items-center">
					@if ($isShowTableImages)
						<img class="image rounded-circle non-selectable" src="{{ $datum->user->profile_photo_url }}" alt="{{ $datum->user ? $datum->user->name : 'Usuario' }}" style="width: 40px;">
					@endif
					<span class="truncate {{ !$isShowTableImages ?: 'pl-2' }} {{ !$datum->user ? 'text-muted' : '' }}">
						{{ $datum->user ? $datum->user->name : '' }}
					</span>
				</div>
			</td>
			<td class="{{ $isShowDateColumn ?: 'd-none' }}" style="width: 200px; min-width: 200px; max-width: 200px">
				<span>
					{{ $datum->getCreatedAtDate() }} - {{ $datum->getCreatedAtTime() }}
				</span>
			</td>
		</tr>
	@endforeach
</tbody>

