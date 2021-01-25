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
                            <option value="general">General</option>
                            <option value="resultados">Resultados</option>
                            <option value="records">Records</option>
                            <option value="rachas">Rachas</option>
                            <option value="lesiones">Lesiones</option>
                            <option value="movimientos">Movimientos</option>
                            <option value="destacados">Destacados</option>
                            <option value="declaraciones">Declaraciones</option>
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
									<option value="type">Tipo</option>
                                    <option value="type_desc">Tipo (desc)</option>
                                    <option value="category">Categoría</option>
                                    <option value="category_desc">Categoría (desc)</option>
                                    <option value="title">Título</option>
                                    <option value="title_desc">Título (desc)</option>
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