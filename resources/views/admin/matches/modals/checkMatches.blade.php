<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="checkMatchesModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    Chequear partidos
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p class="font-bold">Se van a actualizar los estadios y managers actuales en todos los partidos pendientes</p>
                <p>¿Estás seguro que deseas continuar?</p>
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">
                    No, cancelar
                </button>
                <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="checkMatches" wire:loading.attr="disabled">
                    Sí, chequear partidos
                </button>
            </div>
        </div>
    </div>
</div>