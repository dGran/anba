<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0 my-6">

    <div class="px-4 pt-3">

        <div class="border-b border-gray-150 dark:border-gray-650 pb-2">
            <div class="flex items-center justify-between">
                <p class="uppercase text-xl md:text-2xl font-bold tracking-wider">REPORTAR ESTADISTICAS</p>
                <button type="button" class="text-white dark:text-gray-900 rounded bg-blue-500 dark:bg-dark-link focus:outline-none hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-300 dark:focus:bg-blue-300 transition duration-150 ease-in-out uppercase text-xs py-2 px-3 leading-4" wire:click.prevent="closeLocalBoxscoreReport">
                    cancelar reporte
                </button>
            </div>
            <div class="mt-1.5 flex items-center text-sm md:text-base">
                <img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->name }}" class="w-12 h-12 object-cover">
                <div class="ml-2.5">
                    <span class="uppercase tracking-wider font-bold">{{ $match->localTeam->team->name }}</span>
                </div>
            </div>
        </div>


        <div class="text-sm md:text-base uppercase tracking-wide font-bold pt-6 pb-2 px-1">
            Estadísticas de equipo
        </div>

        <div class="bg-white dark:bg-gray-750 overflow-x-auto">
            <div class="inline-flex">
                @php
                    $total_reb = 0;
                    $total_reb += $local_team_stats[0]['DRB'] ?: 0;
                    $total_reb += $local_team_stats[0]['ORB'] ?: 0;
                @endphp
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pts. contra</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['counterattack'] == null && $local_team_stats[0]['counterattack'] !== 0) ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['counterattack'] == null && $local_team_stats[0]['counterattack'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.counterattack">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pts. Zona</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['zone'] == null && $local_team_stats[0]['zone'] !== 0) || $local_team_stats[0]['zone'] > 200 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['zone'] == null && $local_team_stats[0]['zone'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.zone">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pts. 2da</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['second_oportunity'] == null && $local_team_stats[0]['second_oportunity'] !== 0) || $local_team_stats[0]['second_oportunity'] > 150 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['second_oportunity'] == null && $local_team_stats[0]['second_oportunity'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.second_oportunity">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pts. Suplentes</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['substitute'] == null && $local_team_stats[0]['substitute'] !== 0) || $local_team_stats[0]['substitute'] > 200 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['substitute'] == null && $local_team_stats[0]['substitute'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.substitute">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">Asistencias</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['AST'] == null && $local_team_stats[0]['AST'] !== 0) || $local_team_stats[0]['AST'] > 60 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['AST'] == null && $local_team_stats[0]['AST'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.AST">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">rebotes OF</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['ORB'] == null && $local_team_stats[0]['ORB'] !== 0) || $total_reb > 150 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['ORB'] == null && $local_team_stats[0]['ORB'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.ORB">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">rebotes DEF</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['DRB'] == null && $local_team_stats[0]['DRB'] !== 0) || $total_reb > 150 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['DRB'] == null && $local_team_stats[0]['DRB'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.DRB">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">robos</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['STL'] == null && $local_team_stats[0]['STL'] !== 0) || $local_team_stats[0]['STL'] > 60 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['STL'] == null && $local_team_stats[0]['STL'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.STL">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">tapones</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['BLK'] == null && $local_team_stats[0]['BLK'] !== 0) || $local_team_stats[0]['BLK'] > 50 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['BLK'] == null && $local_team_stats[0]['BLK'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.BLK">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pérdidas</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['LOS'] == null && $local_team_stats[0]['LOS'] !== 0) || $local_team_stats[0]['LOS'] > 125 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['LOS'] == null && $local_team_stats[0]['LOS'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.LOS">
                </div>
                <div class="flex flex-col pr-3" style="width: 135px">
                    <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">faltas</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['PF'] == null && $local_team_stats[0]['PF'] !== 0) ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['PF'] == null && $local_team_stats[0]['PF'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.PF">
                </div>
                <div class="flex flex-col" style="width: 135px">
                    <label class="uppercase mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">Máx. ventaja</label>
                    <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ ($local_team_stats[0]['advantage'] == null && $local_team_stats[0]['advantage'] !== 0) || $local_team_stats[0]['advantage'] > 200 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_team_stats[0]['advantage'] == null && $local_team_stats[0]['advantage'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="local_team_stats.{{ 0 }}.advantage">
                </div>
            </div>
        </div>

        <div class="text-sm md:text-base uppercase tracking-wide font-bold pt-6 pb-2 px-1">
            Estadísticas de jugadores
        </div>
        <div class="bg-white dark:bg-gray-750 overflow-x-auto text-sm md:text-base">
            @if ($match->localTeam->team->players->count()>0)
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left py-1.5 bg-white dark:bg-gray-750 sticky left-0">JUGADOR</th>
                            <th class="text-center w-14 min-w-max">MIN</th>
                            <th class="text-center w-14 min-w-max">PTS</th>
                            <th class="text-center w-14 min-w-max">REB</th>
                            <th class="text-center w-14 min-w-max">AST</th>
                            <th class="text-center w-14 min-w-max">ROB</th>
                            <th class="text-center w-14 min-w-max">TAP</th>
                            <th class="text-center w-14 min-w-max">PER</th>
                            <th class="text-center w-14 min-w-max">FGM</th>
                            <th class="text-center w-14 min-w-max">FGA</th>
                            <th class="text-center w-14 min-w-max">3PM</th>
                            <th class="text-center w-14 min-w-max">3PA</th>
                            <th class="text-center w-14 min-w-max">TLM</th>
                            <th class="text-center w-14 min-w-max">TLA</th>
                            <th class="text-center w-14 min-w-max">RO</th>
                            <th class="text-center w-14 min-w-max">FP</th>
                            <th class="text-center w-14 min-w-max">+/-</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($local_players_stats as $key => $player)
                            @if ($player['season_team_id'] == $match->local_team_id)
                                @php
                                    $field_shots_M = 0;
                                    $field_shots_M += $local_players_stats[$key]['FGM'] ?: 0;
                                    $field_shots_M += $local_players_stats[$key]['TPM'] ?: 0;
                                    $field_shots_M += $local_players_stats[$key]['FTM'] ?: 0;
                                    $field_shots_A = 0;
                                    $field_shots_A += $local_players_stats[$key]['FGA'] ?: 0;
                                    $field_shots_A += $local_players_stats[$key]['TPA'] ?: 0;
                                    $field_shots_A += $local_players_stats[$key]['FTA'] ?: 0;
                                @endphp
                                <tr class="border-t border-gray-150 dark:border-gray-650">
                                    <td class="truncate py-1.5 text-left bg-white dark:bg-gray-750 w-48 md:w-60 min-w-48 md:min-w-60 sticky left-0">
                                        <div class="flex items-center pr-2 mr-2 border-r border-gray-150 dark:border-gray-650">
                                            <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="rounded-full border border-gray-150 dark:border-gray-650 w-8 h-8 object-cover" style="{{ $player['injury_id'] > 0 && !$player['injury_playable'] ? 'filter: grayscale(100%)' : '' }}">
                                            <div class="truncate ml-2">
                                                <span class="truncate {{ $player['injury_id'] > 0 && !$player['injury_playable'] ? 'text-gray-500' : '' }}">
                                                    <i class="fas fa-briefcase-medical text-yellow-400 dark:text-yellow-300 mr-1 {{ $player['injury_id'] > 0 && $player['injury_playable'] ? 'inline-block' : 'hidden' }}"></i> {{ $player['player_name'] }}
                                                </span>
                                                <span class="truncate block text-gray-500 uppercase text-xxs">
                                                    {{ $player['player_pos'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($player['injury_id'] > 0 && !$player['injury_playable'])
                                        <td colspan="99" class="pl-2">
                                            <i class="fas fa-briefcase-medical text-pretty-red mr-2"></i>{{ $player['injury_name'] }}
                                        </td>
                                    @else
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="1" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['MIN'] == null ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.MIN">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['PTS'] == null && $local_players_stats[$key]['PTS'] !== 0) || $local_players_stats[$key]['PTS'] > 150 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['PTS'] == null && $local_players_stats[$key]['PTS'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.PTS">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['REB'] == null && $local_players_stats[$key]['REB'] !== 0) || $local_players_stats[$key]['REB'] > 75 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['REB'] == null && $local_players_stats[$key]['REB'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.REB">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['AST'] == null && $local_players_stats[$key]['AST'] !== 0) || $local_players_stats[$key]['AST'] > 55 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['AST'] == null && $local_players_stats[$key]['AST'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.AST">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['STL'] == null && $local_players_stats[$key]['STL'] !== 0) || $local_players_stats[$key]['STL'] > 30 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['STL'] == null && $local_players_stats[$key]['STL'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.STL">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['BLK'] == null && $local_players_stats[$key]['BLK'] !== 0) || $local_players_stats[$key]['BLK'] > 25 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['BLK'] == null && $local_players_stats[$key]['BLK'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.BLK">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['LOS'] == null && $local_players_stats[$key]['LOS'] !== 0) || $local_players_stats[$key]['LOS'] > 50 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['LOS'] == null && $local_players_stats[$key]['LOS'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.LOS">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['FGM'] == null && $local_players_stats[$key]['FGM'] !== 0) || ($local_players_stats[$key]['FGM'] > $local_players_stats[$key]['FGA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['FGM'] == null && $local_players_stats[$key]['FGM'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.FGM">

                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['FGA'] == null && $local_players_stats[$key]['FGA'] !== 0) || ($local_players_stats[$key]['FGM'] > $local_players_stats[$key]['FGA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['FGA'] == null && $local_players_stats[$key]['FGA'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.FGA">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['TPM'] == null && $local_players_stats[$key]['TPM'] !== 0) || ($local_players_stats[$key]['TPM'] > $local_players_stats[$key]['TPA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['TPM'] == null && $local_players_stats[$key]['TPM'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.TPM">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['TPA'] == null && $local_players_stats[$key]['TPA'] !== 0) || ($local_players_stats[$key]['TPM'] > $local_players_stats[$key]['TPA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['TPA'] == null && $local_players_stats[$key]['TPA'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.TPA">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['FTM'] == null && $local_players_stats[$key]['FTM'] !== 0) || ($local_players_stats[$key]['FTM'] > $local_players_stats[$key]['FTA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['FTM'] == null && $local_players_stats[$key]['FTM'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.FTM">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['FTA'] == null && $local_players_stats[$key]['FTA'] !== 0) || ($local_players_stats[$key]['FTM'] > $local_players_stats[$key]['FTA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['FTA'] == null && $local_players_stats[$key]['FTA'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.FTA">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $local_players_stats[$key]['ORB'] == null && $local_players_stats[$key]['ORB'] !== 0 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['ORB'] == null && $local_players_stats[$key]['ORB'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.ORB">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $local_players_stats[$key]['PF'] == null && $local_players_stats[$key]['PF'] !== 0 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['PF'] == null && $local_players_stats[$key]['PF'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.PF">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <input type="number" min="-999" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($local_players_stats[$key]['ML'] == null && $local_players_stats[$key]['ML'] !== 0) || $local_players_stats[$key]['ML'] > 150 ? 'border-pretty-red dark:border-pretty-red' : '' }} {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none px-2 {{ $local_players_stats[$key]['ML'] == null && $local_players_stats[$key]['ML'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="-" wire:model="local_players_stats.{{ $key }}.ML">
                                        </td>
                                        <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                            <label class="flex items-center cursor-pointer {{ $local_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }}">
                                                <input type="checkbox" class="toggle appearance-none relative w-10 h-5 transition-all duration-200 ease-in-out bg-gray-300 hover:bg-gray-400 focus:bg-gray-400 rounded-full shadow-inner outline-none" wire:model="local_players_stats.{{ $key }}.headline"/>
                                                <span class="ml-2 text-xs uppercase">titular</span>
                                            </label>
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

        <div class="text-center mt-5 border-t border-gray-200 dark:border-gray-650 bg-gray-50 dark:bg-gray-700 -mx-4 px-3 py-5">
            @foreach ($local_team_stats[0] as $team_stat)
                {{-- expr --}}
            @endforeach
            @php
                $allow_report = true;
                foreach ($local_team_stats[0] as $team_stat) {
                    if ($team_stat == null && $team_stat !== 0) { $allow_report = false; }
                }

                $total_reb = 0;
                $total_reb += $local_team_stats[0]['DRB'] ?: 0;
                $total_reb += $local_team_stats[0]['ORB'] ?: 0;
                if ($local_team_stats[0]['zone'] > 200) { $allow_report = false; }
                if ($local_team_stats[0]['second_oportunity'] > 150) { $allow_report = false; }
                if ($local_team_stats[0]['substitute'] > 200) { $allow_report = false; }
                if ($local_team_stats[0]['AST'] > 60) { $allow_report = false; }
                if ($total_reb > 150) { $allow_report = false; }
                if ($local_team_stats[0]['STL'] > 60) { $allow_report = false; }
                if ($local_team_stats[0]['BLK'] > 50) { $allow_report = false; }
                if ($local_team_stats[0]['LOS'] > 125) { $allow_report = false; }
                if ($local_team_stats[0]['advantage'] > 200) { $allow_report = false; }

                $headline_counter = 0;
                foreach ($local_players_stats as $pls) {
                    if ($pls['MIN'] > 0) {
                        $field_shots_M = 0;
                        $field_shots_M += $pls['FGM'] ?: 0;
                        $field_shots_M += $pls['TPM'] ?: 0;
                        $field_shots_M += $pls['FTM'] ?: 0;
                        $field_shots_A = 0;
                        $field_shots_A += $pls['FGA'] ?: 0;
                        $field_shots_A += $pls['TPA'] ?: 0;
                        $field_shots_A += $pls['FTA'] ?: 0;
                        if ($field_shots_M > 99 || $field_shots_A > 99) { $allow_report = false; }
                        if ($pls['PTS'] == null && $pls['PTS'] !== 0 || $pls['PTS'] > 150) { $allow_report = false; }
                        if ($pls['REB'] == null && $pls['REB'] !== 0 || $pls['REB'] > 75) { $allow_report = false; }
                        if ($pls['AST'] == null && $pls['AST'] !== 0 || $pls['AST'] > 55) { $allow_report = false; }
                        if ($pls['STL'] == null && $pls['STL'] !== 0 || $pls['STL'] > 30) { $allow_report = false; }
                        if ($pls['BLK'] == null && $pls['BLK'] !== 0 || $pls['BLK'] > 25) { $allow_report = false; }
                        if ($pls['LOS'] == null && $pls['LOS'] !== 0 || $pls['LOS'] > 50) { $allow_report = false; }
                        if ($pls['FGM'] == null && $pls['FGM'] !== 0) { $allow_report = false; }
                        if ($pls['FGA'] == null && $pls['FGA'] !== 0) { $allow_report = false; }
                        if ($pls['FGM'] > $pls['FGA']) { $allow_report = false; }
                        if ($pls['TPM'] == null && $pls['TPM'] !== 0) { $allow_report = false; }
                        if ($pls['TPA'] == null && $pls['TPA'] !== 0) { $allow_report = false; }
                        if ($pls['TPM'] > $pls['TPA']) { $allow_report = false; }
                        if ($pls['FTM'] == null && $pls['FTM'] !== 0) { $allow_report = false; }
                        if ($pls['FTA'] == null && $pls['FTA'] !== 0) { $allow_report = false; }
                        if ($pls['FTM'] > $pls['FTA']) { $allow_report = false; }
                        if ($pls['ORB'] == null && $pls['ORB'] !== 0) { $allow_report = false; }
                        if ($pls['PF'] == null && $pls['PF'] !== 0) { $allow_report = false; }
                        if ($pls['ML'] == null && $pls['ML'] !== 0 || $pls['ML'] > 150) { $allow_report = false; }
                    }
                    if ($pls['headline']) {
                        $headline_counter++;
                    }
                }
                if ($headline_counter != 5) {
                    $allow_report = false;
                }
            @endphp
            @if ($allow_report)
                <p class="pl-4 text-xl font-bold">Revisa las estadísticas antes de proceder</p>
                <p class="pt-1.5 pb-3 pl-4 text-sm"><u>Tan sólo se permite un único envío.</u> En el caso de haber algún fallo una vez enviado el reporte tendrás que contactar con los administradores para notificarlo.</p>
    		    <button type="button" class="text-white dark:text-gray-900 rounded bg-blue-500 dark:bg-dark-link focus:outline-none hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-300 dark:focus:bg-blue-300 transition duration-150 ease-in-out uppercase text-xs py-2 px-3 leading-4" wire:click.prevent="reportLocalStats">
    				enviar reporte de los {{ $match->localTeam->team->medium_name }}
    		    </button>
            @else
                <div class="w-full text-left px-2 md:px-4">
                	<p class="text-pretty-red font-bold animate-pulse">Envío de reporte no disponible, revisa las condiciones</p>

                    <p class="pt-3 pl-4 text-sm font-bold">Condiciones en estadísticas de equipo</p>
                    <ul class="list-disc text-sm py-2 ml-8 text-gray-500 dark:text-gray-300">
                        <li>Todas las estadísticas de equipo deben ser cumplimentadas.</li>
                        <li>No se puede registrar más de 200 puntos de zona al equipo.</li>
                        <li>No se puede registrar más de 150 puntos de segunda oportunidad al equipo.</li>
                        <li>No se puede registrar más de 60 asistencias al equipo.</li>
                        <li>No se puede registrar más de 150 rebotes totales al equipo.</li>
                        <li>No se puede registrar más de 60 robos al equipo.</li>
                        <li>No se puede registrar más de 50 tapones al equipo.</li>
                        <li>No se puede registrar más de 125 pérdidas al equipo.</li>
                        <li>No se puede registrar más de 200 puntos de máxima ventaja al equipo.</li>
                    </ul>

                    <p class="pt-2 pl-4 text-sm font-bold">Condiciones en estadísticas de jugadores</p>
                    <ul class="list-disc text-sm py-2 ml-8 text-gray-500 dark:text-gray-300">
                        <li>Se deben marcar los 5 jugadores titulares.</li>
                        <li>Todas las estadísticas de jugadores con minutos deben ser cumplimentadas (pueden ser 0).</li>
                        <li>No se puede registrar más de 150 puntos a un jugador.</li>
                        <li>No se puede registrar más de 75 rebotes a un jugador.</li>
                        <li>No se puede registrar más de 55 asistencias a un jugador.</li>
                        <li>No se puede registrar más de 30 robos a un jugador.</li>
                        <li>No se puede registrar más de 25 tapones a un jugador.</li>
                        <li>No se puede registrar más de 50 pérdidas a un jugador.</li>
                        <li>Los tiros de campo anotados no pueden ser superiores a los intentados.</li>
                        <li>Los tiros de 3 puntos anotados no pueden ser superiores a los intentados.</li>
                        <li>Los tiros libres anotados no pueden ser superiores a los intentados.</li>
                        <li>El total de tiros anotados e intentados de un jugador no pueden ser mayor a 99.</li>
                        <li>No se puede registrar más de 150 +/- a un jugador.</li>
                    </ul>
                </div>
            @endif
        </div>

    </div>

</div>