<div class="filters d-flex align-items-center non-selectable">
    <input type="search" class="search-input form-control mr-2" placeholder='Buscar...' wire:model="search" autofocus>

    <div class="btn-group" role="group">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-white {{ $selectedData->count() === 0 ? 'disabled' : '' }}"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tasks"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <h6 class="dropdown-header">Registros seleccionados</h6>

                <div class="dropdown-divider"></div>

                @if ($selectedData->count() === 1)
                    <a class="dropdown-item d-flex align-items-center"
                       wire:click="view({{ $selectedData->first()->id }})">
                        <i class='bx bxs-show mr-2'></i>Ver
                    </a>
                    <div class="dropdown-divider"></div>
                @endif

                <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelectedToFile('xls')"><i
                        class="bx bxs-file-export mr-2"></i>Exportar (.xls)</a>
                <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelectedToFile('xlsx')"><i
                        class="bx bxs-file-export mr-2"></i>Exportar (.xlsx)</a>
                <a class="dropdown-item d-flex align-items-center" wire:click="confirmExportSelectedToFile('csv')"><i
                        class="bx bxs-file-export mr-2"></i>Exportar (.csv)</a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item d-flex align-items-center red" wire:click="confirmDestroy"><i
                        class='bx bxs-trash-alt mr-2'></i>Eliminar</a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item d-flex align-items-center" wire:click="viewSelected">
                    <i class='bx bx-list-check mr-2'></i>Ver selección ({{ $selectedData->count() }})
                </a>
                <a class="dropdown-item d-flex align-items-center" wire:click="cancelSelection">
                    <i class="fas fa-ban mr-2"></i>Cancelar selección
                </a>
            </div>
        </div>

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-table"></i></button>
            <div class="dropdown">
                <div class="dropdown-menu dropdown-menu-right">
                    <h6 class="dropdown-header">Opciones de tabla</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item d-flex align-items-center {{ $data->count() === 0 ? 'disabled' : '' }}"
                       wire:click="confirmExportToFile('xls')"><i class="bx bxs-file-export mr-2"></i>Exportar (.xls)</a>
                    <a class="dropdown-item d-flex align-items-center {{ $data->count() === 0 ? 'disabled' : '' }}"
                       wire:click="confirmExportToFile('xlsx')"><i class="bx bxs-file-export mr-2"></i>Exportar
                        (.xlsx)</a>
                    <a class="dropdown-item d-flex align-items-center {{ $data->count() === 0 ? 'disabled' : '' }}"
                       wire:click="confirmExportToFile('csv')"><i class="bx bxs-file-export mr-2"></i>Exportar (.csv)</a>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-white" wire:click="viewFilters"><i class="fas fa-filter"></i></button>
        <button type="button" class="btn btn-white {{ $this->filtersApplied ? '' : 'disabled' }}"  wire:click="resetFilters"><i class="fas fa-eraser"></i></button>
    </div>
</div>

@php use App\Enum\TableFilters; @endphp

@if ($this->filtersApplied)
    <ul class="list-inline my-2">
        @if ($search !== TableFilters::VALUE_NULL_STRING)
            <li class="list-inline-item mr-1">
                <a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilter('{{ TableFilters::NAME_SEARCH }}')">
                    {{ $search }}<i class="fas fa-times ml-2"></i>
                    <a>
            </li>
        @endif
        @if ($type !== TableFilters::VALUE_ALL)
            <li class="list-inline-item mr-1">
                <a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilter('{{ TableFilters::NAME_TYPE }}')">
                    {{ $type }}<i class="fas fa-times ml-2"></i>
                    <a>
            </li>
        @endif
        @if ($table !== TableFilters::VALUE_ALL)
            <li class="list-inline-item mr-1">
                <a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilter('{{ TableFilters::NAME_TABLE }}')">
                    {{ $table }}<i class="fas fa-times ml-2"></i>
                    <a>
            </li>
        @endif
        @if ($user !== TableFilters::VALUE_ALL)
            <li class="list-inline-item mr-1">
                <a class="btn btn-white text-xxs text-uppercase" wire:click="cancelFilter('{{ TableFilters::NAME_USER }}')">
                    {{ $userName }}<i class="fas fa-times ml-2"></i>
                    <a>
            </li>
        @endif
        @if ($perPage !== TableFilters::PER_PAGE_DEFAULT_VALUE)
            <li class="list-inline-item">
                <a class="btn btn-white text-xxs text-uppercase"
                   wire:click="cancelFilter('{{ TableFilters::NAME_PER_PAGE }}')">
                    {{ $perPage }} / página<i class="fas fa-times ml-2"></i>
                    <a>
            </li>
        @endif
    </ul>
@endif
