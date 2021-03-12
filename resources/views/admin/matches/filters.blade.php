<div class="filters d-flex align-items-center non-selectable">

	<button type="button" class="btn btn-new d-md-flex align-items-center mr-2" wire:click="add" wire:loading.attr="disabled">
		<i class="bx bxs-add-to-queue"></i><span class="ml-2 d-none d-md-inline-flex">{{ $modelGender == 'male' ? 'Nuevo' : 'Nueva' }}</span>
	</button>

	<input type="search" class="search-input form-control mr-2" placeholder='Buscar...' wire:model="search" autofocus>

	<div class="btn-group" role="group">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-white {{ $regsSelected->count() == 0 ? 'disabled' : '' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-tasks"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-right">
	            <h6 class="dropdown-header">Registros seleccionados</h6>

	            <div class="dropdown-divider"></div>

	            @if ($regsSelected->count() == 1)
		            <a class="dropdown-item d-flex align-items-center" wire:click="edit({{ $regsSelected->first()->id }})">
		            	<i class='bx bxs-edit-alt mr-2'></i>Editar
		            </a>
	            @endif
	            @if ($regsSelected->count() == 1)
		            <a class="dropdown-item d-flex align-items-center" wire:click="view({{ $regsSelected->first()->id }})">
            			<i class='bx bxs-show mr-2'></i>Ver
		            </a>
		        @endif
		        <a class="dropdown-item d-flex align-items-center" wire:click="confirmDuplicate"><i class='bx bxs-copy mr-2'></i>Duplicar</a>


	            <div class="dropdown-divider"></div>

	            <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelected('xls')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xls)</a>
	            <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelected('xlsx')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xlsx)</a>
	            <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelected('csv')"><i class="bx bxs-file-export mr-2"></i>Exportar (.csv)</a>

	            <div class="dropdown-divider"></div>

				<a class="dropdown-item d-flex align-items-center red" wire:click="confirmResetScore"><i class='bx bx-reset mr-2'></i>Resetear {{ $regsSelected->count() == 1 ? 'resultado' : 'resultados' }}</a>

				<a class="dropdown-item d-flex align-items-center red" wire:click="confirmResetMatch"><i class='bx bx-reset mr-2'></i>Resetear {{ $regsSelected->count() == 1 ? 'partido' : 'partidos' }}</a>

	            <a class="dropdown-item d-flex align-items-center red" wire:click="confirmDestroy"><i class='bx bxs-trash-alt mr-2'></i>Eliminar</a>

	            <div class="dropdown-divider"></div>

	            <a class="dropdown-item d-flex align-items-center" wire:click="viewSelected(true)"><i class='bx bx-list-check mr-2'></i>Ver selección ({{ $regsSelected->count() }})</a>
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
		            @if ($regs->count() > 0)
		            	<a class="dropdown-item d-flex align-items-center" wire:click="confirmCheckMatches"><i class="bx bxs-file-import mr-2"></i>Chequear partidos</a>
		            	<div class="dropdown-divider"></div>
		            	<a class="dropdown-item d-flex align-items-center" wire:click="confirmImportScores"><i class="bx bxs-file-import mr-2"></i>Importar resultados</a>
		            	<a class="dropdown-item d-flex align-items-center" wire:click="confirmImportTeamStats"><i class="bx bxs-file-import mr-2"></i>Importar stats de equipo</a>
		            	<a class="dropdown-item d-flex align-items-center" wire:click="confirmImportPlayerStats"><i class="bx bxs-file-import mr-2"></i>Importar stats de jugadores</a>
		            	<div class="dropdown-divider"></div>
		            @endif
		            <a class="dropdown-item d-flex align-items-center" wire:click="confirmImport"><i class="bx bxs-file-import mr-2"></i>Importar</a>
		            <div class="dropdown-divider"></div>
		            <a class="dropdown-item d-flex align-items-center {{ $regs->count() == 0 ? 'disabled' : '' }}" wire:click="confirmExportTable('xls')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xls)</a>
		            <a class="dropdown-item d-flex align-items-center {{ $regs->count() == 0 ? 'disabled' : '' }}" wire:click="confirmExportTable('xlsx')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xlsx)</a>
		            <a class="dropdown-item d-flex align-items-center {{ $regs->count() == 0 ? 'disabled' : '' }}" wire:click="confirmExportTable('csv')"><i class="bx bxs-file-export mr-2"></i>Exportar (.csv)</a>
				</div>
			</div>
		</div>

		<button type="button" class="btn btn-white" wire:click="viewFilters(true)">
			<i class="fas fa-filter"></i>
		</button>

		<button type="button" class="btn btn-white {{ $order != "id_desc" || $search || $filterTeam != "all" || $filterUser != "all" || $filterPlayed != "all" || $filterReport != "all" || $perPage != "25" ?: 'disabled' }}" wire:click="clearAllFilters">
			<i class="fas fa-eraser"></i>
		</button>
	</div>

</div> {{-- filters --}}


@if ($search || $filterTeam != "all" || $filterUser != "all" || $filterPlayed != "all" || $filterReport != "all" || $perPage != "25")
	<ul class="list-inline my-2">
		@if ($search)
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterSearch">
					{{ $search }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($filterTeam != "all")
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterTeam">
					{{ $filterTeamName }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($filterUser != "all")
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterUser">
					{{ $filterUserName }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($filterPlayed != "all")
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterPlayed">
					{{ $filterPlayed }}<i class="fas fa-times ml-2"></i>
				<a>
			</li>
		@endif
		@if ($filterReport != "all")
			<li class="list-inline-item mr-1">
				<a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilterReport">
					Reporte Stats: {{ $filterReport }}<i class="fas fa-times ml-2"></i>
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