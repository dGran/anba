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
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="local">
                            <img src="{{ $regView->localTeam->team->getImg() }}" alt="{{ $regView->localTeam->team->short_name }}" style="width: 72px; height: 72px" class="ml-1">
                            <p class="d-block m-0 pt-2 text-center text-sm">{{ $regView->localTeam->team->medium_name }}</p>
                            <p class="d-block m-0 text-center text-xs text-muted">{{ $regView->localManager ? $regView->localManager->name : 'Sin manager' }}</p>
                        </div>
                        <div class="result mx-3 text-center font-weight-bold text-2xl border rounded px-2 py-1 bg-light" style="min-width: 120px">
                            <div class="d-inline-block">
                                {{ $total_scores['local'] ?: '' }}
                            </div>
                            <div class="d-inline-block">-</div>
                            <div class="d-inline-block">
                                {{ $total_scores['visitor'] ?: '' }}
                            </div>
                        </div>
                        <div class="visitor">
                            <img src="{{ $regView->visitorTeam->team->getImg() }}" alt="{{ $regView->visitorTeam->team->short_name }}" style="width: 72px; height: 72px" class="mr-1">
                            <p class="d-block m-0 pt-2 text-center text-sm">{{ $regView->visitorTeam->team->medium_name }}</p>
                            <p class="d-block m-0 text-center text-xs text-muted">{{ $regView->visitorManager ? $regView->visitorManager->name : 'Sin manager' }}</p>
                        </div>
                    </div>
                    {{-- <p class="text-center my-3">{{ $regView->stadium }}</p> --}}

{{--                     @if ( ($total_scores['local'] + $total_scores['visitor']) == $players_stats->sum('PTS') )
                        <p class="text-success font-weight-bold text-center">Todo Ok!</p>
                    @else
                        <p class="text-danger font-weight-bold text-center">Los puntos de los jugadores no coinciden con los del resultado</p>
                    @endif --}}

                    @if (!$regView->played())
                        <div class="form-row d-flex align-items-end justify-content-center py-2">
                            @foreach ($scores as $key => $score)
                                <div class="form-group col-2">
                                    <label>{{ $score['seasons_scores_headers_name'] }}</label>
                                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control numericInput px-2" placeholder="-" wire:model="scores.{{ $key }}.local_score">
                                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="mt-2 form-control numericInput px-2" placeholder="-" wire:model="scores.{{ $key }}.visitor_score">
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($regView->local_manager_id != $regView->localTeam->team->manager_id || $regView->visitor_manager_id != $regView->visitorTeam->team->manager_id)
                        <div class="border rounded p-3 my-3">
                            <h5 class="text-danger font-bold">Atención!</h5>
                            <ul class="list-group">
                                @if ($regView->local_manager_id != $regView->localTeam->team->manager_id)
                                    <li class="list-group-item text-sm m-0 bg-light">*El nuevo manager de {{ $regView->localTeam->team->name }} es <strong>{{ $regView->localTeam->team->user ? $regView->localTeam->team->user->name : 'sin manager' }}</strong></li>
                                @endif
                                @if ($regView->visitor_manager_id != $regView->visitorTeam->team->manager_id)
                                    <li class="list-group-item text-sm m-0 bg-light">*El nuevo manager de {{ $regView->visitorTeam->team->name }} es <strong>{{ $regView->visitorTeam->team->user ? $regView->visitorTeam->team->user->name : 'sin manager' }}</strong></li>
                                @endif
                            </ul>
                            <div class="pt-3 text-xs">
                                <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
                                    <input type="checkbox" wire:model="update_match_managers">
                                    <div class="state p-primary d-flex align-items-center">
                                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                        </svg>
                                        <label class="text-uppercase tracking-widest ml-1" style="">actualizar managers del partido</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($total_scores['local'] > 0 && $total_scores['visitor'] > 0 || $regView->playerStats->count() > 0 || $regView->teamStats->count() > 0)
                        <div class="mt-2 pt-2 text-sm border-top">
                            <div class="text-center py-2 d-flex align-items-center">
                                <img src="{{ $regView->localTeam->team->getImg() }}" alt="{{ $regView->localTeam->team->name }}" class="mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                <div>
                                    <span class="text-base text-uppercase tracking-wider">{{ $regView->localTeam->team->name }}</span>
                                    <span class="d-block text-left text-xs text-gray-500">{{ $regView->localManager ? $regView->localManager->name : 'Sin manager' }}</span>
                                </div>
                            </div>

                            <div class="text-sm text-uppercase tracking-wide pt-3 pb-2 px-1">
                                Estadísticas de equipo
                            </div>

                            <div class="admin-crud-team-stats-wrapper">
                                <div class="d-inline-flex">
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pts. contra</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['counterattack'] == null && $teams_stats[0]['counterattack'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.counterattack">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pts. Zona</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['zone'] == null && $teams_stats[0]['zone'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.zone">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pts. 2da</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['second_oportunity'] == null && $teams_stats[0]['second_oportunity'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.second_oportunity">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pts. Suplentes</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['substitute'] == null && $teams_stats[0]['substitute'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.substitute">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">Asistencias</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['AST'] == null && $teams_stats[0]['AST'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.AST">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">rebotes OF</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['ORB'] == null && $teams_stats[0]['ORB'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.ORB">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">rebotes DEF</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['DRB'] == null && $teams_stats[0]['DRB'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.DRB">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">robos</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['STL'] == null && $teams_stats[0]['STL'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.STL">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">tapones</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['BLK'] == null && $teams_stats[0]['BLK'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.BLK">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pérdidas</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['LOS'] == null && $teams_stats[0]['LOS'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.LOS">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">faltas</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['PF'] == null && $teams_stats[0]['PF'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.PF">
                                    </div>
                                    <div class="d-flex flex-column" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">Máx. ventaja</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[0]['advantage'] == null && $teams_stats[0]['advantage'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 0 }}.advantage">
                                    </div>
                                </div>
                            </div>


                            <div class="text-sm text-uppercase tracking-wide pt-3 pb-2 px-1">
                                Estadísticas de jugadores
                            </div>
                            <div class="admin-crud-table-wrapper">
                                @if ($regView->localTeam->team->players->count()>0)
                                    <table class="admin-crud-table fixed-first striped">
                                        <thead>
                                            <tr>
                                                <th class="">Jugador</th>
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
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($players_stats as $key => $player)
                                                @if ($player['team_id'] == $regView->localTeam->team->id)
                                                    <tr>
                                                        <td style="width: 200px; min-width: 200px; max-width: 200px" class="truncate">
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-circle border mr-2" style="width: 32px; height: 32px; object-fit: cover; {{ $player['injury_id'] ? 'filter: grayscale(100%)' : '' }}">
                                                                <div class="truncate">
                                                                    <span class="truncate {{ $player['injury_id'] > 0 ? 'text-gray-500' : '' }}">{{ $player['player_name'] }}</span>
                                                                    <span class="truncate d-block text-gray-500 text-uppercase text-xxs">{{ $player['player_pos'] }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @if ($player['injury_id'] > 0)
                                                            <td colspan="99">
                                                                <i class="fas fa-briefcase-medical text-danger mr-2"></i>{{ $player['injury_name'] }}
                                                            </td>
                                                        @else
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="1" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control numericInput px-2 {{ $players_stats[$key]['MIN'] == null ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.MIN">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['PTS'] == null && $players_stats[$key]['PTS'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.PTS">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['REB'] == null && $players_stats[$key]['REB'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.REB">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['AST'] == null && $players_stats[$key]['AST'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.AST">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['STL'] == null && $players_stats[$key]['STL'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.STL">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['BLK'] == null && $players_stats[$key]['BLK'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.BLK">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['LOS'] == null && $players_stats[$key]['LOS'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.LOS">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['FGM'] == null && $players_stats[$key]['FGM'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.FGM">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['FGA'] == null && $players_stats[$key]['FGA'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.FGA">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['TPM'] == null && $players_stats[$key]['TPM'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.TPM">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['TPA'] == null && $players_stats[$key]['TPA'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.TPA">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['FTM'] == null && $players_stats[$key]['FTM'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.FTM">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['FTA'] == null && $players_stats[$key]['FTA'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.FTA">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['ORB'] == null && $players_stats[$key]['ORB'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.ORB">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['PF'] == null && $players_stats[$key]['PF'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.PF">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['ML'] == null && $players_stats[$key]['ML'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.ML">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus {{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }}">
                                                                    <input type="checkbox" wire:model="players_stats.{{ $key }}.headline">
                                                                    <div class="state p-primary d-flex align-items-center">
                                                                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                                                                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                                                        </svg>
                                                                        <label class="text-uppercase tracking-widest ml-1" style="">titular</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="p-3">
                                        No existen jugadores en el equipo
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- visitor team --}}
                        <div class="mt-4 pt-2 text-sm border-top">
                            <div class="text-center py-2 d-flex align-items-center">
                                <img src="{{ $regView->visitorTeam->team->getImg() }}" alt="{{ $regView->visitorTeam->team->name }}" class="mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                <div>
                                    <span class="text-base text-uppercase tracking-wider">{{ $regView->visitorTeam->team->name }}</span>
                                    <span class="d-block text-left text-xs text-gray-500">{{ $regView->visitorManager ? $regView->visitorManager->name : 'Sin manager' }}</span>
                                </div>
                            </div>

                            <div class="text-sm text-uppercase tracking-wide pt-3 pb-2 px-1">
                                Estadísticas de equipo
                            </div>

                            <div class="admin-crud-team-stats-wrapper">
                                <div class="d-inline-flex">
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pts. contra</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['counterattack'] == null && $teams_stats[1]['counterattack'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.counterattack">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pts. Zona</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['zone'] == null && $teams_stats[1]['zone'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.zone">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pts. 2da</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['second_oportunity'] == null && $teams_stats[1]['second_oportunity'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.second_oportunity">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pts. Suplentes</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['substitute'] == null && $teams_stats[1]['substitute'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.substitute">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">Asistencias</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['AST'] == null && $teams_stats[1]['AST'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.AST">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">rebotes OF</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['ORB'] == null && $teams_stats[1]['ORB'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.ORB">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">rebotes DEF</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['DRB'] == null && $teams_stats[1]['DRB'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.DRB">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">robos</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['STL'] == null && $teams_stats[1]['STL'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.STL">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">tapones</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['BLK'] == null && $teams_stats[1]['BLK'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.BLK">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">pérdidas</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['LOS'] == null && $teams_stats[1]['LOS'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.LOS">
                                    </div>
                                    <div class="d-flex flex-column pr-3" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mr-3 mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">faltas</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['PF'] == null && $teams_stats[1]['PF'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.PF">
                                    </div>
                                    <div class="d-flex flex-column" style="width: 135px">
                                        <label class="text-gray-600 text-uppercase mb-1 pl-1" style="font-size: .9em; font-weight: 500; letter-spacing: 0.05em;">Máx. ventaja</label>
                                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="form-control text-base {{ $teams_stats[1]['advantage'] == null && $teams_stats[1]['advantage'] !== 0 ? 'bg-light': '' }}" wire:model="teams_stats.{{ 1 }}.advantage">
                                    </div>
                                </div>
                            </div>


                            <div class="text-sm text-uppercase tracking-wide pt-3 pb-2 px-1">
                                Estadísticas de jugadores
                            </div>
                            <div class="admin-crud-table-wrapper">
                                @if ($regView->visitorTeam->team->players->count()>0)
                                    <table class="admin-crud-table fixed-first striped">
                                        <thead>
                                            <tr>
                                                <th class="">Jugador</th>
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
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($players_stats as $key => $player)
                                                @if ($player['team_id'] == $regView->visitorTeam->team->id)
                                                    <tr>
                                                        <td style="width: 200px; min-width: 200px; max-width: 200px" class="truncate">
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-circle border mr-2" style="width: 32px; height: 32px; object-fit: cover; {{ $player['injury_id'] ? 'filter: grayscale(100%)' : '' }}">
                                                                <div class="truncate">
                                                                    <span class="truncate {{ $player['injury_id'] > 0 ? 'text-gray-500' : '' }}">{{ $player['player_name'] }}</span>
                                                                    <span class="truncate d-block text-gray-500 text-uppercase text-xxs">{{ $player['player_pos'] }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @if ($player['injury_id'] > 0)
                                                            <td colspan="99">
                                                                <i class="fas fa-briefcase-medical text-danger mr-2"></i>{{ $player['injury_name'] }}
                                                            </td>
                                                        @else
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control numericInput px-2 {{ $players_stats[$key]['MIN'] == null && $players_stats[$key]['MIN'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.MIN">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['PTS'] == null && $players_stats[$key]['PTS'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.PTS">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['REB'] == null && $players_stats[$key]['REB'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.REB">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['AST'] == null && $players_stats[$key]['AST'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.AST">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['STL'] == null && $players_stats[$key]['STL'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.STL">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['BLK'] == null && $players_stats[$key]['BLK'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.BLK">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['LOS'] == null && $players_stats[$key]['LOS'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.LOS">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['FGM'] == null && $players_stats[$key]['FGM'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.FGM">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['FGA'] == null && $players_stats[$key]['FGA'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.FGA">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['TPM'] == null && $players_stats[$key]['TPM'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.TPM">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['TPA'] == null && $players_stats[$key]['TPA'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.TPA">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['FTM'] == null && $players_stats[$key]['FTM'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.FTM">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['FTA'] == null && $players_stats[$key]['FTA'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.FTA">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['ORB'] == null && $players_stats[$key]['ORB'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.ORB">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['PF'] == null && $players_stats[$key]['PF'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.PF">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }} form-control numericInput px-2 {{ $players_stats[$key]['ML'] == null && $players_stats[$key]['ML'] !== 0 ? 'bg-light' : '' }}" placeholder="-" wire:model="players_stats.{{ $key }}.ML">
                                                            </td>
                                                            <td style="width: 90px; min-width: 90px">
                                                                <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus {{ $players_stats[$key]['MIN'] > 0 ? 'd-block' : 'd-none' }}">
                                                                    <input type="checkbox" wire:model="players_stats.{{ $key }}.headline">
                                                                    <div class="state p-primary d-flex align-items-center">
                                                                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                                                                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                                                        </svg>
                                                                        <label class="text-uppercase tracking-widest ml-1" style="">titular</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="p-3">
                                        No existen jugadores en el equipo
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div> {{-- modal-body --}}

                <div class="modal-footer" style="background: #F9FAFB">
                    <button type="button" class="btn btn-borderless ml-2 text-xs text-uppercase tracking-widest" data-dismiss="modal" wire:click="closeAnyModal">
                        Cancelar
                    </button>
                    @if ($editBoxscoreMode)
                        <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="updateMatch({{ $regView->id }})">
                            Actualizar
                        </button>
                    @else
                        <button type="button" class="btn btn-primary ml-2 text-xs text-uppercase tracking-widest" wire:click="storeMatch">
                            Guardar
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endif