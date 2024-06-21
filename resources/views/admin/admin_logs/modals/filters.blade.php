<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="filtersModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable non-selectable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>Filtros</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Tipo</label>
                        <select class="form-control custom-select text-sm" wire:model="filterType">
                            <option value="all">Todos los tipos</option>
                            @foreach ($relatedTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Tabla</label>
                        <select class="form-control custom-select text-sm" wire:model="filterTable">
                            <option value="all">Todas las tablas</option>
                            @foreach ($relatedTables as $table)
                                <option value="{{ $table }}">{{ $table }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Usuario</label>
                        <select class="form-control custom-select text-sm" wire:model="filterUser">
                            <option value="all">Todos los usuarios</option>
                            @foreach ($relatedUsers as $userId => $userName)
                                <option value="{{ $userId }}">{{ $userName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            	<div class="row">
            		<div class="col-md-6">
            			<div class="form-group">
            				<label class="text-sm text-uppercase tracking-wide">Orden</label>
							{{-- <div wire:ignore> --}}
								<select class="form-control custom-select text-sm" wire:model="order">
									<option value="id">ID</option>
                                    <option value="id_desc">ID (desc)</option>
									<option value="name">Nombre</option>
                                    <option value="name_desc">Nombre (desc)</option>
                                    <option value="type">Tipo</option>
                                    <option value="type_desc">Tipo (desc)</option>
                                    <option value="table">Tabla</option>
                                    <option value="table_desc">Tabla (desc)</option>
                                    <option value="user">Usuario</option>
                                    <option value="user_desc">Usuario (desc)</option>
                                    <option value="date">Fecha</option>
                                    <option value="date_desc">Fecha (desc)</option>
								</select>
							{{-- </div> --}}
            			</div>
            			<!-- /.form-group -->
            		</div>
            		<!-- /.col -->
	    			<div class="col-md-6">
            			<div class="form-group">
            				<label class="text-sm text-uppercase tracking-wide">Paginación</label>
							{{-- <div wire:ignore> --}}
								<select class="form-control custom-select show-tick text-sm" wire:model="perPage" id="selectPerPage">
									<option value="5">5 por página</option>
									<option value="10">10 por página</option>
									<option value="15">15 por página</option>
									<option value="25">25 por página</option>
									<option value="50">50 por página</option>
									<option value="100">100 por página</option>
								</select>
							{{-- </div> --}}
            			</div>
            			<!-- /.form-group -->
            		</div>
            		<!-- /.col -->
            	</div>
            </div>

            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-danger ml-2 text-xs text-uppercase tracking-widest" wire:click="clearAllFilters" wire:loading.attr="disabled">
                    Reset
                </button>
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">
                    cerrar
                </button>
            </div>
        </div>
    </div>
</div>
