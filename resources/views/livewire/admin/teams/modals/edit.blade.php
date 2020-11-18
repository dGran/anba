<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="editModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>Editar {{ $modelSingular }}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('livewire.admin.teams.forms.form')
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click.prevent="update" wire:loading.attr="disabled">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>