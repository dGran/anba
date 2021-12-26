<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="destroyModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    @if ($regsSelected->count() == 1)
                        <span>Eliminar {{ $modelSingular }} seleccionado</span>
                    @else
                        <span>Eliminar {{ $modelPlural }} seleccionados</span>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if ($regsSelected->count() == 1)
                    <p>¿Estás seguro que deseas eliminar {{ $modelGender == 'male' ? 'el' : 'la' }} {{ $modelSingular }} <strong>{{ $regsSelected->first()->getName() }}</strong>?</p>
                @else
                    <p>¿Estás seguro que deseas eliminar {{ $modelGender == 'male' ? 'los' : 'las' }} {{ $regsSelected->count() }} {{ $modelPlural }} seleccionados?</p>
                @endif
                <p class="font-weight-bold text-danger m-0 mb-1">Esta acción será irreversible</p>

                <div class="text-left">
                    @if ($regsSelected->count() == 1)
                        <p class="m-0 mt-4 mb-1 text-sm font-italic border-top pt-3 text-muted">*Si {{ $modelGender == 'male' ? 'el' : 'la' }} {{ $modelSingular }} tiene registrada cualquier actividad relevante para el funcionamiento general no será {{ $modelGender == 'male' ? 'eliminado' : 'eliminada' }}</p>
                    @else
                        <p class="m-0 mt-4 mb-1 text-sm font-italic border-top pt-3 text-muted">*{{ $modelGender == 'male' ? 'Los' : 'Las' }} {{ $modelPlural }} con actividad registrada relevante para el funcionamiento general no serán {{ $modelGender == 'male' ? 'eliminados' : 'eliminadas' }}</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-danger ml-2 text-xs text-uppercase tracking-widest" wire:click="destroy" wire:loading.attr="disabled">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>
