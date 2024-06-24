<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="selectedModal" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>Registros seleccionados</span>
                    <span class="d-block text-xs text-muted">{{ $selectedData->count() }} registros</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body selected-regs">
                <ul>
                    @foreach ($selectedData as $reg)
                        <li>
                            @if ($tableInfo['has_image'])
                                <figure>
                                    <img src="{{ $reg->getImg() }}" alt="{{ $reg->getName() }}">
                                </figure>
                            @endif
                            <div class="{{ $tableInfo['has_image'] ?: 'pl-1' }}">
                                <span class="text-sm">
                                    {{ $reg->getName() }}
                                </span>
                                <span class="text-xxs text-gray-500 d-block">
                                    ID: {{ $reg->id }}
                                </span>
                            </div>
                            <div class="text-right" style="flex: 1 1 auto;">
                                <button wire:click="deselect({{ $reg->id }})" class="btn btn-borderless">
                                    <i class='bx bx-list-minus'></i>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
