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
		<th class="{{ $colState ?: 'd-none' }}">
			@if ($order == 'injury_name')
				<span class="d-inline-block cursor-pointer" wire:click="order('injury_name_desc')">Estado<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'injury_name_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('injury_name')">Estado<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('injury_name')">Estado</span>
			@endif
		</th>
		<th class="{{ $colTeam ?: 'd-none' }}">
			@if ($order == 'team')
				<span class="d-inline-block cursor-pointer" wire:click="order('team_desc')">Equipo<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'team_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('team')">Equipo<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('team')">Equipo</span>
			@endif
		</th>
		<th class="{{ $colPosition ?: 'd-none' }}">
			@if ($order == 'position')
				<span class="d-inline-block cursor-pointer" wire:click="order('position_desc')">Posición<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'position_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('position')">Posición<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('position')">Posición</span>
			@endif
		</th>
		<th class="{{ $colNation ?: 'd-none' }}">
			@if ($order == 'nation_name')
				<span class="d-inline-block cursor-pointer" wire:click="order('nation_name_desc')">Pais<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'nation_name_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('nation_name')">Pais<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('nation_name')">Pais</span>
			@endif
		</th>
		<th class="text-center {{ $colAge ?: 'd-none' }}">
			@if ($order == 'birthdate')
				<span class="d-inline-block cursor-pointer" wire:click="order('birthdate_desc')">Edad<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'birthdate_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('birthdate')">Edad<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('birthdate')">Edad</span>
			@endif
		</th>
		<th class="text-center {{ $colHeight ?: 'd-none' }}">
			@if ($order == 'height')
				<span class="d-inline-block cursor-pointer" wire:click="order('height_desc')">Altura<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'height_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('height')">Altura<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('height')">Altura</span>
			@endif
		</th>
		<th class="text-center {{ $colWeight ?: 'd-none' }}">
			@if ($order == 'weight')
				<span class="d-inline-block cursor-pointer" wire:click="order('weight_desc')">Peso<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'weight_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('weight')">Peso<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('weight')">Peso</span>
			@endif
		</th>
		<th class="text-center {{ $colDraftYear ?: 'd-none' }}">
			@if ($order == 'draft_year')
				<span class="d-inline-block cursor-pointer" wire:click="order('draft_year_desc')">Año Draft<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'draft_year_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('draft_year')">Año Draft<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('draft_year')">Año Draft</span>
			@endif
		</th>
		<th class="{{ $colCollege ?: 'd-none' }}">
			@if ($order == 'college')
				<span class="d-inline-block cursor-pointer" wire:click="order('college_desc')">Universidad<i class="fas fa-sort-alpha-up pl-1"></i></span>
			@elseif ($order == 'college_desc')
				<span class="d-inline-block cursor-pointer" wire:click="order('college')">Universidad<i class="fas fa-sort-alpha-down pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="order('college')">Universidad</span>
			@endif
		</th>
	</tr>
</thead>