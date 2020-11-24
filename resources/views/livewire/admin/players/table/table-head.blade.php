<thead class="">
	<tr class="admin-crud-table">
		<th class="check" wire:click.stop="checkAll">
		    <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
		        <input type="checkbox" wire:model="checkAllSelector" />
		        <div class="state p-primary">
		            <svg class="svg svg-icon" viewBox="0 0 20 20">
		                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
		            </svg>
		            <label></label>
		        </div>
		    </div>
		</th>
		<th class="pl-3">
			@if ($order == 'name' && $orderDirection == 'asc')
				<span class="d-inline-block cursor-pointer" wire:click="order('name', 'desc')">Nombre<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'name' && $orderDirection == 'desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('name', 'asc')">Nombre<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('name', 'asc')">Nombre</span>
			@endif
		</th>
		<th>
			@if ($order == 'position' && $orderDirection == 'asc')
				<span class="d-inline-block cursor-pointer" wire:click="order('position', 'desc')">Pos.<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'position' && $orderDirection == 'desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('position', 'asc')">Pos.<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('position', 'asc')">Pos.</span>
			@endif
		</th>
		<th>
			@if ($order == 'height' && $orderDirection == 'asc')
				<span class="d-inline-block cursor-pointer" wire:click="order('height', 'desc')">Altura<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'height' && $orderDirection == 'desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('height', 'asc')">Altura<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('height', 'asc')">Altura</span>
			@endif
		</th>
		<th>
			@if ($order == 'weight' && $orderDirection == 'asc')
				<span class="d-inline-block cursor-pointer" wire:click="order('weight', 'desc')">Peso<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'weight' && $orderDirection == 'desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('weight', 'asc')">Peso<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('weight', 'asc')">Peso</span>
			@endif
		</th>
	</tr>
</thead>