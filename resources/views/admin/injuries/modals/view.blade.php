@if ($regView)
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="viewModal">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="background: #F9FAFB; position: relative; overflow: hidden;">
                    <h5 class="modal-title text-base text-uppercase font-medium tracking-wide my-2 pb-3">
                        <span>{{ $regView->getName() }}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <button type="button" class="btn btn-primary mr-3 mb-2 text-uppercase tracking-widest text-xxs py-1 px-2" wire:click="edit({{ $regView->id }})" style="position: absolute; bottom: -2px; right: 0;">
                        Editar
                    </button>
                </div>
                <div class="modal-body p-3">
                    <ul class="border rounded list-inline mb-0">

                        <li class="d-flex align-items-center p-2 rounded-top" style="border-bottom: 1px solid #e9ecef" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">ID</div>
                            <div class="col-7 text-right text-sm">{{ $regView->id }}</div>
                        </li>
                        <li class="d-flex align-items-center p-2" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='';">
                            <div class="col-5 text-left text-uppercase tracking-widest font-weight-bold text-xs">Nombre</div>
                            <div class="col-7 text-right text-sm">{{ $regView->name ?: 'N/D' }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
