<thead>
	<tr class="bg-gray-50">
		<th colspan="2" class="px-3 sm:px-6 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
			@if ($order == 'name' && $orderDirection == 'asc')
				<p class="inline-block hover:underline focus:underline cursor-pointer" wire:click="order('name', 'desc')">
					Nombre
				</p>
				<i class="fas fa-sort-alpha-up pl-1"></i>
			@elseif ($order == 'name' && $orderDirection == 'desc')
				<p class="inline-block hover:underline focus:underline cursor-pointer" wire:click="order('name', 'asc')">
					Nombre
				</p>
				<i class="fas fa-sort-alpha-down pl-1"></i>
			@else
				<p class="inline-block hover:underline focus:underline cursor-pointer" wire:click="order('name', 'asc')">
					Nombre
				</p>
			@endif
		</th>
		<th class="hidden md:table-cell px-3 sm:px-6 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
			@if ($order == 'created_at' && $orderDirection == 'asc')
				<p class="inline-block hover:underline focus:underline cursor-pointer" wire:click="order('created_at', 'desc')">
					Fecha registro
				</p>
				<i class="fas fa-sort-numeric-up pl-1"></i>
			@elseif ($order == 'created_at' && $orderDirection == 'desc')
				<p class="inline-block hover:underline focus:underline cursor-pointer" wire:click="order('created_at', 'asc')">
					Fecha registro
				</p>
				<i class="fas fa-sort-numeric-down pl-1"></i>
			@else
				<p class="inline-block hover:underline focus:underline cursor-pointer" wire:click="order('created_at', 'asc')">
					Fecha registro
				</p>
			@endif
		</th>
		<th class="hidden md:table-cell px-3 sm:px-6 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
			Estado
		</th>
	</tr>
</thead>