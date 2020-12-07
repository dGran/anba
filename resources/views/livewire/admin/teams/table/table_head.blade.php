<thead class="">
	<tr class="admin-crud-table">
		<th wire:click.stop="checkAll" class="check d-flex align-items-center">
		    <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
		        <input type="checkbox" wire:model="checkAllSelector" />
		        <div class="state p-primary">
		            <svg class="svg svg-icon" viewBox="0 0 20 20">
		                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
		            </svg>
		            <label></label>
		        </div>
		    </div>
		    <div class="pl-3 d-inline-block">
				@if ($order == 'name')
					<span class="d-inline-block cursor-pointer" wire:click="order('name_desc')">Nombre<i class="fas fa-sort-alpha-up pl-1"></i></span>
				@elseif ($order == 'name_desc')
					<span class="d-inline-block cursor-pointer" wire:click="order('name')">Nombre<i class="fas fa-sort-alpha-down pl-1"></i></span>
				@else
					<span class="d-inline-block cursor-pointer" wire:click="order('name')">Nombre</span>
				@endif
		    </div>
		</th>
		<th class="{{ $colMediumName ?: 'd-none' }}">
			@if ($order == 'medium_name')
				<span class="d-inline-block cursor-pointer" wire:click="order('medium_name_desc')">Nombre medio<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'medium_name_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('medium_name')">Nombre medio<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('medium_name')">Nombre medio</span>
			@endif
		</th>
		<th class="{{ $colShortName ?: 'd-none' }}">
			@if ($order == 'short_name')
				<span class="d-inline-block cursor-pointer" wire:click="order('short_name_desc')">Nombre corto<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'short_name_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('short_name')">Nombre corto<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('short_name')">Nombre corto</span>
			@endif
		</th>
		<th class="{{ $colDivision ?: 'd-none' }}">
			@if ($order == 'division')
				<span class="d-inline-block cursor-pointer" wire:click="order('division_desc')">División<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'division_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('division')">División<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('division')">División</span>
			@endif
		</th>
		<th class="{{ $colManager ?: 'd-none' }}">
			@if ($order == 'manager')
				<span class="d-inline-block cursor-pointer" wire:click="order('manager_desc')">Manager<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'manager_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('manager')">Manager<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('manager')">Manager</span>
			@endif
		</th>
		<th class="{{ $colColor ?: 'd-none' }}">
			<span class="d-inline-block">Color</span>
		</th>
		<th class="{{ $colStadium ?: 'd-none' }}">
			@if ($order == 'stadium')
				<span class="d-inline-block cursor-pointer" wire:click="order('stadium_desc')">Estadio<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'stadium_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('stadium')">Estadio<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('stadium')">Estadio</span>
			@endif
		</th>
	</tr>
</thead>