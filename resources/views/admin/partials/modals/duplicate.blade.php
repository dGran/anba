<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="duplicateModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    @if ($regsSelected->count() == 1)
                        <span>Duplicar {{ $modelSingular }} seleccionado</span>
                    @else
                        <span>Duplicar {{ $modelPlural }} seleccionados</span>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if ($regsSelected->count() == 1)
                    <p>¿Estás seguro que deseas duplicar {{ $modelGender = 'male' ? 'el' : 'la' }} {{ $modelSingular }} <strong>{{ $regsSelected->first()->getName() }}</strong>?</p>
                @else
                    <p>¿Estás seguro que deseas duplicar {{ $modelGender = 'male' ? 'los' : 'las' }} {{ $regsSelected->count() }} {{ $modelPlural }} seleccionados?</p>
                @endif
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="duplicate" wire:loading.attr="disabled">
                    Duplicar
                </button>
            </div>
        </div>
    </div>
</div>