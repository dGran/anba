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
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Posición</label>
                        <select class="form-control custom-select text-sm" wire:model="filterPosition">
                            <option value="all">Todas las posiciones</option>
                            <option value="base">Base</option>
                            <option value="escolta">Escolta</option>
                            <option value="alero">Alero</option>
                            <option value="ala-pivot">Ala-Pivot</option>
                            <option value="pivot">Pivot</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Altura (cm)</label>
                        <div wire:ignore x-data x-init="
                            $('#filterHeight').ionRangeSlider({
                                type: 'double',
                                grid: true,
                                grid_num: 5,
                                min: 150,
                                max: 250,
                                keyboard: true,
                                onFinish: function(data) {
                                    @this.set('filterHeight', { 'from': data.from, 'to': data.to })
                                }
                            });
                        ">
                            <input type="text" id="filterHeight" wire:model="filterHeight"/>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Peso (kg)</label>
                        <div wire:ignore x-data x-init="
                            $('#filterWeight').ionRangeSlider({
                                type: 'double',
                                grid: true,
                                grid_num: 5,
                                min: 50,
                                max: 150,
                                keyboard: true,
                                onFinish: function(data) {
                                    @this.set('filterWeight', { 'from': data.from, 'to': data.to })
                                }
                            });
                        ">
                            <input type="text" id="filterWeight" />
                        </div>
                    </div>
                </div>

                <h5>
                    agregar college, nation_name, edad_range, draft_year_range y average_range
                </h5>
                <p>Posibilidad de elegir mas de una posicion</p>

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