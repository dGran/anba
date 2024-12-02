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
                    <ul class="border rounded list-inline mb-0">

                        <li class="d-flex align-items-center p-2 rounded-top" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">ID</div>
                            <div class="col-7 text-right text-sm">{{ $regView->id }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">IP</div>
                            <div class="col-7 text-right text-sm">{{ $regView->ip ?: 'N/D' }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Usuario</div>
                            <div class="col-7 text-right text-sm">{{ $regView->user ? $regView->user->name : 'N/D'}}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Localización</div>
                            <div class="col-7 text-right text-sm">{{ $regView->location ?: 'N/D'}}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Recuento</div>
                            <div class="col-7 text-right text-sm">{{ $regView->counter ?: 'N/D'}}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Fecha última conexión</div>
                            <div class="col-7 text-right text-sm">{{ $regView->date_last_login ? $regView->getDateLastLoginDate() . ' - ' . $regView->getDateLastLoginTime() : 'N/D'}}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
