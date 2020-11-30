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
                    <button type="button" class="btn btn-primary mr-3 mb-2 text-uppercase tracking-widest text-xxs py-1 px-2" wire:click="edit({{ $playerView->id }})" style="position: absolute; bottom: 0; right: 0">
                        Editar
                    </button>
                </div>
                <div class="modal-body p-3">
                    <ul class="border rounded list-inline mb-0">

                        <li class="d-flex align-items-center p-2 rounded-top" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">ID</div>
                            <div class="col-7 text-right text-sm">{{ $playerView->id }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Nombre</div>
                            <div class="col-7 text-right text-sm">{{ $playerView->name ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Apodo</div>
                            <div class="col-7 text-right text-sm {{ $playerView->nickname ?: 'text-muted' }}">{{ $playerView->nickname ?: 'N/D' }}</div>
                        </li>
                        @if (!$playerView->retired)
                            <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                                <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Equipo</div>
                                <div class="col-7 text-right text-sm {{ $playerView->team ? '' : 'text-danger' }}">{{ $playerView->team ? $playerView->team->name : 'Free Agent'}}</div>
                            </li>
                        @endif
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Posición</div>
                            <div class="col-7 text-right text-sm {{ $playerView->position ?: 'text-muted' }}">{{ $playerView->position ? $playerView->getPosition() : 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Altura</div>
                            <div class="col-7 text-right text-sm {{ $playerView->height ?: 'text-muted' }}">{{ $playerView->height ? $playerView->getHeight() . ' ft' : 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Peso</div>
                            <div class="col-7 text-right text-sm {{ $playerView->weight ?: 'text-muted' }}">{{ $playerView->weight ? $playerView->weight . ' lbs' : 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Nacionalidad</div>
                            <div class="col-7 text-right text-sm {{ $playerView->nation_name ?: 'text-muted' }}">{{ $playerView->nation_name ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Universidad</div>
                            <div class="col-7 text-right text-sm {{ $playerView->college ?: 'text-muted' }}">{{ $playerView->college ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Edad</div>
                            <div class="col-7 text-right text-sm {{ $playerView->birthdate ?: 'text-muted' }}">{{ $playerView->birthdate ? $playerView->age() . ' años' : 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Año draft</div>
                            <div class="col-7 text-right text-sm {{ $playerView->draft_year ?: 'text-muted' }}">{{ $playerView->draft_year ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2 rounded-bottom" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Estado</div>
                            <div class="col-7 text-right text-sm {{ $playerView->retired ? 'text-danger' : 'text-success' }}">{{ $playerView->retired ? 'Retirado' : 'En activo' }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif