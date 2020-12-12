@if ($regView)
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="viewModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="background: #F9FAFB; position: relative; overflow: hidden;">
                    @if (!$regView->retired)
                        <div style="position: absolute; width: 100%; opacity: 0.04; transform: translateY(-30%);">
                            <img src="{{ $regView->getTeamImg() }}" style="width: 55%; margin-left: 35%">
                        </div>
                    @endif
                    <span class="border rounded-circle text-uppercase text-xs font-weight-bold text-center shadow-sm" style="width: 26px; height: 26px; background: #fff; line-height: 2em; position: absolute; top: 15px; left: 10px">
                        {{ $regView->position ?: '?' }}
                    </span>
                    <img class="object-cover ml-3" src="{{ $regView->getImg() }}" alt="{{ $regView->name }}" style="width: auto; height: 75px">
                    <h5 class="modal-title text-base text-uppercase font-medium tracking-wide py-3 ml-3">
                        <span>{{ $regView->getName() }}</span>
                        @if ($regView->nickname)
                            <span class="d-block text-xs text-muted">"{{ $regView->nickname }}"</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <button type="button" class="btn btn-primary mr-3 mb-2 text-uppercase tracking-widest text-xxs py-1 px-2" wire:click="edit({{ $regView->id }})" style="position: absolute; bottom: 0; right: 0">
                        Editar
                    </button>
                </div>
                <div class="modal-body p-3">
                    <ul class="border rounded list-inline mb-0">

                        <li class="d-flex align-items-center p-2 rounded-top" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">ID</div>
                            <div class="col-7 text-right text-sm">{{ $regView->id }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Nombre</div>
                            <div class="col-7 text-right text-sm">{{ $regView->name ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Apodo</div>
                            <div class="col-7 text-right text-sm {{ $regView->nickname ?: 'text-muted' }}">{{ $regView->nickname ?: 'N/D' }}</div>
                        </li>
                        @if (!$regView->retired)
                            <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                                <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Equipo</div>
                                <div class="col-7 text-right text-sm {{ $regView->team ? '' : 'text-danger' }}">{{ $regView->team ? $regView->team->name : 'Free Agent'}}</div>
                            </li>
                        @endif
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Posición</div>
                            <div class="col-7 text-right text-sm {{ $regView->position ?: 'text-muted' }}">{{ $regView->position ? $regView->getPosition() : 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Altura</div>
                            <div class="col-7 text-right text-sm {{ $regView->height ?: 'text-muted' }}">{{ $regView->height ? $regView->getHeight() . ' ft' : 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Peso</div>
                            <div class="col-7 text-right text-sm {{ $regView->weight ?: 'text-muted' }}">{{ $regView->weight ? $regView->weight . ' lbs' : 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Nacionalidad</div>
                            <div class="col-7 text-right text-sm {{ $regView->nation_name ?: 'text-muted' }}">{{ $regView->nation_name ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Universidad</div>
                            <div class="col-7 text-right text-sm {{ $regView->college ?: 'text-muted' }}">{{ $regView->college ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Edad</div>
                            <div class="col-7 text-right text-sm {{ $regView->birthdate ?: 'text-muted' }}">{{ $regView->birthdate ? $regView->age() . ' años' : 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Año draft</div>
                            <div class="col-7 text-right text-sm {{ $regView->draft_year ?: 'text-muted' }}">{{ $regView->draft_year ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2 rounded-bottom" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Estado</div>
                            <div class="col-7 text-right text-sm {{ $regView->retired ? 'text-danger' : 'text-success' }}">{{ $regView->retired ? 'Retirado' : 'En activo' }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif