<tr class="bg-gray-50 text-sm uppercase text-gray-600 tracking-tight">
	<th class="text-left pl-2 py-3 border-r border-gray-200">Equipo</th>
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
	<th class="text-center">ot</th>
	<th class="text-center">
		@if ($order == 'last10')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('last10_desc')">Ult 10<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'last10_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('last10')">Ult 10<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('last10')">Ult 10</span>
		@endif
	</th>
	<th class="text-center">
		@if ($order == 'streak')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('streak_desc')">Racha<i class="fas fa-sort pl-1"></i></span>
		@elseif ($order == 'streak_desc')
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('streak')">Racha<i class="fas fa-sort pl-1"></i></span>
		@else
			<span class="d-inline-block cursor-pointer" wire:click="setOrder('streak')">Racha</span>
		@endif
	</th>
</tr>