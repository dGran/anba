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
                            <p class="d-block m-0 pt-2 text-center text-uppercase text-xs">{{ $regView->localManager ? $regView->localManager->name : 'Sin manager' }}</p>
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
                            <p class="d-block m-0 pt-2 text-center text-uppercase text-xs">{{ $regView->visitorManager ? $regView->visitorManager->name : 'Sin manager' }}</p>
                        </div>
                    </div>
                    <p class="text-center my-3">{{ $regView->stadium }}</p>

                    @if ( ($scores->sum('local_score') + $scores->sum('visitor_score')) == $players_stats->sum('PTS') )
                        <p class="text-success font-weight-bold text-center">Todo Ok!</p>
                    @else
                        <p class="text-danger font-weight-bold text-center">Los puntos de los jugadores no coinciden con los del resultado</p>
                    @endif

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
                        <div class="text-center p-2 d-flex align-items-center" style="background-color: #F9FAFB; left: 0px; position: sticky; position: -webkit-sticky;">
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
                                        <th class="text-center">MIN</th>
                                        <th class="text-center">PTS</th>
                                        <th class="text-center">REB</th>
                                        <th class="text-center">AST</th>
                                        <th class="text-center">ROB</th>
                                        <th class="text-center">TAP</th>
                                        <th class="text-center">PER</th>
                                        <th class="text-center">FGM</th>
                                        <th class="text-center">FGA</th>
                                        <th class="text-center">3PM</th>
                                        <th class="text-center">3PA</th>
                                        <th class="text-center">TLM</th>
                                        <th class="text-center">TLA</th>
                                        <th class="text-center">RO</th>
                                        <th class="text-center">FP</th>
                                        <th class="text-center">+/-</th>
                                        <th class="text-center">TIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($players_stats as $key => $player)
                                        @if ($player['team_id'] == $regView->localTeam->team->id)
                                            <tr>
                                                <td style="width: 200px; min-width: 200px; max-width: 200px" class="truncate">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-circle border mr-2" style="width: 32px; height: 32px; object-fit: cover;">
                                                        <div class="truncate">
                                                            <span class="truncate">{{ $player['player_name'] }}</span>
                                                            <span class="truncate d-block text-gray-500 text-uppercase text-xxs">{{ $player['player_pos'] }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.MIN"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.PTS"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.REB"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.AST"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.STL"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.BLK"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.LOS"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.FGM"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.FGA"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.TPM"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.TPA"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.FTM"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.FTA"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.OR"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.PF"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.ML"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.headline"></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-3 border-top">
                                La plantilla no tiene jugadores
                            </div>
                        @endif
                    </div>

                    <div class="admin-crud-table-wrapper shadow-sm mt-4 text-sm">
                        <div class="text-center p-2 d-flex align-items-center" style="background-color: #F9FAFB; left: 0px; position: sticky; position: -webkit-sticky;">
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
                                        <th class="text-center">MIN</th>
                                        <th class="text-center">PTS</th>
                                        <th class="text-center">REB</th>
                                        <th class="text-center">AST</th>
                                        <th class="text-center">ROB</th>
                                        <th class="text-center">TAP</th>
                                        <th class="text-center">PER</th>
                                        <th class="text-center">FGM</th>
                                        <th class="text-center">FGA</th>
                                        <th class="text-center">3PM</th>
                                        <th class="text-center">3PA</th>
                                        <th class="text-center">TLM</th>
                                        <th class="text-center">TLA</th>
                                        <th class="text-center">RO</th>
                                        <th class="text-center">FP</th>
                                        <th class="text-center">+/-</th>
                                        <th class="text-center">TIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($players_stats as $key => $player)
                                        @if ($player['team_id'] == $regView->visitorTeam->team->id)
                                            <tr>
                                                <td style="width: 200px; min-width: 200px; max-width: 200px" class="truncate">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-circle border mr-2" style="width: 32px; height: 32px; object-fit: cover;">
                                                        <div class="truncate">
                                                            <span class="truncate">{{ $player['player_name'] }}</span>
                                                            <span class="truncate d-block text-gray-500 text-uppercase text-xxs">{{ $player['player_pos'] }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.MIN"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.PTS"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.REB"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.AST"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.STL"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.BLK"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.LOS"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.FGM"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.FGA"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.TPM"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.TPA"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.FTM"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.FTA"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.OR"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.PF"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.ML"></td>
                                                <td style="width: 80px; min-width: 80px"><input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="players_stats.{{ $key }}.headline"></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-3 border-top">
                                La plantilla no tiene jugadores
                            </div>
                        @endif
                    </div>

                </div> {{-- modal-body --}}

                <div class="modal-footer" style="background: #F9FAFB">
                    <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:click="closeAnyModal">
                        Cancelar
                    </button>
                    @if ($editBoxscoreMode)
                        <button type="button" class="btn btn-danger ml-2 text-xs text-uppercase tracking-widest" wire:click="resetResult">
                            Reset
                        </button>
                        <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="updateResult({{ $regView->id }})">
                            Actualizar
                        </button>
                    @else
                        <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="storeResult">
                            Guardar
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endif