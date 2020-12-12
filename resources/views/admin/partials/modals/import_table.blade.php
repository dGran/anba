<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="importModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>Importar {{ $modelPlural }}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="import" enctype="multipart/form-data">
                <div class="modal-body text-center">
                    <p>Selecciona el archivo que contiene los datos (.xls, .xlsx, .csv)</p>
                    <p class="font-weight-bold m-0 mb-1">{{ $modelGender == 'male' ? 'Los' : 'Las' }} {{ $modelPlural }} ya existentes serán {{ $modelGender == 'male' ? 'omitidos' : 'omitidas' }}</p>
                    <div class="form-group">
                        <div class="custom-file" style="text-align: left; margin-top: 1.5rem">
                            <input type="file" class="custom-file-input fileImport" id="fileImport" wire:model="fileImport" accept=".xls, .xlsx, .csv">
                            <label class="custom-file-label" for="fileImport">Seleccionar archivo...</label>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label style="font-weight: 400; padding-top: .5em; font-size: 14px">{{ $fileImport ? 'Archivo cargado' : 'Ningún archivo seleccionado' }}</label>
                    </div>
                </div>
                <div class="modal-footer" style="background: #F9FAFB">
                    <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:loading.attr="disabled" id="importButton" onclick="$('#importButton').text('Importando...');">
                        Importar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>