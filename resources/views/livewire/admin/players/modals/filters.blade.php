<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="filtersModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog non-selectable" role="document">
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
                            <option value="pg">Point guard</option>
                            <option value="sg">Shooting guard</option>
                            <option value="sf">Small forward</option>
                            <option value="pf">Power forward</option>
                            <option value="c">Center</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Equipo</label>
                        <select class="form-control custom-select text-sm" wire:model="filterTeam">
                            <option value="all">Todos los equipos</option>
                            <option value="free_agents">Free Agents</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Edad</label>
                        <div wire:ignore x-data x-init="
                            $('#filterAge').ionRangeSlider({
                                type: 'double',
                                grid: true,
                                grid_num: 3,
                                min: 15,
                                max: 45,
                                keyboard: true,
                                onFinish: function(data) {
                                    @this.set('filterAge', { 'from': data.from, 'to': data.to })
                                }
                            });
                        ">
                            <input type="text" id="filterAge" wire:model="filterAge"/>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Año de draft</label>
                        <div wire:ignore x-data x-init="
                            $('#filterYearDraft').ionRangeSlider({
                                type: 'double',
                                grid: true,
                                grid_num: 5,
                                min: 1995,
                                max: 2020,
                                keyboard: true,
                                onFinish: function(data) {
                                    @this.set('filterYearDraft', { 'from': data.from, 'to': data.to })
                                }
                            });
                        ">
                            <input type="text" id="filterYearDraft" wire:model="filterYearDraft"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                    <label class="text-sm text-uppercase tracking-wide">Altura (ft)</label>
                    {{-- <input type="text" class="form-control" placeholder="Altura" wire:model="filterHeight"> --}}
                        <div wire:ignore x-data x-init="
                            $('#filterHeight').ionRangeSlider({
                                type: 'double',
                                grid: true,
                                grid_num: 5,
                                min: 5,
                                max: 8,
                                step: 0.1,
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
                        <label class="text-sm text-uppercase tracking-wide">Peso (lbs)</label>
                        <div wire:ignore x-data x-init="
                            $('#filterWeight').ionRangeSlider({
                                type: 'double',
                                grid: true,
                                grid_num: 5,
                                min: 125,
                                max: 500,
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

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Nacionalidad</label>
                        <select class="form-control custom-select text-sm" wire:model="filterNation">
                            <option value="all">Todas las nacionalidades</option>
                            @foreach ($nations as $nation)
                                <option value="{{ $nation->nation_name }}">{{ $nation->nation_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Universidad</label>
                        <select class="form-control custom-select text-sm" wire:model="filterCollege">
                            <option value="all">Todas las universidades</option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college->college }}">{{ $college->college }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Estado</label>
                        <select class="form-control custom-select text-sm" wire:model="filterRetired">
                            <option value="-1">Todas los estados</option>
                            <option value="0">En activo</option>
                            <option value="1">Retirados</option>
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
                                    <option value="team">Equipo</option>
                                    <option value="team_desc">Equipo (desc)</option>
									<option value="position">Posición</option>
                                    <option value="position_desc">Posición (desc)</option>
                                    <option value="nation_name">Pais</option>
                                    <option value="nation_name_desc">Pais (desc)</option>
                                    <option value="birthdate">Edad</option>
                                    <option value="birthdate_desc">Edad (desc)</option>
                                    <option value="height">Altura</option>
                                    <option value="height_desc">Altura (desc)</option>
                                    <option value="weight">Peso</option>
                                    <option value="weight_desc">Peso (desc)</option>
                                    <option value="draft_year">Año Draft</option>
                                    <option value="draft_year_desc">Año Draft (desc)</option>
                                    <option value="college">Universidad</option>
                                    <option value="college_desc">Universidad (desc)</option>
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