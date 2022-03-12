<div class="px-3 sm:px-0">

    <div class="flex items-end justify-between">
        <h4 class="font-bold text-xl">
            Por partido
        </h4>
        <div class="flex items-center space-x-3">
            <button class="text-xs uppercase font-bold | text-blue-500 dark:text-dark-link cursor-pointer | transition duration-150 ease-in-out | {{ $statsPerGame_phase == 'regular' ? 'opacity-100 pointer-events-none cursor-not-allowed' : 'opacity-50 hover:opacity-75  hover:underline focus:underline' }} focus:outline-none" wire:click="$set('statsPerGame_phase', 'regular')">
                regular season
            </button>
            <button class="text-xs uppercase font-bold | text-blue-500 dark:text-dark-link cursor-pointer | transition duration-150 ease-in-out | {{ $statsPerGame_phase == 'playoffs' ? 'opacity-100 pointer-events-none cursor-not-allowed' : 'opacity-50 hover:opacity-75  hover:underline focus:underline' }} focus:outline-none" wire:click="$set('statsPerGame_phase', 'playoffs')">
                playoffs
            </button>
        </div>
    </div>

    <div class="pt-3">
        @if ($statsPerGame->count() > 0)
            <div class="bg-white dark:bg-gray-750 overflow-x-auto md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
                <table class="summary-player-stats font-roboto">
                    <thead>
                        <tr class="text-gray-600 bg-gray-200 dark:bg-gray-700 dark:text-gray-100 select-none">
                            <th class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'seasons.name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'seasons.name' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'seasons.name' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('seasons.name')"
                            style="width: 6.25rem; min-width: 6.25rem; max-width: 6.25rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                                Temporada
                            </th>
                            <th class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'team_name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'team_name' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'team_name' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('team_name')"
                            style="left: 6.25rem; position: sticky; position: -webkit-sticky; text-align: left;">
                                Equipo
                            </th>
                            <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AGE' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AGE' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AGE' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('AGE')"
                            style="min-width: 3rem">
                                Edad
                            </th>
                            <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'PJ' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'PJ' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'PJ' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('PJ')">
                                PJ
                            </th>
                            <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'PT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'PT' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'PT' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('PT')">
                                PT
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_MIN' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_MIN' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_MIN' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('MIN')">
                                MIN
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_PTS' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_PTS' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('PTS')">
                                PTS
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_FGM' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_FGM' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('FGM')">
                                FGM
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_FGA' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_FGA' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('FGA')">
                                FGA
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'PER_FG' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'PER_FG' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'PER_FG' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('PER_FG')">
                                FG%
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_TPM' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_TPM' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('TPM')">
                                3PM
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_TPA' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_TPA' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('TPA')">
                                3PA
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'PER_TP' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'PER_TP' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'PER_TP' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('PER_TP')">
                                3P%
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_FTM' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_FTM' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('FTM')">
                                TLM
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_FTA' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_FTA' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('FTA')">
                                TLA
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'PER_FT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'PER_FT' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'PER_FT' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('PER_FT')">
                                TL%
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_ORB' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_ORB' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('ORB')">
                                R.O
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_DRB' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_DRB' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('DRB')">
                                R.D
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_REB' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_REB' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('REB')">
                                REB
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_AST' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_AST' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('AST')">
                                AST
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_STL' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_STL' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('STL')">
                                ROB
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_LOS' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_LOS' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('LOS')">
                                PER
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_BLK' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_BLK' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('BLK')">
                                TAP
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_PF' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_PF' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('PF')">
                                FP
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsPerGame_order == 'AVG_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsPerGame_order == 'AVG_ML' && $statsPerGame_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsPerGame_order == 'AVG_ML' && $statsPerGame_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsPerGame_change_order('ML')">
                                +/-
                            </th>
                        </tr>
                    </thead>
                    <tbody wire:loading.class="opacity-75">
                        @foreach ($statsPerGame as $key=>$stat)
                            <tr class="group hover:bg-gray-100 dark:hover:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                                <td class="{{ $statsPerGame_order == 'player_name' ? 'bg-gray-150 dark:bg-gray-650' : 'bg-white dark:bg-gray-750 group-hover:bg-gray-100 dark:group-hover:bg-gray-700' }}"
                                    style="width: 6.25rem; min-width: 6.25rem; max-width: 6.25rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                                    {{ $stat->season->name }}
                                </td>
                                <td class="py-1.5 {{ $statsPerGame_order == 'team_name' ? 'bg-gray-150 dark:bg-gray-650' : 'bg-white dark:bg-gray-750 group-hover:bg-gray-100 dark:group-hover:bg-gray-700' }}"
                                    style="left: 6.25rem; position: sticky; position: -webkit-sticky; text-align: left;">
                                        {{ $stat->seasonTeam->team->short_name }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AGE' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ $stat->AGE ?: 'N/D' }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'PJ' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PJ, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'PT' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PT, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_MIN' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_MIN, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_PTS' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_PTS, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_FGM' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_FGM, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_FGA' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_FGA, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'PER_FG' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PER_FG, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_TPM' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_TPM, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_TPA' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_TPA, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'PER_TP' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PER_TP, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_FTM' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_FTM, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_FTA' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_FTA, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'PER_FT' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PER_FT, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_ORB' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_ORB, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_DRB' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_DRB, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_REB' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_REB, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_AST' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_AST, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_STL' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_STL, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_LOS' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_LOS, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_BLK' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_BLK, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_PF' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_PF, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsPerGame_order == 'AVG_ML' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->AVG_ML, 1, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach

                        {{-- carrer totals --}}
                        @foreach ($statsPerGame_totals as $key=>$stat)
                            <tr class="border-t border-gray-300 dark:border-gray-650 | bg-gray-200 dark:bg-gray-700 | font-bold">
                                <td class="bg-gray-200 dark:bg-gray-700"
                                    style="width: 6.25rem; min-width: 6.25rem; max-width: 6.25rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                                    <div class="border-r border-gray-200 dark:border-gray-700 py-1.5 -mr-2">
                                        Carrera
                                    </div>
                                </td>
                                <td class="bg-gray-200 dark:bg-gray-700" style="left: 6.25rem; position: sticky; position: -webkit-sticky; text-align: left;">
                                </td>
                                <td></td>
                                <td class="text-right">{{ number_format($stat->PJ, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PT, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_MIN, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_PTS, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_FGM, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_FGA, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_FG, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_TPM, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_TPA, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_TP, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_FTM, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_FTA, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_FT, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_ORB, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_DRB, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_REB, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_AST, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_STL, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_LOS, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_BLK, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_PF, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_ML, 1, ',', '.') }}</td>
                            </tr>
                        @endforeach

                        {{-- by team totals --}}
                        @foreach ($statsPerGame_team_totals as $key=>$stat)
                            <tr class="border-t border-gray-300 dark:border-gray-650 | bg-gray-200 dark:bg-gray-700 | font-bold">
                                <td class="bg-gray-200 dark:bg-gray-700" style="width: 6.25rem; min-width: 6.25rem; max-width: 6.25rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                                </td>
                                <td class="py-1.5 | bg-gray-200 dark:bg-gray-700" style="left: 6.25rem; position: sticky; position: -webkit-sticky; text-align: left;">
                                    {{ $stat->team_name }}
                                </td>
                                <td class="text-right"></td>
                                <td class="text-right">{{ number_format($stat->PJ, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PT, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_MIN, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_PTS, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_FGM, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_FGA, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_FG, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_TPM, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_TPA, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_TP, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_FTM, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_FTA, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_FT, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_ORB, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_DRB, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_REB, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_AST, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_STL, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_LOS, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_BLK, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_PF, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->AVG_ML, 1, ',', '.') }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
                <p class="px-4 py-8 text-lg md:text-2xl text-center">
                    No hay estadísticas disponibles.
                </p>
            </div>
        @endif
    </div>

</div>
