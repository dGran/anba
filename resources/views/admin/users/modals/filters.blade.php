{{-- <style>
    select {
        background-image:
        linear-gradient(45deg, transparent 50%, #B8BEC5 60%),
        linear-gradient(135deg, #B8BEC5 40%, transparent 50%) !important;
        background-position: calc(100% - 10px) 14px, calc(100% - 20px) 14px, 100% 0;
        background-size: 5px 5px, 5px 5px;
        background-repeat: no-repeat;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
</style> --}}


<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="filterModal">
    <div class="modal-dialog modal-dialog-scrollable non-selectable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>Filtros</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-sm text-uppercase tracking-wide">Estado</label>
                            {{-- <div wire:ignore> --}}
                                <select class="form-control custom-select text-sm" wire:model="state">
                                    <option value="all">Todos</option>
                                    <option value="active">Activos</option>
                                    <option value="inactive">Inactivos</option>
                                </select>
                            {{-- </div> --}}
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>

            	<div class="row">
            		<div class="col-md-6">
            			<div class="form-group">
            				<label class="text-sm text-uppercase tracking-wide">Orden</label>
							{{-- <div wire:ignore> --}}
								<select class="form-control custom-select text-sm" wire:model="order">
									<option value="id">ID</option>
									<option value="name">Nombre</option>
									<option value="created_at">Fecha registro</option>
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
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled">
                    cerrar
                </button>
            </div>
        </div>
    </div>
</div>