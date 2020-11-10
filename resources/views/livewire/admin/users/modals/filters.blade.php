<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="filterModal">
    <div class="modal-dialog" role="document">
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
            				<label>Estado</label>
            				<select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" wire:model="state" wire:change="getStateEs">
								<option value="all">Todos</option>
								<option value="active">Activos</option>
								<option value="inactive">Inactivos</option>
            				</select>
            			</div>
            			<!-- /.form-group -->
            		</div>
            		<!-- /.col -->
	    			<div class="col-md-6">
            			<div class="form-group">
            				<label>Paginación</label>
            				<select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" wire:model="perPage">
								<option value="5">5 por página</option>
								<option value="10">10 por página</option>
								<option value="15">15 por página</option>
								<option value="25">25 por página</option>
								<option value="50">50 por página</option>
								<option value="100">100 por página</option>
								<option value="1000">1000 por página</option>
            				</select>
            			</div>
            			<!-- /.form-group -->
            		</div>
            		<!-- /.col -->
            	</div>
            </div>

            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="clearAllFilters" wire:loading.attr="disabled">
                    Cancelar todos los filtros
                </button>
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>