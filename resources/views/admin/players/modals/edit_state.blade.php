<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="editStateModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable non-selectable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>{{ $reg_id }} - {{ $name }}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="updateState">
                <div class="modal-body">
                    @include('admin.players.forms.formState')
                </div>
                <div class="modal-footer" style="background: #F9FAFB">
                    <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:click="closeAnyModal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>