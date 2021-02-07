<tr class="light:bg-gray-50 dark:bg-gray-700 light:text-gray-600 dark:text-gray-300 text-sm uppercase tracking-tight">
	<th class="hidden sm:block text-left pl-3 dark:border-gray-600 light:bg-gray-50 dark:bg-gray-700" style="left: 0px; position: sticky;">
		<div class="border-r border-gray-200 dark:border-gray-700 py-3">
			@if ($order == 'name')
				<span class="d-inline-block cursor-pointer" wire:click="setOrder('name_desc')">Equipo<i class="fas fa-sort pl-1"></i></span>
			@elseif ($order == 'name_desc')
				<span class="d-inline-block cursor-pointer" wire:click="setOrder('name')">Equipo<i class="fas fa-sort pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="setOrder('name')">Equipo</span>
			@endif
		</div>
	</th>
	<th class="sm:hidden text-left pl-3 dark:border-gray-600 light:bg-gray-50 dark:bg-gray-700" style="left: 0px; position: sticky;">
		<div class="border-r border-gray-200 dark:border-gray-700 py-3">
			@if ($order == 'medium_name')
				<span class="d-inline-block cursor-pointer" wire:click="setOrder('medium_name_desc')">Equipo<i class="fas fa-sort pl-1"></i></span>
			@elseif ($order == 'medium_name_desc')
				<span class="d-inline-block cursor-pointer" wire:click="setOrder('medium_name')">Equipo<i class="fas fa-sort pl-1"></i></span>
			@else
				<span class="d-inline-block cursor-pointer" wire:click="setOrder('medium_name')">Equipo</span>
			@endif
		</div>
	</th>
	<th class="text-center">
		@if ($order == 'w')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('w_desc')">V<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'w_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('w')">V<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('w')">V</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'l')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('l_desc')">D<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'l_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('l')">D<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('l')">D</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'wavg')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('wavg_desc')">VIC%<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'wavg_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('wavg')">VIC%<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('wavg')">VIC%</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'conf')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('conf_desc')">conf<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'conf_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('conf')">conf<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('conf')">conf</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'div')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('div_desc')">div<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'div_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('div')">div<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('div')">div</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'home')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('home_desc')">Casa<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'home_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('home')">Casa<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('home')">Casa</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'road')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('road_desc')">Vis<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'road_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('road')">Vis<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('road')">Vis</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'ot')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('ot_desc')">OT<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'ot_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('ot')">OT<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('ot')">OT</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'last10')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('last10_desc')">Ult 10<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'last10_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('last10')">Ult 10<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('last10')">Ult 10</span>
		@endif
	</th>
	<th class="text-center pr-3">
		@if ($order == 'streak')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('streak_desc')">Racha<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'streak_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('streak')">Racha<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('streak')">Racha</span>
		@endif
	</th>
</tr>