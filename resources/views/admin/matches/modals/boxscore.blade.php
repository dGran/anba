@if ($regView)
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="boxscoreModal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="background: #F9FAFB; position: relative; overflow: hidden;">
                    <h5 class="modal-title text-base text-uppercase font-medium tracking-wide my-2 pb-3">
                        <span>{{ $regView->getName() }}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body p-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="local">
                            <img src="{{ $regView->localTeam->team->getImg() }}" alt="{{ $regView->localTeam->team->short_name }}" style="width: 72px; height: 72px" class="ml-1">
                        </div>
                        <div class="result mx-2 text-center font-weight-bold text-xl">
                            <div class="d-inline-block text-right" style="min-width: 32px">
                                {{ $scores->sum('local_score') }}
                            </div>
                            <div class="d-inline-block">-</div>
                            <div class="d-inline-block text-left" style="min-width: 32px">
                                {{ $scores->sum('visitor_score') }}
                            </div>
                        </div>
                        <div class="visitor">
                            <img src="{{ $regView->visitorTeam->team->getImg() }}" alt="{{ $regView->visitorTeam->team->short_name }}" style="width: 72px; height: 72px" class="mr-1">
                        </div>
                    </div>

                    <div class="form-row d-flex align-items-end justify-content-center py-3">
                        @foreach ($scores as $key => $score)
                            <div class="form-group col-2">
                                <label>{{ $score['seasons_scores_headers_name'] }}</label>
                                <input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="scores.{{ $key }}.local_score">
                                <input type="number" min="0" class="mt-2 form-control numericInput px-2" placeholder="0" wire:model="scores.{{ $key }}.visitor_score">
                            </div>
                        @endforeach
                    </div>

                    <h5>
                        Estadísticas de jugadores
                    </h5>

                    <div class="admin-crud-table-wrapper shadow-sm mt-2 text-sm">
                        <div class="text-center p-2 d-flex align-items-center" style="background-color: #F9FAFB">
                            <img src="{{ $regView->localTeam->team->getImg() }}" alt="{{ $regView->localTeam->team->name }}" class="rounded-circle border mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                            <div>
                                <span class="text-base text-uppercase tracking-wider">{{ $regView->localTeam->team->name }}</span>
                                <span class="d-block text-left text-xs text-gray-500">{{ $regView->localManager ? $regView->localManager->name : 'Sin manager' }}</span>
                            </div>
                        </div>
                        @if ($regView->localTeam->team->players->count()>0)
                            <table class="admin-crud-table fixed-first striped">
                                <thead>
                                    <tr>
                                        <th>Jugador</th>
                                        <th>Stat1</th>
                                        <th>Stat2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($regView->localTeam->team->players as $player)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $player->getImg() }}" alt="{{ $player->name }}" class="rounded-circle border mr-2" style="width: 32px; height: 32px; object-fit: cover;">
                                                    <div>
                                                        <span>{{ $player->name }}</span>
                                                        <span class="d-block text-gray-500 text-uppercase text-xxs">{{ $player->getPosition() }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-3">
                                La plantilla no tiene jugadores
                            </div>
                        @endif
                    </div>

                    <div class="admin-crud-table-wrapper shadow-sm mt-4 text-sm">
                        <div class="text-center p-2 d-flex align-items-center" style="background-color: #F9FAFB">
                            <img src="{{ $regView->visitorTeam->team->getImg() }}" alt="{{ $regView->visitorTeam->team->name }}" class="rounded-circle border mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                            <div>
                                <span class="text-base text-uppercase tracking-wider">{{ $regView->visitorTeam->team->name }}</span>
                                <span class="d-block text-left text-xs text-gray-500">{{ $regView->visitorManager ? $regView->visitorManager->name : 'Sin manager' }}</span>
                            </div>
                        </div>
                            @if ($regView->visitorTeam->team->players->count()>0)
                            <table class="admin-crud-table fixed-first striped">
                                <thead>
                                    <tr>
                                        <th>Jugador</th>
                                        <th>Stat1</th>
                                        <th>Stat2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($regView->visitorTeam->team->players as $player)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $player->getImg() }}" alt="{{ $player->name }}" class="rounded-circle border mr-2" style="width: 32px; height: 32px; object-fit: cover;">
                                                    <div>
                                                        <span>{{ $player->name }}</span>
                                                        <span class="d-block text-gray-500 text-uppercase text-xxs">{{ $player->getPosition() }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-3">
                                La plantilla no tiene jugadores
                            </div>
                        @endif
                    </div>
                </div> {{-- modal-body --}}

                <div class="modal-footer" style="background: #F9FAFB">
                    <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:click="closeAnyModal">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="storeResult">
                        Guardar
                    </button>
                </div>

            </div>
        </div>
    </div>
@endif