<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="confirmDestroyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    @if ($regsSelected->count() == 1)
                        <span>Eliminar {{ $modelSingular }}</span>
                    @else
                        <span>Eliminar {{ $modelPlural }} seleccionados</span>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if ($regsSelected->count() == 1)
                    <p>¿Estás seguro que deseas eliminar {{ $modelGender = 'male' ? 'el' : 'la' }} {{ $modelSingular }} <strong>{{ $regsSelected->first()->getName() }}</strong>?</p>
                @else
                    <p>¿Estás seguro que deseas eliminar {{ $modelGender = 'male' ? 'los' : 'las' }} {{ $regsSelected->count() }} {{ $modelPlural }} seleccionados?</p>
                @endif
                <p class="font-weight-bold text-danger m-0 mb-1">Esta acción será irreversible.</p>
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled">
                    Cancelar
                </button>
                @if ($regsSelected->count() == 1)
                    <button type="button" class="btn btn-danger ml-2 text-xs text-uppercase tracking-widest" wire:click="destroy({{ $regsSelected->first()->id }})" wire:loading.attr="disabled">
                        Eliminar
                    </button>
                @else
                    <button type="button" class="btn btn-danger ml-2 text-xs text-uppercase tracking-widest" wire:click="destroySelected" wire:loading.attr="disabled">
                        Eliminar
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>