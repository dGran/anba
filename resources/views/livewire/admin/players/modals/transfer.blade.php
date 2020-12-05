<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="transfersModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    @if ($regsSelected->count() == 1)
                        <span>Transferir {{ $modelSingular }} seleccionado</span>
                    @else
                        <span>Transferir {{ $modelPlural }} seleccionados</span>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
            	<p>Selecciona el equipo donde deseas transferir a <br>
                    @if ($regsSelected->count() == 1) <strong>{{ $regsSelected->first()->getName() }}</strong> @endif
                    @if ($regsSelected->count() > 1) {{ $modelGender = 'male' ? 'los' : 'las' }} <strong>{{ $regsSelected->count() }} {{ $modelPlural }}</strong> seleccionados @endif
            	</p>

				<div class="form-row">
				    <div class="form-group col-12 text-left">
				        <label class="text-sm text-uppercase tracking-wide">Equipo</label>
				        <select class="form-control custom-select text-sm" wire:model="teamTransfer">
				            <option value="">Free agent</option>
				            @foreach ($teams as $team)
				                <option value="{{ $team->id }}">{{ $team->name }}</option>
				            @endforeach
				        </select>
				    </div>
				</div>
				@if ($regsSelected->count() > 1)
					<p class="font-weight-bold text-info m-0 mb-1">Los jugadores retirados no serán transferidos</p>
				@endif
            </div>
            <div class="modal-footer" style="background: #F9FAFB">
                <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:loading.attr="disabled" wire:click="closeAnyModal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="transfer" wire:loading.attr="disabled">
                    Transferir
                </button>
            </div>
        </div>
    </div>
</div>