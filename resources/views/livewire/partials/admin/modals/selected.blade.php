<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="selectedModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none">
                <h5 class="modal-title text-base text-uppercase font-medium tracking-wide">
                    <span>Registros seleccionados</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body selected-regs">
                <ul>
                    @foreach ($regsSelected as $reg)
                        <li>
                            @if ($modelHasImg)
                                <figure>
                                    <img src="{{ $reg->getImg() }}" alt="{{ $reg->getName() }}">
                                </figure>
                            @endif
                            <div>
                                <span class="text-sm">
                                    {{ $reg->getName() }}
                                </span>
                                <span class="text-xxs text-gray-400 d-block">
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