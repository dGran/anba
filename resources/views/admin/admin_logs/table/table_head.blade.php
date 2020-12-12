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
		<th class="{{ $colType ?: 'd-none' }}">
			@if ($order == 'type')
				<span class="d-inline-block cursor-pointer" wire:click="order('type_desc')">Tipo<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'type_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('type')">Tipo<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('type')">Tipo</span>
			@endif
		</th>
		<th class="{{ $colTable ?: 'd-none' }}">
			@if ($order == 'table')
				<span class="d-inline-block cursor-pointer" wire:click="order('table_desc')">Tabla<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'table_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('table')">Tabla<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('table')">Tabla</span>
			@endif
		</th>
		<th class="{{ $colUser ?: 'd-none' }}">
			@if ($order == 'user')
				<span class="d-inline-block cursor-pointer" wire:click="order('user_desc')">Usuario<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'user_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('user')">Usuario<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('user')">Usuario</span>
			@endif
		</th>
		<th class="{{ $colDate ?: 'd-none' }}">
			@if ($order == 'date')
				<span class="d-inline-block cursor-pointer" wire:click="order('date_desc')">Fecha<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'date_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('date')">Fecha<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('date')">Fecha</span>
			@endif
		</th>
	</tr>
</thead>