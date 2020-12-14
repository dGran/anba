<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="addModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable non-selectable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>{{ $modelGender == 'male' ? 'Nuevo' : 'Nueva' }} {{ $modelSingular }}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="modal-body">
                    @include('admin.players.forms.form')
                </div>
                <div class="modal-footer" style="background: #F9FAFB">
                    <div class="d-sm-flex align-items-center w-100">
                        <div class="text-xs mr-auto pb-4 pb-sm-0">
                            <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
                                <input type="checkbox" wire:model="continuousInsert">
                                <div class="state p-primary d-flex align-items-center">
                                    <svg class="svg svg-icon" viewBox="0 0 20 20">
                                        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                    </svg>
                                    <label class="text-xs text-uppercase tracking-widest ml-1" style="">Inserción contínua</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:click="closeAnyModal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>