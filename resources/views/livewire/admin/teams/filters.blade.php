<div class="filters d-flex align-items-center">

	<button type="button" class="btn btn-new mr-2" wire:click="add" wire:loading.attr="disabled">
		<i class="bx bxs-add-to-queue"></i>
	</button>

	<input type="search" class="search-input form-control mr-2" placeholder='Buscar...("/")' wire:model="search" autofocus>

	<div class="btn-group" role="group">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-white {{ $regsSelected->count() == 0 ? 'disabled' : '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-tasks"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-right">
	            <h6 class="dropdown-header">Registros seleccionados</h6>
	            <div class="dropdown-divider"></div>
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

		<div class="btn-group" role="group">
			<button type="button" class="btn btn-white {{ $regs->count() == 0 ? 'disabled' : '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-table"></i>
			</button>
			<div class="dropdown">
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
		</div>

		<button type="button" class="btn btn-white" wire:click="viewFilters(true)">
			<i class="fas fa-filter"></i>
		</button>

		<button type="button" class="btn btn-white {{ ($search == '' && $perPage == '10') ? 'disabled' : '' }}" wire:click="clearAllFilters">
			<i class="fas fa-eraser"></i>
		</button>
	</div>

</div> {{-- filters --}}


@if ($search || $perPage !== "10")
	<ul class="list-inline my-2">
		@if ($search)
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterSearch">
					{{ $search }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($perPage !== "10")
			<li class="list-inline-item">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterPerPage">
					{{ $perPage }} / página<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
	</ul>
@endif