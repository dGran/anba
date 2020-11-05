<thead>
	<tr class="bg-gray-50">
		<th class="px-3 sm:px-6 py-3 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
			<input id="check_all" type="checkbox" class="mousetrap form-checkbox h-4 w-4 sm:h-5 sm:w-5 text-indigo-400"
			wire:model="" value="">
		</th>
		<th class="pl-2 sm:pl-3 pr-3 sm:pr-6 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
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
		<th class="hidden md:table-cell px-3 sm:px-6 py-3 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
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
		<th class="hidden md:table-cell px-3 sm:px-6 py-3 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
			Estado
		</th>
	</tr>
</thead>