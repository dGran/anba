<div class="filters d-flex align-items-center non-selectable">

	<input type="search" class="search-input form-control mr-2" placeholder='Buscar...' wire:model="search" autofocus>

	<div class="btn-group" role="group">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-white {{ $selectedData->count() === 0 ? 'disabled' : '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-tasks"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-right">
	            <h6 class="dropdown-header">Registros seleccionados</h6>

	            <div class="dropdown-divider"></div>

	            @if ($selectedData->count() === 1)
		            <a class="dropdown-item d-flex align-items-center" wire:click="view({{ $selectedData->first()->id }})">
            			<i class='bx bxs-show mr-2'></i>Ver
		            </a>
	            	<div class="dropdown-divider"></div>
		        @endif

	            <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelected('xls')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xls)</a>
	            <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelected('xlsx')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xlsx)</a>
	            <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelected('csv')"><i class="bx bxs-file-export mr-2"></i>Exportar (.csv)</a>

	            <div class="dropdown-divider"></div>

	            <a class="dropdown-item d-flex align-items-center red" wire:click="confirmDestroy"><i class='bx bxs-trash-alt mr-2'></i>Eliminar</a>

	            <div class="dropdown-divider"></div>

	            <a class="dropdown-item d-flex align-items-center" wire:click="viewSelected(true)"><i class='bx bx-list-check mr-2'></i>Ver selección ({{ $selectedData->count() }})</a>
	            <a class="dropdown-item d-flex align-items-center" wire:click="cancelSelection"><i class="fas fa-ban mr-2"></i>Cancelar selección</a>
			</div>
		</div>

		<div class="btn-group" role="group">
			<button type="button" class="btn btn-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-table"></i>
			</button>
			<div class="dropdown">
				<div class="dropdown-menu dropdown-menu-right">
		            <h6 class="dropdown-header">Opciones de tabla</h6>
		            <div class="dropdown-divider"></div>
		            <a class="dropdown-item d-flex align-items-center {{ $data->count() === 0 ? 'disabled' : '' }}" wire:click="confirmExportTable('xls')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xls)</a>
		            <a class="dropdown-item d-flex align-items-center {{ $data->count() === 0 ? 'disabled' : '' }}" wire:click="confirmExportTable('xlsx')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xlsx)</a>
		            <a class="dropdown-item d-flex align-items-center {{ $data->count() === 0 ? 'disabled' : '' }}" wire:click="confirmExportTable('csv')"><i class="bx bxs-file-export mr-2"></i>Exportar (.csv)</a>
				</div>
			</div>
		</div>

		<button type="button" class="btn btn-white" wire:click="viewFilters(true)">
			<i class="fas fa-filter"></i>
		</button>

		<button type="button" class="btn btn-white {{ $order != "id_desc" || $filters['search'] || $filterType != "all" || $filterUser != "all" || $filterTable != "all" || $perPage != "25" ?: 'disabled' }}" wire:click="clearAllFilters">
			<i class="fas fa-eraser"></i>
		</button>
	</div>

</div> {{-- filters --}}


@if ($filters['search'] || $filters['type'] != "all" || $filters['user'] != "all" || $filters['table'] != "all" || $perPage != "25")
	<ul class="list-inline my-2">
		@if ($filters['search'])
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterSearch">
					{{ $filters['search'] }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($filters['type'] != "all")
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterType">
					{{ $filterType }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($filters['table'] != "all")
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterTable">
					{{ $filterTable }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($filters['user'] != "all")
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterUser">
					{{ $filterUserName }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($perPage !== "25")
			<li class="list-inline-item">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterPerPage">
					{{ $perPage }} / página<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
	</ul>
@endif
