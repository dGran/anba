<thead class="">
	<tr class="admin-crud-table">
		<th wire:click="checkAll" class="check d-flex align-items-center">
		    <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
		        <input type="checkbox" @if ($isCheckAllSelector) checked @endif wire:click="checkAll">
		        <div class="state p-primary">
		            <svg class="svg svg-icon" viewBox="0 0 20 20">
		                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white; fill:white;"></path>
		            </svg>
		            <label></label>
		        </div>
		    </div>
		    <div class="pl-3 d-inline-block" wire:click="checkAll">
				@if ($orderBy === 'name')
					<span class="header-name" wire:click.stop="setOrderBy('name_desc')">Nombre<i class="fas fa-sort-up pl-1"></i></span>
				@elseif ($orderBy === 'name_desc')
					<span class="header-name" wire:click.stop="setOrderBy('name')">Nombre<i class="fas fa-sort-down pl-1"></i></span>
				@else
					<span class="header-name" wire:click.stop="setOrderBy('name')">Nombre</span>
				@endif
		    </div>
		</th>
		<th class="{{ $isShowTypeColumn ?: 'd-none' }}" wire:click="checkAll">
			@if ($orderBy === 'type')
				<span class="header-name" wire:click.stop="setOrderBy('type_desc')">Tipo<i class="fas fa-sort-up pl-1"></i></span>
			@elseif ($orderBy === 'type_desc')
				<span class="header-name" wire:click.stop="setOrderBy('type')">Tipo<i class="fas fa-sort-down pl-1"></i></span>
            @else
				<span class="header-name" wire:click.stop="setOrderBy('type')">Tipo</span>
			@endif
		</th>
		<th class="{{ $isShowTableColumn ?: 'd-none' }}" wire:click="checkAll">
			@if ($orderBy === 'table')
				<span class="header-name" wire:click.stop="setOrderBy('table_desc')">Tabla<i class="fas fa-sort-up pl-1"></i></span>
			@elseif ($orderBy === 'table_desc')
				<span class="header-name" wire:click.stop="setOrderBy('table')">Tabla<i class="fas fa-sort-down pl-1"></i></span>
			@else
				<span class="header-name" wire:click.stop="setOrderBy('table')">Tabla</span>
			@endif
		</th>
		<th class="{{ $isShowUserColumn ?: 'd-none' }}" wire:click="checkAll">
			@if ($orderBy === 'user')
				<span class="header-name" wire:click.stop="setOrderBy('user_desc')">Usuario<i class="fas fa-sort-up pl-1"></i></span>
			@elseif ($orderBy === 'user_desc')
				<span class="header-name" wire:click.stop="setOrderBy('user')">Usuario<i class="fas fa-sort-down pl-1"></i></span>
			@else
				<span class="header-name" wire:click.stop="setOrderBy('user')">Usuario</span>
			@endif
		</th>
		<th class="{{ $isShowDateColumn ?: 'd-none' }}" wire:click="checkAll">
			@if ($orderBy === 'date')
				<span class="header-name" wire:click.stop="setOrderBy('date_desc')">Fecha<i class="fas fa-sort-up pl-1"></i></span>
			@elseif ($orderBy === 'date_desc')
				<span class="header-name" wire:click.stop="setOrderBy('date')">Fecha<i class="fas fa-sort-down pl-1"></i></span>
			@else
				<span class="header-name" wire:click.stop="setOrderBy('date')">Fecha</span>
			@endif
		</th>
	</tr>
</thead>
