<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="confirmExportTableModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>Exportar tabla {{ $modelPlural }}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Se van a exportar todos los registros de la tabla de {{ $modelPlural }} en formato <strong>".{{ $formatExport }}"</strong></p>
                <p class="font-weight-bold m-0 mb-1">Se aplicarán los filtros y el orden actual</p>

                <p class="mt-4 pt-4" style="text-align: left">
                    <label class="text-uppercase tracking-wide text-xs" style="font-weight: normal;">Nombre del archivo</label><span style="margin-left: .5rem; text-transform: uppercase; font-size: 10px">(opcional)</span>
                    <input type="text" class="form-control text-xs" wire:model="filenameExportTable" placeholder="Nombre del archivo .{{ $formatExport }}">
                </p>
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="tableExport" wire:loading.attr="disabled">
                    Exportar
                </button>
            </div>
        </div>
    </div>
</div>