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
                        <select class="form-control custom-select text-sm" wire:model="type">
                            <option value="all">Todos los tipos</option>
                            @foreach ($relatedTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-sm text-uppercase tracking-wide">Tabla</label>
                        <select class="form-control custom-select text-sm" wire:model="table">
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
                        <select class="form-control custom-select text-sm" wire:model="user" wire:change="getUserName">
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
                            <select class="form-control custom-select text-sm" wire:model="orderBy">
                            @foreach($tableInfo[\App\Enum\TableInfo::ORDER_BY_CRITERIA_INDEXED_BY_NAME] as $orderBy => $orderByCriteria)
                                <option value="{{ $orderBy }}">{{ $orderByCriteria[\App\Enum\OrderByCriteria::CRITERIA_CAPTION] }}</option>
                            @endforeach
                            </select>
            			</div>
            		</div>
	    			<div class="col-md-6">
            			<div class="form-group">
            				<label class="text-sm text-uppercase tracking-wide">Paginación</label>
                            <select class="form-control custom-select show-tick text-sm" wire:model="perPage" id="selectPerPage">
                                @foreach(\App\Enum\TableFilters::PER_PAGE_DESCRIPTIONS_INDEXED_BY_VALUE as $value => $description)
                                <option value={{ $value }}>{{ $description }}</option>
                                @endforeach
                            </select>
            			</div>
            		</div>
            	</div>
            </div>

            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-danger ml-2 text-xs text-uppercase tracking-widest" wire:click="resetFilters" wire:loading.attr="disabled">Reset</button>
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">cerrar</button>
            </div>
        </div>
    </div>
</div>
