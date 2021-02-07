<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="restoreStatesModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>Recuperar estado de todos los {{ $modelPlural }}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>¿Estás seguro que deseas eliminar las lesiones/suspensiones de todos los {{ $modelPlural }}?</strong>?</p>
                <p class="font-weight-bold text-danger m-0 mb-1">Esta acción será irreversible</p>
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-danger ml-2 text-xs text-uppercase tracking-widest" wire:click="restoreStateAll" wire:loading.attr="disabled">
                    Recuperar estado
                </button>
            </div>
        </div>
    </div>
</div>