@if ($visitorBoxscoreReport)
    <div class="{{ $visitorBoxscoreReport ?: 'hidden' }} bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0 my-6">

        <div class="px-4 pt-3">

            <div class="border-b border-gray-150 dark:border-gray-650 pb-2">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex flex-col">
                        <p class="uppercase text-xl md:text-2xl font-bold tracking-wider">REPORTAR ESTADISTICAS</p>
                        <div class="flex items-center text-sm md:text-base">
                            <img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->name }}" class="w-12 h-12 object-cover">
                            <div class="ml-2.5">
                                <span class="uppercase tracking-wider font-bold">{{ $match->visitorTeam->team->name }}</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="text-white dark:text-gray-900 rounded bg-blue-500 dark:bg-dark-link focus:outline-none hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-300 dark:focus:bg-blue-300 transition duration-150 ease-in-out uppercase text-xs mt-6 mb-3 md:my-0 py-2 px-3 leading-4" wire:click.prevent="closeVisitorBoxscoreReport">
                        cancelar reporte
                    </button>
                </div>
            </div>


            <div class="text-sm md:text-base uppercase tracking-wide font-bold pt-6 pb-2 px-1">
                Estadísticas de equipo
            </div>

            <div class="bg-white dark:bg-gray-750 overflow-x-auto">
                <div class="inline-flex pb-3">
                    @php
                        $total_reb = 0;
                        $total_reb += $visitor_team_stats[0]['DRB'] ?: 0;
                        $total_reb += $visitor_team_stats[0]['ORB'] ?: 0;
                    @endphp
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pts. contra</label>
                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['counterattack'] == null && $visitor_team_stats[0]['counterattack'] !== 0) ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['counterattack'] == null && $visitor_team_stats[0]['counterattack'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.counterattack">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pts. Zona</label>
                        <input type="number" min="0" max="200" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['zone'] == null && $visitor_team_stats[0]['zone'] !== 0) || $visitor_team_stats[0]['zone'] > 200 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['zone'] == null && $visitor_team_stats[0]['zone'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.zone">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pts. 2da</label>
                        <input type="number" min="0" max="150" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['second_oportunity'] == null && $visitor_team_stats[0]['second_oportunity'] !== 0) || $visitor_team_stats[0]['second_oportunity'] > 150 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['second_oportunity'] == null && $visitor_team_stats[0]['second_oportunity'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.second_oportunity">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pts. Suplentes</label>
                        <input type="number" min="0" max="200" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['substitute'] == null && $visitor_team_stats[0]['substitute'] !== 0) || $visitor_team_stats[0]['substitute'] > 200 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['substitute'] == null && $visitor_team_stats[0]['substitute'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.substitute">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">Asistencias</label>
                        <input type="number" min="0" max="60" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['AST'] == null && $visitor_team_stats[0]['AST'] !== 0) || $visitor_team_stats[0]['AST'] > 60 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['AST'] == null && $visitor_team_stats[0]['AST'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.AST">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">rebotes OF</label>
                        <input type="number" min="0" max="150" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['ORB'] == null && $visitor_team_stats[0]['ORB'] !== 0) || $total_reb > 150 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['ORB'] == null && $visitor_team_stats[0]['ORB'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.ORB">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">rebotes DEF</label>
                        <input type="number" min="0" max="150" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['DRB'] == null && $visitor_team_stats[0]['DRB'] !== 0) || $total_reb > 150 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['DRB'] == null && $visitor_team_stats[0]['DRB'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.DRB">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">robos</label>
                        <input type="number" min="0" max="60" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['STL'] == null && $visitor_team_stats[0]['STL'] !== 0) || $visitor_team_stats[0]['STL'] > 60 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['STL'] == null && $visitor_team_stats[0]['STL'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.STL">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">tapones</label>
                        <input type="number" min="0" max="50" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['BLK'] == null && $visitor_team_stats[0]['BLK'] !== 0) || $visitor_team_stats[0]['BLK'] > 50 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['BLK'] == null && $visitor_team_stats[0]['BLK'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.BLK">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">pérdidas</label>
                        <input type="number" min="0" max="125" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['LOS'] == null && $visitor_team_stats[0]['LOS'] !== 0) || $visitor_team_stats[0]['LOS'] > 125 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['LOS'] == null && $visitor_team_stats[0]['LOS'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.LOS">
                    </div>
                    <div class="flex flex-col pr-3" style="width: 135px">
                        <label class="uppercase mr-3 mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">faltas</label>
                        <input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['PF'] == null && $visitor_team_stats[0]['PF'] !== 0) ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['PF'] == null && $visitor_team_stats[0]['PF'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.PF">
                    </div>
                    <div class="flex flex-col" style="width: 135px">
                        <label class="uppercase mb-1 pl-1" style="font-size: .8em; font-weight: 500; letter-spacing: 0.05em;">Máx. ventaja</label>
                        <input type="number" min="0" max="200" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ ($visitor_team_stats[0]['advantage'] == null && $visitor_team_stats[0]['advantage'] !== 0) || $visitor_team_stats[0]['advantage'] > 200 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_team_stats[0]['advantage'] == null && $visitor_team_stats[0]['advantage'] !== 0 ? 'bg-gray-50 dark:bg-gray-650': '' }}" wire:model="visitor_team_stats.{{ 0 }}.advantage">
                    </div>
                </div>
            </div>

            <div class="text-sm md:text-base uppercase pt-6 pb-2 px-1">
                <p class="tracking-wide font-bold">Estadísticas de jugadores</p>
                <div class="py-2 w-full">
                    <label class="flex items-center cursor-pointer py-1.5 select-none">
                        <input type="checkbox" class="toggle appearance-none relative w-10 h-5 transition-all duration-200 ease-in-out bg-gray-300 hover:bg-gray-400 focus:bg-gray-400 rounded-full shadow-inner outline-none" wire:model="show_players_stats_totals_under"/>
                        <span class="ml-2 text-xs uppercase">Mostrar totales al final</span>
                    </label>
                    <label class="flex items-center cursor-pointer py-1.5 select-none">
                        <input type="checkbox" class="toggle appearance-none relative w-10 h-5 transition-all duration-200 ease-in-out bg-gray-300 hover:bg-gray-400 focus:bg-gray-400 rounded-full shadow-inner outline-none" wire:model="show_players_stats_totals_inline"/>
                        <span class="ml-2 text-xs uppercase">Mostrar totales por línea</span>
                    </label>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-750 overflow-x-auto text-sm md:text-base">
                @if ($match->visitorTeam->team->players->count()>0)
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left py-1.5 bg-white dark:bg-gray-750 w-40 sm:w-80 min-w-40 sm:min-w-80 sticky left-0">JUGADOR</th>
                                <th class="text-center w-16 px-2.5 min-w-max">MIN</th>
                                <th class="text-center w-16 px-2.5 min-w-max">PTS</th>
                                <th class="text-center w-16 px-2.5 min-w-max">REB</th>
                                <th class="text-center w-16 px-2.5 min-w-max">AST</th>
                                <th class="text-center w-16 px-2.5 min-w-max">ROB</th>
                                <th class="text-center w-16 px-2.5 min-w-max">TAP</th>
                                <th class="text-center w-16 px-2.5 min-w-max">PER</th>
                                <th class="text-center w-16 px-2.5 min-w-max">FGM</th>
                                <th class="text-center w-16 px-2.5 min-w-max">FGA</th>
                                <th class="text-center w-16 px-2.5 min-w-max">3PM</th>
                                <th class="text-center w-16 px-2.5 min-w-max">3PA</th>
                                <th class="text-center w-16 px-2.5 min-w-max">TLM</th>
                                <th class="text-center w-16 px-2.5 min-w-max">TLA</th>
                                <th class="text-center w-16 px-2.5 min-w-max">RO</th>
                                <th class="text-center w-16 px-2.5 min-w-max">FP</th>
                                <th class="text-center w-16 px-2.5 min-w-max">+/-</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitor_players_stats as $key => $player)
                                @if ($player['season_team_id'] == $match->visitor_team_id)
                                    @php
                                        $field_shots_M = 0;
                                        $field_shots_M += $visitor_players_stats[$key]['FGM'] ?: 0;
                                        $field_shots_M += $visitor_players_stats[$key]['TPM'] ?: 0;
                                        $field_shots_M += $visitor_players_stats[$key]['FTM'] ?: 0;
                                        $field_shots_A = 0;
                                        $field_shots_A += $visitor_players_stats[$key]['FGA'] ?: 0;
                                        $field_shots_A += $visitor_players_stats[$key]['TPA'] ?: 0;
                                        $field_shots_A += $visitor_players_stats[$key]['FTA'] ?: 0;
                                    @endphp
                                    <tr class="border-t border-gray-150 dark:border-gray-650">
                                        <td class="truncate py-1.5 text-left bg-white dark:bg-gray-750 w-40 sm:w-80 min-w-40 sm:min-w-80 sticky left-0">
                                            <div class="flex items-center pr-2 mr-2 border-r border-gray-150 dark:border-gray-650">
                                                <img src="{{ $player['player_img'] }}" alt="{{ $player['player_name'] }}" class="hidden sm:block rounded-full border border-gray-150 dark:border-gray-650 w-8 h-8 object-cover" style="{{ $player['injury_id'] > 0 && !$player['injury_playable'] ? 'filter: grayscale(100%)' : '' }}">

                                                <div class="hidden sm:block truncate ml-2" style="min-width: 12rem; max-width: 12rem">
                                                    <p class="truncate {{ $player['injury_id'] > 0 && !$player['injury_playable'] ? 'text-gray-500' : '' }}">
                                                        <i class="fas fa-briefcase-medical text-yellow-400 dark:text-yellow-300 mr-1 {{ $player['injury_id'] > 0 && $player['injury_playable'] ? 'inline-block' : 'hidden' }}"></i> {{ $player['player_name'] }}
                                                    </p>
                                                    <span class="truncate block text-gray-500 uppercase text-xxs">
                                                        {{ $player['player_pos'] }}
                                                    </span>
                                                </div>
                                                <div class="sm:hidden truncate" style="min-width: 7rem; max-width: 7rem">
                                                    <p class="truncate {{ $player['injury_id'] > 0 && !$player['injury_playable'] ? 'text-gray-500' : '' }}">
                                                        <i class="fas fa-briefcase-medical text-yellow-400 dark:text-yellow-300 mr-1 {{ $player['injury_id'] > 0 && $player['injury_playable'] ? 'inline-block' : 'hidden' }}"></i> {{ $player['player_name'] }}
                                                    </p>
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
                                            <td class="w-14 px-1.5 py-2" style="min-width: 2.5rem">
                                                <input type="number" min="1" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none {{ $visitor_players_stats[$key]['MIN'] == null ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="MIN" wire:model="visitor_players_stats.{{ $key }}.MIN">
                                                <p class="{{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 {{ $visitor_players_stats_totals['MIN'] >= 240 ? 'text-gray-500' : 'text-pretty-red' }}">TOT. MIN: {{ $visitor_players_stats_totals['MIN'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="150" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['PTS'] == null && $visitor_players_stats[$key]['PTS'] !== 0) || $visitor_players_stats[$key]['PTS'] > 150 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['PTS'] == null && $visitor_players_stats[$key]['PTS'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="PTS" wire:model="visitor_players_stats.{{ $key }}.PTS">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. PTS: {{ $visitor_players_stats_totals['PTS'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="75" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['REB'] == null && $visitor_players_stats[$key]['REB'] !== 0) || $visitor_players_stats[$key]['REB'] > 75 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['REB'] == null && $visitor_players_stats[$key]['REB'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="REB" wire:model="visitor_players_stats.{{ $key }}.REB">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. REB: {{ $visitor_players_stats_totals['REB'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="55" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['AST'] == null && $visitor_players_stats[$key]['AST'] !== 0) || $visitor_players_stats[$key]['AST'] > 55 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['AST'] == null && $visitor_players_stats[$key]['AST'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="AST" wire:model="visitor_players_stats.{{ $key }}.AST">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. AST: {{ $visitor_players_stats_totals['AST'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="30" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['STL'] == null && $visitor_players_stats[$key]['STL'] !== 0) || $visitor_players_stats[$key]['STL'] > 30 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['STL'] == null && $visitor_players_stats[$key]['STL'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="ROB" wire:model="visitor_players_stats.{{ $key }}.STL">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. ROB: {{ $visitor_players_stats_totals['STL'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="25" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['BLK'] == null && $visitor_players_stats[$key]['BLK'] !== 0) || $visitor_players_stats[$key]['BLK'] > 25 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['BLK'] == null && $visitor_players_stats[$key]['BLK'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="TAP" wire:model="visitor_players_stats.{{ $key }}.BLK">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. TAP: {{ $visitor_players_stats_totals['BLK'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="50" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['LOS'] == null && $visitor_players_stats[$key]['LOS'] !== 0) || $visitor_players_stats[$key]['LOS'] > 50 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['LOS'] == null && $visitor_players_stats[$key]['LOS'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="PER" wire:model="visitor_players_stats.{{ $key }}.LOS">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. PER: {{ $visitor_players_stats_totals['LOS'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['FGM'] == null && $visitor_players_stats[$key]['FGM'] !== 0) || ($visitor_players_stats[$key]['FGM'] > $visitor_players_stats[$key]['FGA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['FGM'] == null && $visitor_players_stats[$key]['FGM'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="FGM" wire:model="visitor_players_stats.{{ $key }}.FGM">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. FGM: {{ $visitor_players_stats_totals['FGM'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['FGA'] == null && $visitor_players_stats[$key]['FGA'] !== 0) || ($visitor_players_stats[$key]['FGM'] > $visitor_players_stats[$key]['FGA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['FGA'] == null && $visitor_players_stats[$key]['FGA'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="FGA" wire:model="visitor_players_stats.{{ $key }}.FGA">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. FGA: {{ $visitor_players_stats_totals['FGA'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['TPM'] == null && $visitor_players_stats[$key]['TPM'] !== 0) || ($visitor_players_stats[$key]['TPM'] > $visitor_players_stats[$key]['TPA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['TPM'] == null && $visitor_players_stats[$key]['TPM'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="3PM" wire:model="visitor_players_stats.{{ $key }}.TPM">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. 3PM: {{ $visitor_players_stats_totals['TPM'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['TPA'] == null && $visitor_players_stats[$key]['TPA'] !== 0) || ($visitor_players_stats[$key]['TPM'] > $visitor_players_stats[$key]['TPA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['TPA'] == null && $visitor_players_stats[$key]['TPA'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="3PA" wire:model="visitor_players_stats.{{ $key }}.TPA">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. 3PA: {{ $visitor_players_stats_totals['TPA'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['FTM'] == null && $visitor_players_stats[$key]['FTM'] !== 0) || ($visitor_players_stats[$key]['FTM'] > $visitor_players_stats[$key]['FTA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['FTM'] == null && $visitor_players_stats[$key]['FTM'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="TLM" wire:model="visitor_players_stats.{{ $key }}.FTM">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. TLM: {{ $visitor_players_stats_totals['FTM'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['FTA'] == null && $visitor_players_stats[$key]['FTA'] !== 0) || ($visitor_players_stats[$key]['FTM'] > $visitor_players_stats[$key]['FTA']) || ($field_shots_M > 99 || $field_shots_A > 99) ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['FTA'] == null && $visitor_players_stats[$key]['FTA'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="TLA" wire:model="visitor_players_stats.{{ $key }}.FTA">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. TLA: {{ $visitor_players_stats_totals['FTA'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $visitor_players_stats[$key]['ORB'] == null && $visitor_players_stats[$key]['ORB'] !== 0 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['ORB'] == null && $visitor_players_stats[$key]['ORB'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="RO" wire:model="visitor_players_stats.{{ $key }}.ORB">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. RO: {{ $visitor_players_stats_totals['ORB'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ $visitor_players_stats[$key]['PF'] == null && $visitor_players_stats[$key]['PF'] !== 0 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['PF'] == null && $visitor_players_stats[$key]['PF'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="FP" wire:model="visitor_players_stats.{{ $key }}.PF">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. FP: {{ $visitor_players_stats_totals['PF'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5" style="min-width: 2.5rem">
                                                <input type="number" min="-150" max="150" maxlength = "4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="{{ ($visitor_players_stats[$key]['ML'] == null && $visitor_players_stats[$key]['ML'] !== 0) || $visitor_players_stats[$key]['ML'] > 150 || $visitor_players_stats[$key]['ML'] < -150 ? 'border-pretty-red dark:border-pretty-red' : 'border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550' }} {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} w-16 appearance-none rounded text-sm | py-1.5 px-2.5 | bg-white dark:bg-gray-700 | border | focus:outline-none {{ $visitor_players_stats[$key]['ML'] == null && $visitor_players_stats[$key]['ML'] !== 0 ? 'bg-gray-50 dark:bg-gray-650' : '' }}" placeholder="+/-" wire:model="visitor_players_stats.{{ $key }}.ML">
                                                <p class="{{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }} {{ $show_players_stats_totals_inline ?: 'hidden' }} text-center text-xxs pt-1 text-gray-500">TOT. +/-: {{ $visitor_players_stats_totals['ML'] }}</p>
                                            </td>
                                            <td class="w-14 px-1.5 select-none" style="min-width: 2.5rem">
                                                <label class="flex items-center cursor-pointer {{ $visitor_players_stats[$key]['MIN'] > 0 ? 'block' : 'hidden' }}">
                                                    <input type="checkbox" class="toggle appearance-none relative w-10 h-5 transition-all duration-200 ease-in-out bg-gray-300 hover:bg-gray-400 focus:bg-gray-400 rounded-full shadow-inner outline-none" wire:model="visitor_players_stats.{{ $key }}.headline"/>
                                                    <span class="ml-2 text-xs uppercase">titular</span>
                                                </label>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                            <tr class="{{ $show_players_stats_totals_under ?: 'hidden' }} border-t border-gray-150 dark:border-gray-650">
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} truncate py-1.5 text-left bg-white dark:bg-gray-750 sticky left-0 font-bold">TOTALES</td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">MIN</span>
                                        <span class="font-bold {{ $visitor_players_stats_totals['MIN'] >= 240 ?: 'text-pretty-red' }}">{{ $visitor_players_stats_totals['MIN'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">PTS</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['PTS'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">REB</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['REB'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">AST</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['AST'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">ROB</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['STL'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">TAP</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['BLK'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">PER</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['LOS'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">FGM</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['FGM'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">FGA</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['FGA'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">3PM</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['TPM'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">3PA</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['TPA'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">TLM</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['FTM'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">TLA</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['FTA'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">RO</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['ORB'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">FP</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['PF'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max" style="min-width: 2.5rem">
                                    <div class="flex flex-col">
                                        <span class="">+/-</span>
                                        <span class="font-bold">{{ $visitor_players_stats_totals['ML'] }}</span>
                                    </div>
                                </td>
                                <td class="{{ $show_players_stats_totals_under ?: 'hidden' }} text-center w-14 p-1.5 min-w-max font-bold" style="min-width: 2.5rem"></td>
                            </tr>
                        </table>
                @else
                    <div class="p-3">
                        No existen jugadores en el equipo
                    </div>
                @endif
            </div>

            <div class="text-center mt-5 border-t border-gray-200 dark:border-gray-650 bg-gray-50 dark:bg-gray-700 -mx-4 px-3 py-5">
                @php
                    $allow_report = true;
                    $all_team_stats_cumplimented = true;
                    foreach ($visitor_team_stats[0] as $team_stat) {
                        if ($team_stat == null && $team_stat !== 0) { $allow_report = false; $all_team_stats_cumplimented = false; }
                    }

                    $total_reb = 0;
                    $total_reb += $visitor_team_stats[0]['DRB'] ?: 0;
                    $total_reb += $visitor_team_stats[0]['ORB'] ?: 0;
                    if ($visitor_team_stats[0]['zone'] > 200) { $allow_report = false; }
                    if ($visitor_team_stats[0]['second_oportunity'] > 150) { $allow_report = false; }
                    if ($visitor_team_stats[0]['substitute'] > 200) { $allow_report = false; }
                    if ($visitor_team_stats[0]['AST'] > 60) { $allow_report = false; }
                    if ($total_reb > 150) { $allow_report = false; }
                    if ($visitor_team_stats[0]['STL'] > 60) { $allow_report = false; }
                    if ($visitor_team_stats[0]['BLK'] > 50) { $allow_report = false; }
                    if ($visitor_team_stats[0]['LOS'] > 125) { $allow_report = false; }
                    if ($visitor_team_stats[0]['advantage'] > 200) { $allow_report = false; }

                    $headline_counter = 0;
                    $exception_players_stats = [
                        'all_player_stats_cumplimented' => false,
                        'TOTAL_MINS' => $visitor_players_stats_totals['MIN'] < 240 ? true : false,
                        'PTS' => false,
                        'REB' => false,
                        'AST' => false,
                        'STL' => false,
                        'BLK' => false,
                        'LOS' => false,
                        'FG' => false,
                        'TP' => false,
                        'FT' => false,
                        'SHOOTS_TOTAL' => false,
                        'ML' => false,
                    ];
                    foreach ($visitor_players_stats as $pls) {
                        if ($pls['MIN'] > 0) {
                            $field_shots_M = 0;
                            $field_shots_M += $pls['FGM'] ?: 0;
                            $field_shots_M += $pls['TPM'] ?: 0;
                            $field_shots_M += $pls['FTM'] ?: 0;
                            $field_shots_A = 0;
                            $field_shots_A += $pls['FGA'] ?: 0;
                            $field_shots_A += $pls['TPA'] ?: 0;
                            $field_shots_A += $pls['FTA'] ?: 0;
                            if ($field_shots_M > 99 || $field_shots_A > 99) { $allow_report = false; $exception_players_stats['SHOOTS_TOTAL'] = true; }
                            if ($visitor_players_stats_totals['MIN'] < 240) { $allow_report = false; $exception_players_stats['TOTAL_MINS'] = true; }
                            if ($pls['PTS'] == null && $pls['PTS'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['PTS'] > 150) { $allow_report = false; $exception_players_stats['PTS'] = true; }
                            if ($pls['REB'] == null && $pls['REB'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['REB'] > 75) { $allow_report = false; $exception_players_stats['REB'] = true; }
                            if ($pls['AST'] == null && $pls['AST'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['AST'] > 55) { $allow_report = false; $exception_players_stats['AST'] = true; }
                            if ($pls['STL'] == null && $pls['STL'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['STL'] > 30) { $allow_report = false; $exception_players_stats['STL'] = true; }
                            if ($pls['BLK'] == null && $pls['BLK'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['BLK'] > 25) { $allow_report = false; $exception_players_stats['BLK'] = true; }
                            if ($pls['LOS'] == null && $pls['LOS'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['LOS'] > 50) { $allow_report = false; $exception_players_stats['LOS'] = true; }
                            if ($pls['FGM'] == null && $pls['FGM'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['FGA'] == null && $pls['FGA'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['FGM'] > $pls['FGA']) { $allow_report = false; $exception_players_stats['FG'] = true; }
                            if ($pls['TPM'] == null && $pls['TPM'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['TPA'] == null && $pls['TPA'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['TPM'] > $pls['TPA']) { $allow_report = false; $exception_players_stats['TP'] = true; }
                            if ($pls['FTM'] == null && $pls['FTM'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['FTA'] == null && $pls['FTA'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['FTM'] > $pls['FTA']) { $allow_report = false; $exception_players_stats['FT'] = true; }
                            if ($pls['ORB'] == null && $pls['ORB'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['PF'] == null && $pls['PF'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['ML'] == null && $pls['ML'] !== 0) { $allow_report = false; $exception_players_stats['all_player_stats_cumplimented'] = true; }
                            if ($pls['ML'] != null && ($pls['ML'] > 150 || $pls['ML'] < -150)) { $allow_report = false; $exception_players_stats['ML'] = true; }
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
                    <p class="pt-1.5 pb-3 pl-4 text-sm"><u>Tan sólo se permite un único reporte.</u> En el caso de haber algún fallo una vez enviado el reporte tendrás que contactar con los administradores para notificarlo.</p>
                    <button type="button" class="text-white dark:text-gray-900 rounded bg-blue-500 dark:bg-dark-link focus:outline-none hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-300 dark:focus:bg-blue-300 transition duration-150 ease-in-out uppercase text-xs py-2 px-3 leading-4" wire:click.prevent="reportVisitorStats">
                        enviar reporte de los {{ $match->visitorTeam->team->medium_name }}
                    </button>
                @else
                    <div class="w-full text-left px-2 md:px-4">
                        <p class="text-pretty-red font-bold animate-pulse">Envío de reporte no disponible, revisa las condiciones</p>

                        <p class="pt-3 pl-4 text-sm font-bold">Condiciones en estadísticas de equipo</p>
                        <ul class="list-disc text-sm py-2 ml-8 text-gray-500 dark:text-gray-300">
                            <li class="{{ !$all_team_stats_cumplimented ? 'text-pretty-red animate-pulse' : '' }}">Todas las estadísticas de equipo deben ser cumplimentadas.</li>
                            <li class="{{ $visitor_team_stats[0]['zone'] > 200 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 200 puntos de zona al equipo.</li>
                            <li class="{{ $visitor_team_stats[0]['second_oportunity'] > 150 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 150 puntos de segunda oportunidad al equipo.</li>
                            <li class="{{ $visitor_team_stats[0]['substitute'] > 200 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 200 puntos de suplentes al equipo.</li>
                            <li class="{{ $visitor_team_stats[0]['AST'] > 60 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 60 asistencias al equipo.</li>
                            <li class="{{ $total_reb > 150 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 150 rebotes totales al equipo.</li>
                            <li class="{{ $visitor_team_stats[0]['STL'] > 60 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 60 robos al equipo.</li>
                            <li class="{{ $visitor_team_stats[0]['BLK'] > 50 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 50 tapones al equipo.</li>
                            <li class="{{ $visitor_team_stats[0]['LOS'] > 125 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 125 pérdidas al equipo.</li>
                            <li class="{{ $visitor_team_stats[0]['advantage'] > 200 ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 200 puntos de máxima ventaja al equipo.</li>
                        </ul>

                        <p class="pt-2 pl-4 text-sm font-bold">Condiciones en estadísticas de jugadores</p>
                        <ul class="list-disc text-sm py-2 ml-8 text-gray-500 dark:text-gray-300">
                            <li class="{{ $exception_players_stats['all_player_stats_cumplimented'] ? 'text-pretty-red animate-pulse' : '' }}">Todas las estadísticas de jugadores con minutos deben ser cumplimentadas (pueden ser 0).</li>
                            <li class="{{ $headline_counter !=5 ? 'text-pretty-red animate-pulse' : '' }}">Se deben marcar 5 jugadores titulares.</li>
                            <li class="{{ $exception_players_stats['TOTAL_MINS'] ? 'text-pretty-red animate-pulse' : '' }}">Tienen que haber registrados un mínimo de 240 minutos entre todos los jugadores.</li>
                            <li class="{{ $exception_players_stats['PTS'] ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 150 puntos a un jugador.</li>
                            <li class="{{ $exception_players_stats['REB'] ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 75 rebotes a un jugador.</li>
                            <li class="{{ $exception_players_stats['AST'] ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 55 asistencias a un jugador.</li>
                            <li class="{{ $exception_players_stats['STL'] ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 30 robos a un jugador.</li>
                            <li class="{{ $exception_players_stats['BLK'] ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 25 tapones a un jugador.</li>
                            <li class="{{ $exception_players_stats['LOS'] ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 50 pérdidas a un jugador.</li>
                            <li class="{{ $exception_players_stats['FG'] ? 'text-pretty-red animate-pulse' : '' }}">Los tiros de campo anotados no pueden ser superiores a los intentados.</li>
                            <li class="{{ $exception_players_stats['TP'] ? 'text-pretty-red animate-pulse' : '' }}">Los tiros de 3 puntos anotados no pueden ser superiores a los intentados.</li>
                            <li class="{{ $exception_players_stats['FT'] ? 'text-pretty-red animate-pulse' : '' }}">Los tiros libres anotados no pueden ser superiores a los intentados.</li>
                            <li class="{{ $exception_players_stats['SHOOTS_TOTAL'] ? 'text-pretty-red animate-pulse' : '' }}">El total de tiros anotados o intentados de un jugador no pueden ser mayor a 99.</li>
                            <li class="{{ $exception_players_stats['ML'] ? 'text-pretty-red animate-pulse' : '' }}">No se puede registrar más de 150 +/- a un jugador.</li>
                        </ul>
                    </div>
                @endif
            </div>

        </div>

    </div>
@endif