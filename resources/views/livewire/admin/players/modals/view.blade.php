@if ($playerView)
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="viewModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="background: #F9FAFB; position: relative; overflow: hidden;">
                    @if (!$playerView->retired)
                        <div style="position: absolute; width: 100%; opacity: 0.04; transform: translateY(-30%);">
                            <img src="{{ $playerView->getTeamImg() }}" style="width: 55%; margin-left: 35%">
                        </div>
                    @endif
                    <span class="border rounded-circle text-uppercase text-xs font-weight-bold text-center shadow-sm" style="width: 26px; height: 26px; background: #fff; line-height: 2em; position: absolute; top: 15px; left: 10px">
                        {{ $playerView->position ?: '?' }}
                    </span>
                    <img class="object-cover ml-3" src="{{ $playerView->getImg() }}" alt="{{ $playerView->name }}" style="width: auto; height: 75px">
                    <h5 class="modal-title text-base text-uppercase font-medium tracking-wide py-3 ml-3">
                        <span>{{ $playerView->getName() }}</span>
                        @if ($playerView->nickname)
                            <span class="d-block text-xs text-muted">"{{ $playerView->nickname }}"</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0 text-sm">
                    <div class="d-flex align-items-start px-2 px-md-3 py-2 mt-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">ID</div>
                        <div class="col-7 text-right">{{ $playerView->id }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Nombre</div>
                        <div class="col-7 text-right">{{ $playerView->name ?: 'N/D' }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Apodo</div>
                        <div class="col-7 text-right">{{ $playerView->nickname ?: 'N/D' }}</div>
                    </div>
                    @if (!$playerView->retired)
                        <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Equipo</div>
                            <div class="col-7 text-right {{ $playerView->team ? '' : 'text-danger' }}">{{ $playerView->team ? $playerView->team->name : 'Free Agent'}}</div>
                        </div>
                    @endif
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Posición</div>
                        <div class="col-7 text-right">{{ $playerView->position ? $playerView->getPosition() : 'N/D' }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Altura</div>
                        <div class="col-7 text-right">{{ $playerView->height ? $playerView->getHeight() . ' ft' : 'N/D' }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Peso</div>
                        <div class="col-7 text-right">{{ $playerView->weight ? $playerView->weight . ' lbs' : 'N/D' }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Nacionalidad</div>
                        <div class="col-7 text-right">{{ $playerView->nation_name ?: 'N/D' }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Universidad</div>
                        <div class="col-7 text-right">{{ $playerView->college ?: 'N/D' }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Edad</div>
                        <div class="col-7 text-right">{{ $playerView->birthdate ? $playerView->age() . ' años' : 'N/D' }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2" style="border-bottom: 1px solid #e9ecef">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Año draft</div>
                        <div class="col-7 text-right">{{ $playerView->draft_year ?: 'N/D' }}</div>
                    </div>
                    <div class="d-flex align-items-start px-2 px-md-3 py-2 mb-3">
                        <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold">Estado</div>
                        <div class="col-7 text-right {{ $playerView->retired ? 'text-danger' : 'text-success' }}">{{ $playerView->retired ? 'Retirado' : 'En activo' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif