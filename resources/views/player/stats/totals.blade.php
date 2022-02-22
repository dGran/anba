<div class="px-3 sm:px-0 | mt-6">

    <div class="flex items-end justify-between">
        <h4 class="font-bold text-xl">
            Totales
        </h4>
        <div class="flex items-center space-x-3">
            <button class="text-xs uppercase font-bold | text-blue-500 dark:text-dark-link cursor-pointer | transition duration-150 ease-in-out | {{ $statsTotals_phase == 'regular' ? 'opacity-100 pointer-events-none cursor-not-allowed' : 'opacity-50 hover:opacity-75  hover:underline focus:underline' }} focus:outline-none" wire:click="$set('statsTotals_phase', 'regular')">
                regular season
            </button>
            <button class="text-xs uppercase font-bold | text-blue-500 dark:text-dark-link cursor-pointer | transition duration-150 ease-in-out | {{ $statsTotals_phase == 'playoffs' ? 'opacity-100 pointer-events-none cursor-not-allowed' : 'opacity-50 hover:opacity-75  hover:underline focus:underline' }} focus:outline-none" wire:click="$set('statsTotals_phase', 'playoffs')">
                playoffs
            </button>
        </div>
    </div>

    <div class="pt-3">
        @if ($statsTotals->count() > 0)
            <div class="bg-white dark:bg-gray-750 overflow-x-auto md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
                <table class="summary-player-stats font-roboto">
                    <thead>
                        <tr class="text-gray-600 bg-gray-200 dark:bg-gray-700 dark:text-gray-100 select-none">
                            <th class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'seasons.name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'seasons.name' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'seasons.name' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('seasons.name')"
                            style="width: 6.25rem; min-width: 6.25rem; max-width: 6.25rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                                Temporada
                            </th>
                            <th class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'team_name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'team_name' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'team_name' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('team_name')"
                            style="left: 6.25rem; position: sticky; position: -webkit-sticky; text-align: left;">
                                Equipo
                            </th>
                            <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'AGE' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'AGE' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'AGE' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('AGE')"
                            style="min-width: 3rem">
                                Edad
                            </th>
                            <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'PJ' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'PJ' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'PJ' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('PJ')">
                                PJ
                            </th>
                            <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'PT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'PT' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'PT' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('PT')">
                                PT
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_MIN' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_MIN' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_MIN' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('MIN')">
                                MIN
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_PTS' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_PTS' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('PTS')">
                                PTS
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_FGM' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_FGM' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('FGM')">
                                FGM
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_FGA' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_FGA' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('FGA')">
                                FGA
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'PER_FG' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'PER_FG' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'PER_FG' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('PER_FG')">
                                FG%
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_TPM' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_TPM' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('TPM')">
                                3PM
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_TPA' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_TPA' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('TPA')">
                                3PA
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'PER_TP' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'PER_TP' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'PER_TP' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('PER_TP')">
                                3P%
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_FTM' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_FTM' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('FTM')">
                                TLM
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_FTA' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_FTA' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('FTA')">
                                TLA
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'PER_FT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'PER_FT' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'PER_FT' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('PER_FT')">
                                TL%
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_ORB' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_ORB' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('ORB')">
                                R.O
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_DRB' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_DRB' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('DRB')">
                                R.D
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_REB' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_REB' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('REB')">
                                REB
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_AST' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_AST' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('AST')">
                                AST
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_STL' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_STL' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('STL')">
                                ROB
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_LOS' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_LOS' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('LOS')">
                                PER
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_BLK' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_BLK' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('BLK')">
                                TAP
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_PF' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_PF' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('PF')">
                                FP
                            </th>
                            <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                            {{ $statsTotals_order == 'SUM_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                            {{ $statsTotals_order == 'SUM_ML' && $statsTotals_order_direction == 'desc' ? 'sorted-desc' : '' }}
                            {{ $statsTotals_order == 'SUM_ML' && $statsTotals_order_direction == 'asc' ? 'sorted-asc' : '' }}"
                            wire:click="statsTotals_change_order('ML')">
                                +/-
                            </th>
                        </tr>
                    </thead>
                    <tbody wire:loading.class="opacity-75">
                        @foreach ($statsTotals as $key=>$stat)
                            <tr class="group hover:bg-gray-100 dark:hover:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                                <td class="{{ $statsTotals_order == 'player_name' ? 'bg-gray-150 dark:bg-gray-650' : 'bg-white dark:bg-gray-750 group-hover:bg-gray-100 dark:group-hover:bg-gray-700' }}"
                                    style="width: 6.25rem; min-width: 6.25rem; max-width: 6.25rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                                    {{ $stat->season->name }}
                                </td>
                                <td class="py-1.5 {{ $statsTotals_order == 'team_name' ? 'bg-gray-150 dark:bg-gray-650' : 'bg-white dark:bg-gray-750 group-hover:bg-gray-100 dark:group-hover:bg-gray-700' }}"
                                    style="left: 6.25rem; position: sticky; position: -webkit-sticky; text-align: left;">
                                        {{ $stat->seasonTeam->team->short_name }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'AGE' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ $stat->AGE ?: 'N/D' }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'PJ' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PJ, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'PT' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PT, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_MIN' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_MIN, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_PTS' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_PTS, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_FGM' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_FGM, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_FGA' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_FGA, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'PER_FG' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PER_FG, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_TPM' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_TPM, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_TPA' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_TPA, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'PER_TP' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PER_TP, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_FTM' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_FTM, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_FTA' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_FTA, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'PER_FT' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->PER_FT, 1, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_ORB' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_ORB, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_DRB' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_DRB, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_REB' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_REB, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_AST' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_AST, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_STL' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_STL, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_LOS' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_LOS, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_BLK' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_BLK, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_PF' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_PF, 0, ',', '.') }}
                                </td>
                                <td class="text-right {{ $statsTotals_order == 'SUM_ML' ? 'bg-gray-150 dark:bg-gray-650' : '' }}">
                                    {{ number_format($stat->SUM_ML, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach

                        {{-- carrer totals --}}
                        @foreach ($statsTotals_totals as $key=>$stat)
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
                                <td class="text-right">{{ number_format($stat->SUM_MIN, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_PTS, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_FGM, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_FGA, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_FG, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_TPM, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_TPA, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_TP, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_FTM, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_FTA, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_FT, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_ORB, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_DRB, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_REB, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_AST, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_STL, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_LOS, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_BLK, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_PF, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_ML, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach

                        {{-- by team totals --}}
                        @foreach ($statsTotals_team_totals as $key=>$stat)
                            <tr class="border-t border-gray-300 dark:border-gray-650 | bg-gray-200 dark:bg-gray-700 | font-bold">
                                <td class="bg-gray-200 dark:bg-gray-700" style="width: 6.25rem; min-width: 6.25rem; max-width: 6.25rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                                </td>
                                <td class="py-1.5 | bg-gray-200 dark:bg-gray-700" style="left: 6.25rem; position: sticky; position: -webkit-sticky; text-align: left;">
                                    {{ $stat->team_name }}
                                </td>
                                <td class="text-right"></td>
                                <td class="text-right">{{ number_format($stat->PJ, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PT, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_MIN, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_PTS, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_FGM, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_FGA, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_FG, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_TPM, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_TPA, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_TP, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_FTM, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_FTA, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->PER_FT, 1, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_ORB, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_DRB, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_REB, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_AST, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_STL, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_LOS, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_BLK, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_PF, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($stat->SUM_ML, 0, ',', '.') }}</td>
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
