<div class="pt-2 pb-3 {{-- overflow-x-auto --}}">
	<div class="flex items-center">
		<button class="inline-flex items-center justify-center px-4 h-8 sm:h-9 bg-green-500 rounded font-semibold text-xxs sm:text-xs leading-3 sm:leading-4 text-white uppercase tracking-widest hover:bg-green-600 focus:outline-none focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150"
		wire:click="add" wire:loading.attr="disabled" type="button">
		    Nuevo
		</button>

		<input
			class="search-input ml-2 outline-none border rounded px-3 sm:px-3 h-8 sm:h-9 text-xs sm:text-sm rounded border-gray-200 block w-full focus:border-gray-300 hover:border-gray-300 text-gray-500"
			wire:model="search"
			type="text"
			placeholder='Buscar...("/")'
			autofocus>

		<div class="inline-flex ml-2">

			@if ($regsSelected->count() > 0)
				<x-dropdown>
					<x-slot name="trigger">
						<button class="bg-white border border-r-0 border-gray-200 px-3 h-8 sm:h-9 text-xs sm:text-sm rounded-l transition ease-in-out duration-150 focus:outline-none text-gray-500 cursor-pointer hover:text-indigo-500 focus:text-indigo-500 rounded-l"
						wire:loading.attr="disabled">
							<i class="fas fa-tasks"></i>
						</button>
					</x-slot>
			        <x-slot name="content">
			            <a wire:click="viewSelected(true)" class="text-xxs sm:text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wide px-3 pt-1 pb-2 block hover:text-indigo-500 cursor-pointer border-b border-gray-100">
			            	Registros seleccionados
			            </a>
			            @if ($regsSelected->count() == 1)
				            <a wire:click="edit({{ $regsSelected->first()->id }})" class="text-xs sm:text-sm text-gray-500 px-3 py-2 block cursor-pointer border-b border-gray-100 hover:bg-gray-50 focus:bg-gray-50">
				            	<i class="fas fa-edit w-5 sm:w-6"></i>Editar
				            </a>
				        @else
				            <a class="text-xs sm:text-sm text-gray-300 px-3 py-2 block cursor-pointer border-b border-gray-100 hover:bg-gray-50 focus:bg-gray-50 cursor-not-allowed">
				            	<i class="fas fa-edit w-5 sm:w-6"></i>Editar
				            </a>
				        @endif
			            <a wire:click="confirmDestroy" class="text-xs sm:text-sm text-red-500 px-3 py-2 block cursor-pointer border-b border-gray-100 hover:bg-red-50 focus:bg-gray-50">
			            	<i class="fas fa-trash w-5 sm:w-6"></i>Eliminar
			            </a>
			            <a wire:click="cancelSelection" class="text-xxs sm:text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wide px-3 pt-2 pb-1 hover:text-indigo-500 cursor-pointer">
			            	Cancelar selección
			            </a>
			        </x-slot>
				</x-dropdown>
			@else
				<button class="bg-white border border-r-0 rounded-l border-gray-200 px-3 h-8 sm:h-9 text-xs sm:text-sm transition ease-in-out duration-150 focus:outline-none text-gray-300 cursor-not-allowed" disabled
				wire:loading.attr="disabled">
					<i class="fas fa-tasks"></i>
				</button>
			@endif

			@if ($regs->count() > 0)
				<x-dropdown>
					<x-slot name="trigger">
						<button class="bg-white border border-r-0 border-gray-200 px-3 h-8 sm:h-9 text-xs sm:text-sm transition ease-in-out duration-150 focus:outline-none text-gray-500 cursor-pointer hover:text-indigo-500 focus:text-indigo-500"
						wire:loading.attr="disabled">
							<i class="fas fa-table"></i>
						</button>
					</x-slot>
			        <x-slot name="content">
			            <p class="text-xxs sm:text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wide px-3 pt-1 pb-2 block border-b border-gray-100 text-center">
			            	Opciones de tabla
			            </p>
			            <a wire:click="" class="text-xs sm:text-sm text-gray-500 px-3 py-2 block cursor-pointer border-b border-gray-100 hover:bg-gray-50 focus:bg-gray-50">
			            	<i class="fas fa-edit w-5 sm:w-6"></i>Importar
			            </a>
			            <a wire:click="" class="text-xs sm:text-sm text-gray-500 px-3 py-2 block cursor-pointer border-b border-gray-100 hover:bg-gray-50 focus:bg-gray-50">
			            	<i class="fas fa-edit w-5 sm:w-6"></i>Exportar ('csv')
			            </a>
			            <a wire:click="" class="text-xs sm:text-sm text-gray-500 px-3 py-2 block cursor-pointer border-b border-gray-100 hover:bg-gray-50 focus:bg-gray-50">
			            	<i class="fas fa-edit w-5 sm:w-6"></i>Exportar ('xls')
			            </a>
			            <a wire:click="" class="text-xs sm:text-sm text-gray-500 px-3 py-2 block cursor-pointer border-b border-gray-100 hover:bg-gray-50 focus:bg-gray-50">
			            	<i class="fas fa-edit w-5 sm:w-6"></i>Exportar ('xlsx')
			            </a>
			            <div class="text-xxs sm:text-xs leading-4 font-semibold text-gray-500 tracking-wide px-3 pt-2 pb-1 clearfix">
			            	{{-- <p class="float-left">Total registros<p> --}}
			            	<p class="float-right">{{ $regs->total() }} registros</p>
			            </div>
			        </x-slot>
				</x-dropdown>
			@else
				<button class="bg-white border border-r-0 border-gray-200 px-3 h-8 sm:h-9 text-xs sm:text-sm transition ease-in-out duration-150 focus:outline-none text-gray-300 cursor-not-allowed" disabled
				wire:loading.attr="disabled">
					<i class="fas fa-table"></i>
				</button>
			@endif

			<button type="button" class="bg-white border border-r-0 border-gray-200 px-3 h-8 sm:h-9 text-xs sm:text-sm transition ease-in-out duration-150 text-gray-500 cursor-pointer hover:text-indigo-500 focus:text-indigo-500 focus:outline-none"
			wire:click="viewFilters(true)"
			wire:loading.attr="disabled">
				<i class="fas fa-filter"></i>
			</button>

			<button type="button" class="bg-white border border-gray-200 px-3 h-8 sm:h-9 text-xs sm:text-sm rounded-r transition ease-in-out duration-150 focus:outline-none {{ ($search == '' && $perPage == '10' && $state == 'all') ? 'text-gray-300 cursor-not-allowed' : 'text-gray-500 cursor-pointer hover:text-indigo-500 focus:text-indigo-500' }}"
			wire:loading.attr="disabled"
			wire:click="clearAllFilters"
			{{ ($search == '' && $perPage == '10' && $state == 'all') ? 'disabled' : '' }}>
				<i class="fas fa-eraser"></i>
			</button>
		</div>
	</div>

	@if ($search || $perPage !== "10" || $state !== 'all')
		<div class="flex items-center py-2 px-4 sm:px-0 gap-2">
			@if ($search)
				<div class="text-xxs inline-flex items-center font-bold leading-3 sm:leading-4 uppercase px-2 sm:px-3 py-1 bg-indigo-100 border border-indigo-200 text-indigo-500 rounded cursor-pointer"
				wire:click="cancelFilterSearch()">
					{{ $search }}
					<i class="fas fa-times ml-2 text-xs"></i>
				</div>
			@endif
			@if ($state !== 'all')
				<div class="text-xxs inline-flex items-center font-bold leading-3 sm:leading-4 uppercase px-2 sm:px-3 py-1 bg-indigo-100 border border-indigo-200 text-indigo-500 rounded cursor-pointer"
				wire:click="cancelFilterState()">
					{{ $state_es }}
					<i class="fas fa-times ml-2 text-xs"></i>
				</div>
			@endif
			@if ($perPage !== "10")
				<div class="text-xxs inline-flex items-center font-bold leading-3 sm:leading-4 uppercase px-2 sm:px-3 py-1 bg-indigo-100 border border-indigo-200 text-indigo-500 rounded cursor-pointer"
				wire:click="cancelFilterPerPage()">
					{{ $perPage }} / página
					<i class="fas fa-times ml-2 text-xs"></i>
				</div>
			@endif
		</div>
	@endif
</div>