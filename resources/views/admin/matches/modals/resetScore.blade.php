<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="resetScoreModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    @if ($regsSelected->count() == 1)
                        <span>Resetear resultados del {{ $modelSingular }} seleccionado</span>
                    @else
                        <span>Resetear resultados de los {{ $modelPlural }} seleccionados</span>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if ($regsSelected->count() == 1)
                    <p>¿Estás seguro que deseas resetar el resultado del {{ $modelSingular }} <strong>{{ $regsSelected->first()->getName() }}</strong>?</p>
                @else
                    <p>¿Estás seguro que deseas resetar el resultado de los {{ $regsSelected->count() }} {{ $modelPlural }} seleccionados?</p>
                @endif
                <p class="font-weight-bold m-0 mb-2">Se eliminará el resultado pero se mantendrán todas las estadísticas de equipo y jugadores</p>
                <p class="font-weight-bold text-danger m-0 mb-2">Esta acción será irreversible</p>
                <p class="text-xs m-0 mb-1">*Acción válida para partidos con resultado o estadísticas</p>
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-danger ml-2 text-xs text-uppercase tracking-widest" wire:click="resetScore" wire:loading.attr="disabled">
                    Resetear
                </button>
            </div>
        </div>
    </div>
</div>