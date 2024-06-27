@if ($regView)
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="viewModal">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="background: #F9FAFB; position: relative; overflow: hidden;">
                    <h5 class="modal-title text-base text-uppercase font-medium tracking-wide pb-3">
                        <span>{{ $regView->getName() }}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <ul class="rounded list-inline mb-0">
                        <li class="d-flex align-items-center p-2 rounded-top" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">ID</div>
                            <div class="col-7 text-right text-sm">{{ $regView->id }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Nombre del registro</div>
                            <div class="col-7 text-right text-sm">{{ $regView->reg_name ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">ID del registro</div>
                            <div class="col-7 text-right text-sm">{{ $regView->reg_id ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Tipo</div>
                            <div class="col-7 text-right text-sm {{ $regView->type == 'INSERT' ? 'text-success' : '' }} {{ $regView->type == 'DELETE' ? 'text-danger' : '' }}">{{ $regView->type ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Tabla</div>
                            <div class="col-7 text-right text-sm">{{ $regView->table ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Usuario</div>
                            <div class="col-7 text-right text-sm">{{ $regView->user ? $regView->user->name : 'N/D'}}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Fecha</div>
                            <div class="col-7 text-right text-sm">{{ $regView->created_at ? $regView->getCreatedAtDate() . ' - ' . $regView->getCreatedAtTime() : 'N/D'}}</div>
                        </li>
                        <li class="d-flex align-items-start p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Detalle</div>
                            <div class="col-7 text-right text-sm">
                                @if ($regView->detail)
                                    {!! nl2br($regView->detail) !!}
                                @else
                                    N/D
                                @endif
                            </div>
                        </li>
                        <li class="d-flex align-items-start p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Detalle anterior</div>
                            <div class="col-7 text-right text-sm">
                                @if ($regView->detail_before)
                                    {!! nl2br($regView->detail_before) !!}
                                @else
                                    N/D
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
