@if ($regView)
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="viewModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="background: #F9FAFB; position: relative; overflow: hidden;">
                    <img class="object-cover ml-3" src="{{ $regView->getImg() }}" alt="{{ $regView->name }}" style="width: auto; height: 75px">
                    <h5 class="modal-title text-base text-uppercase font-medium tracking-wide py-3 ml-3">
                        <span>{{ $regView->getName() }}</span>
                        <span class="d-block text-xs text-muted">[{{ $regView->short_name }}] {{ $regView->medium_name }}</span>
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
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Nombre medio</div>
                            <div class="col-7 text-right text-sm">{{ $regView->medium_name ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Nombre corto</div>
                            <div class="col-7 text-right text-sm">{{ $regView->short_name ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">División</div>
                            <div class="col-7 text-right text-sm">{{ $regView->division ? $regView->division->name : 'N/D' }}</div>
                        </li>
                        @if ($regView->active)
                            <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                                <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Manager</div>
                                <div class="col-7 text-right text-sm">{{ $regView->user ? $regView->user->name : 'N/D'}}</div>
                            </li>
                        @endif
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Estadio</div>
                            <div class="col-7 text-right text-sm">{{ $regView->stadium ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Color</div>
                            <div class="col-7 text-right text-sm" style="{{ $regView->color ? "color: $regView->color" : '' }}">{{ $regView->color ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2 rounded-bottom" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Estado</div>
                            <div class="col-7 text-right text-sm {{ $regView->active ? 'text-success' : 'text-danger' }}">{{ $regView->active ? 'Activo' : 'Inactivo' }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif