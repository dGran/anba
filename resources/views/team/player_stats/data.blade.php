<div class="flex flex-col md:flex-row items-center select-none pb-4">
    <div class="flex-1 w-full flex flex-col relative">
        <label for="season" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Temporada
        </label>
        <select id="season" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="season" wire:change="change_season">
            @foreach ($seasons as $seas)
                <option value="{{ $seas->slug }}">{{ $seas->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
        <label for="phase" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Fase
        </label>
        <select id="phase" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="phase">
            <option value="regular">Liga regular</option>
            <option value="playoffs">Playoffs</option>
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
        <label for="mode" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Modo
        </label>
        <select id="mode" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="mode" wire:change="change_mode">
            <option value="per_game">Por partido</option>
            <option value="totals">Totales</option>
        </select>
    </div>
</div>

{{-- <h4 class="px-3 sm:px-0 uppercase font-normal font-roboto text-base pb-2">
    {{ $season }} player statistics
</h4> --}}

@if ($season)
    @if (count($players_stats) > 0)
        <div class="bg-white dark:bg-gray-750 overflow-x-auto md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
            <table class="team-players-stats font-roboto">
                <thead>
                    <tr class="text-gray-600 bg-gray-150 dark:bg-gray-700 dark:text-gray-100 select-none">
                        <th class="bg-gray-150 dark:bg-gray-700 hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $order == 'player_name' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $order == 'player_name' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $order == 'player_name' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('player_name')"
                        style="width: 14rem; min-width: 14rem; max-width: 14rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                            Jugador
                        </th>
                        <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $order == 'AGE' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $order == 'AGE' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $order == 'AGE' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('AGE')"
                        style="min-width: 3rem">
                            Edad
                        </th>
                        <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $order == 'PJ' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $order == 'PJ' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $order == 'PJ' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('PJ')">
                            PJ
                        </th>
                        <th class="w-12 text-right hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $order == 'PT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $order == 'PT' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $order == 'PT' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('PT')">
                            PT
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_MIN' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_MIN' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_MIN' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_MIN' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_MIN' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_MIN' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('MIN')">
                            MIN
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_PTS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_PTS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_PTS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_PTS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_PTS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('PTS')">
                            PTS
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_FGM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_FGM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FGM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FGM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FGM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('FGM')">
                            FGM
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_FGA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_FGA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FGA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FGA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FGA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('FGA')">
                            FGA
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $order == 'PER_FG' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $order == 'PER_FG' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $order == 'PER_FG' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('PER_FG')">
                            FG%
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_TPM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_TPM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_TPM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_TPM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_TPM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('TPM')">
                            3PM
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_TPA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_TPA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_TPA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_TPA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_TPA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('TPA')">
                            3PA
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $order == 'PER_TP' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $order == 'PER_TP' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $order == 'PER_TP' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('PER_TP')">
                            3P%
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_FTM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_FTM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FTM' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FTM' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FTM' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('FTM')">
                            TLM
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_FTA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_FTA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FTA' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FTA' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_FTA' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('FTA')">
                            TLA
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $order == 'PER_FT' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $order == 'PER_FT' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $order == 'PER_FT' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('PER_FT')">
                            TL%
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_ORB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_ORB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_ORB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_ORB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_ORB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('ORB')">
                            R.O
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_DRB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_DRB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_DRB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_DRB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_DRB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('DRB')">
                            R.D
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_REB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_REB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_REB' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_REB' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_REB' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('REB')">
                            REB
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_AST' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_AST' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_AST' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_AST' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_AST' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('AST')">
                            AST
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_STL' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_STL' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_STL' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_STL' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_STL' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('STL')">
                            ROB
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_LOS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_LOS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_LOS' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_LOS' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_LOS' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('LOS')">
                            PER
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_BLK' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_BLK' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_BLK' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_BLK' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_BLK' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('BLK')">
                            TAP
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_PF' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_PF' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_PF' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_PF' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_PF' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('PF')">
                            FP
                        </th>
                        <th class="hover:bg-gray-800 hover:text-white dark:hover:bg-gray-650 cursor-pointer
                        {{ $mode == 'per_game' && $order == 'AVG_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_ML' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'per_game' && $order == 'AVG_ML' && $order_direction == 'asc' ? 'sorted-asc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_ML' ? 'bg-gray-800 text-white dark:bg-gray-650' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_ML' && $order_direction == 'desc' ? 'sorted-desc' : '' }}
                        {{ $mode == 'totals' && $order == 'SUM_ML' && $order_direction == 'asc' ? 'sorted-asc' : '' }}"
                        wire:click="change_order('ML')">
                            +/-
                        </th>
                    </tr>
                </thead>
                <tbody wire:loading.class="opacity-50">
                    @foreach ($players_stats as $key=>$stat)
                        <tr class="group hover:bg-gray-150 dark:hover:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                            <td class="w-56 truncate {{ $order == 'player_name' ? 'bg-gray-100 dark:bg-gray-650' : 'bg-white dark:bg-gray-750 group-hover:bg-gray-150 dark:group-hover:bg-gray-700' }}" style="width: 14rem; min-width: 14rem; max-width: 14rem; left: 0px; position: sticky; position: -webkit-sticky; text-align: left;">
                                <div class="flex items-center truncate">
                                    <img src="{{ $stat->player->getImg() }}" alt="" class="h-9 w-auto object-cover mt-2">
                                    <p class="pl-2 truncate w-56 | flex flex-col">
                                        <span class="truncate font-semibold | cursor-pointer | hover:underline focus:underline" wire:click="openPlayerInfo({{ $stat->player->id }})">
                                            {{ $stat->player_name }}
                                        </span>
                                        <span class="text-xs uppercase">{{ $stat->player->position ?: 'N/D' }}</span>
                                    </p>
                                </div>
                            </td>
                            <td class="text-right {{ $order == 'AGE' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                {{ $stat->AGE ?: 'N/D' }}
                            </td>
                            <td class="text-right {{ $order == 'PJ' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                {{ number_format($stat->PJ, 0, ',', '.') }}
                            </td>
                            <td class="text-right {{ $order == 'PT' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                {{ number_format($stat->PT, 0, ',', '.') }}
                            </td>
                            <td class="text-right {{ $order == 'AVG_MIN' || $order == 'SUM_MIN' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_MIN, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_MIN, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_PTS' || $order == 'SUM_PTS' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_PTS, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_PTS, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_FGM' || $order == 'SUM_FGM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_FGM, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_FGM, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_FGA' || $order == 'SUM_FGA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_FGA, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_FGA, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'PER_FG' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                {{ number_format($stat->PER_FG, 1, ',', '.') }}
                            </td>
                            <td class="text-right {{ $order == 'AVG_TPM' || $order == 'SUM_TPM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_TPM, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_TPM, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_TPA' || $order == 'SUM_TPA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_TPA, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_TPA, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'PER_TP' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                {{ number_format($stat->PER_TP, 1, ',', '.') }}
                            </td>
                            <td class="text-right {{ $order == 'AVG_FTM' || $order == 'SUM_FTM' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_FTM, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_FTM, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_FTA' || $order == 'SUM_FTA' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_FTA, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_FTA, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'PER_FT' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                {{ number_format($stat->PER_FT, 1, ',', '.') }}
                            </td>
                            <td class="text-right {{ $order == 'AVG_ORB' || $order == 'SUM_ORB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_ORB, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_ORB, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_DRB' || $order == 'SUM_DRB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_DRB, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_DRB, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_REB' || $order == 'SUM_REB' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_REB, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_REB, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_AST' || $order == 'SUM_AST' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_AST, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_AST, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_STL' || $order == 'SUM_STL' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_STL, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_STL, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_LOS' || $order == 'SUM_LOS' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_LOS, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_LOS, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_BLK' || $order == 'SUM_BLK' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_BLK, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_BLK, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_PF' || $order == 'SUM_PF' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_PF, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_PF, 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-right {{ $order == 'AVG_ML' || $order == 'SUM_ML' ? 'bg-gray-100 dark:bg-gray-650' : '' }}">
                                @if ($mode == 'per_game')
                                    {{ number_format($stat->AVG_ML, 1, ',', '.') }}
                                @else
                                    {{ number_format($stat->SUM_ML, 0, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
            <p class="px-4 py-8 text-xl md:text-3xl text-center">
                No hay estadísticas disponibles para los filtros seleccionados.
            </p>
        </div>
    @endif
@else
    <div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-sm md:rounded-md md:mx-0 text-gray-900 dark:text-gray-200 border border-gray-200 dark:border-gray-850">
        <p class="px-4 py-2 text-2xl">
            Temporada no encontrada
        </p>
    </div>
@endif
