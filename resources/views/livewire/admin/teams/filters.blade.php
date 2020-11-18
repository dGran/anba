<div class="filters">

	<button type="button" class="btn btn-new" wire:click="add" wire:loading.attr="disabled">
		Nuevo
	</button>

	<div class="input-group ml-2">
		<input type="search" class="search-input form-control" placeholder='Buscar...("/")' wire:model="search" autofocus>
		<div class="input-group-append">
			<span class="input-group-text"><i class="fas fa-search"></i></span>
		</div>
    </div>

	<div class="ml-2 d-inline-flex" role="group" aria-label="First group">

		<div class="dropdown mr-1">
			<button type="button" class="btn btn-white {{ $regsSelected->count() == 0 ? 'disabled' : '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-tasks"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-right">
	            <h6 class="dropdown-header">Registros seleccionados</h6>
	            <div class="dropdown-divider"></div>
	{{--             @if ($regsSelected->count() != 1)
		            <a class="dropdown-item disabled">
		            	<i class="fas fa-edit mr-2"></i>Editar
		            </a>
	            @endif --}}
	            @if ($regsSelected->count() == 1)
		            <a class="dropdown-item" wire:click="edit({{ $regsSelected->first()->id }})">
		            	<i class="fas fa-edit mr-2"></i>Editar
		            </a>
	            @endif
	            <a class="dropdown-item" wire:click="confirmDuplicate"><i class='bx bxs-copy mr-2'></i>Duplicar</a>
	            <div class="dropdown-divider"></div>
	            <a class="dropdown-item" wire:click="confirmExportSelected('xls')"><i class="bx bxs-file-export mr-2"></i></i>Exportar (.xls)</a>
	            <a class="dropdown-item" wire:click="confirmExportSelected('xlsx')"><i class="bx bxs-file-export mr-2"></i></i>Exportar (.xlsx)</a>
	            <a class="dropdown-item" wire:click="confirmExportSelected('csv')"><i class="bx bxs-file-export mr-2"></i></i>Exportar (.csv)</a>
	            <div class="dropdown-divider"></div>
	            <a class="dropdown-item red" wire:click="confirmDestroy"><i class="fas fa-trash mr-2"></i>Eliminar</a>
	            <div class="dropdown-divider"></div>
	            <a class="dropdown-item" wire:click="viewSelected(true)"><i class="fas fa-check-square mr-2"></i>Ver selección ({{ $regsSelected->count() }})</a>
	            <a class="dropdown-item" wire:click="cancelSelection"><i class="fas fa-ban mr-2"></i>Cancelar selección</a>
			</div>
		</div>


		<div class="dropdown mr-1">
			<button type="button" class="btn btn-white {{ $regs->count() == 0 ? 'disabled' : '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-table"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-right">
	            <h6 class="dropdown-header">Opciones de tabla</h6>
	            <div class="dropdown-divider"></div>
	            <a class="dropdown-item" wire:click="confirmImport"><i class="bx bxs-file-import mr-2"></i>Importar</a>
	            <div class="dropdown-divider"></div>
	            <a class="dropdown-item" wire:click="confirmExportTable('xls')"><i class="bx bxs-file-export mr-2"></i></i></i>Exportar (.xls)</a>
	            <a class="dropdown-item" wire:click="confirmExportTable('xlsx')"><i class="bx bxs-file-export mr-2"></i></i>Exportar (.xlsx)</a>
	            <a class="dropdown-item" wire:click="confirmExportTable('csv')"><i class="bx bxs-file-export mr-2"></i></i>Exportar (.csv)</a>
			</div>
		</div>

		<button type="button" class="btn btn-white mr-1" wire:click="viewFilters(true)">
			<i class="fas fa-filter"></i>
		</button>
		<button type="button" class="btn btn-white {{ ($search == '' && $perPage == '10') ? 'disabled' : '' }}" wire:click="clearAllFilters">
			<i class="fas fa-eraser"></i>
		</button>
	</div>
</div>


{{-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse ipsum ea vel hic dolorem! Id, modi ex alias dicta maxime perspiciatis numquam, libero hic, nemo explicabo ullam molestias tenetur, et. --}}
@if ($search || $perPage !== "10")
	<ul class="list-inline" style="margin: -.5em 0 .5em 0;">
		@if ($search)
			<li class="list-inline-item">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterSearch()">
					{{ $search }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($perPage !== "10")
			<li class="list-inline-item">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterPerPage()">
					{{ $perPage }} / página<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
	</ul>
@endif

	{{-- <div class="flex items-center">
		<button class="btn btn-primary"
		wire:click="add" wire:loading.attr="disabled" type="button">
		    Nuevo
		</button>

		<div class="relative w-full flex items-center">
			<input type="text" class=" form-control ml-2"
				wire:model="search"
				type="text"
				placeholder='Buscar...("/")'
				autofocus>
				<i class="fas fa-search absolute right-0 mr-2 text-gray-500"></i>
		</div>

		<div class="inline-flex ml-2"> --}}

	{{-- 		@if ($regsSelected->count() > 0)
				<x-dropdown>
					<x-slot name="trigger">
						<button class="bg-white border border-r-0 border-gray-200 px-3 h-8 sm:h-10 text-sm sm:text-base rounded-l transition ease-in-out duration-150 focus:outline-none text-gray-500 cursor-pointer hover:text-indigo-500 focus:text-indigo-500 rounded-l"
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
				<button class="bg-white border border-r-0 rounded-l border-gray-200 px-3 h-8 sm:h-10 text-sm sm:text-base transition ease-in-out duration-150 focus:outline-none text-gray-300 cursor-not-allowed" disabled
				wire:loading.attr="disabled">
					<i class="fas fa-tasks"></i>
				</button>
			@endif --}}
{{--
			@if ($regs->count() > 0)
				<x-dropdown>
					<x-slot name="trigger">
						<button class="bg-white border border-r-0 border-gray-200 px-3 h-8 sm:h-10 text-sm sm:text-base transition ease-in-out duration-150 focus:outline-none text-gray-500 cursor-pointer hover:text-indigo-500 focus:text-indigo-500"
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

			            	<p class="float-right">{{ $regs->total() }} registros</p>
			            </div>
			        </x-slot>
				</x-dropdown>
			@else
				<button class="bg-white border border-r-0 border-gray-200 px-3 h-8 sm:h-10 text-sm sm:text-base transition ease-in-out duration-150 focus:outline-none text-gray-300 cursor-not-allowed" disabled
				wire:loading.attr="disabled">
					<i class="fas fa-table"></i>
				</button>
			@endif

			<button type="button" class="bg-white border border-r-0 border-gray-200 px-3 h-8 sm:h-10 text-sm sm:text-base transition ease-in-out duration-150 text-gray-500 cursor-pointer hover:text-indigo-500 focus:text-indigo-500 focus:outline-none"
			wire:click="viewFilters(true)"
			wire:loading.attr="disabled">
				<i class="fas fa-filter"></i>
			</button>

			<button type="button" class="bg-white border border-gray-200 px-3 h-8 sm:h-10 text-sm sm:text-base rounded-r transition ease-in-out duration-150 focus:outline-none {{ ($search == '' && $perPage == '10' && $state == 'all') ? 'text-gray-300 cursor-not-allowed' : 'text-gray-500 cursor-pointer hover:text-indigo-500 focus:text-indigo-500' }}"
			wire:loading.attr="disabled"
			wire:click="clearAllFilters"
			{{ ($search == '' && $perPage == '10' && $state == 'all') ? 'disabled' : '' }}>
				<i class="fas fa-eraser"></i>
			</button>
		</div>
	</div>


</div> --}}