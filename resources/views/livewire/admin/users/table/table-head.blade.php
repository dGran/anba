<thead>
	<tr class="admin-crud-table">
		<th class="check">
		    <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
		        <input type="checkbox" />
		        <div class="state p-primary">
		            <svg class="svg svg-icon" viewBox="0 0 20 20">
		                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
		            </svg>
		            <label></label>
		        </div>
		    </div>
		</th>
		<th>
			@if ($order == 'name' && $orderDirection == 'asc')
				<span class="d-inline-block cursor-pointer" wire:click="order('name', 'desc')">Nombre<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'name' && $orderDirection == 'desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('name', 'asc')">Nombre<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('name', 'asc')">Nombre</span>
			@endif
		</th>
		<th class="d-none d-md-table-cell text-center">
			@if ($order == 'created_at' && $orderDirection == 'asc')
				<span class="d-inline-block cursor-pointer" wire:click="order('created_at', 'desc')">Fecha registro<i class="fas fa-sort-numeric-up pl-1"></i></span>
			@elseif ($order == 'created_at' && $orderDirection == 'desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('created_at', 'asc')">Fecha registro<i class="fas fa-sort-numeric-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('created_at', 'asc')">Fecha registro</span>
			@endif
		</th>
		<th class="d-none d-md-table-cell text-center" style="width: 5em">
			<span>Estado</span>
		</th>
	</tr>
</thead>