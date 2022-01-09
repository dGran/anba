<table class="">
    <thead class="border-l border-t border-b border-gray-200 dark:border-gray-700 | uppercase text-sm tracking-wider font-medium">
        <th class="px-2 py-0.5 border-r border-gray-200 dark:border-gray-700 text-left">Temporada</th>
        <th class="px-2 py-0.5 border-r border-gray-200 dark:border-gray-700 text-left">Liga</th>
        <th class="px-2 py-0.5 border-r border-gray-200 dark:border-gray-700 text-left">Equipo</th>
        <th class="px-2 py-0.5 w-8 border-r border-gray-200 dark:border-gray-700 text-center">G</th>
        <th class="px-2 py-0.5 w-8 border-r border-gray-200 dark:border-gray-700 text-center">P</th>
        <th class="px-2 py-0.5 w-12 border-r border-gray-200 dark:border-gray-700 text-center">G/P%</th>
    </thead>
    <tbody class="text-sm | border-l border-b border-gray-200 dark:border-gray-700">
        @foreach ($team_seasons->sortByDesc('season_name') as $ts)
            <tr>
                @php
                    $season_team_record = $season_team->team->get_season_team_record($ts->season->id);
                    $season_team_matches = $season_team->team->get_season_team_matches($ts->season->id)->count();
                @endphp
                <td class="px-2 py-0.5 border-r border-gray-200 dark:border-gray-700 text-left">
                    <x-link href="#" class="hover:underline focus:underline">{{ $ts->season->name }}</x-link>
                </td>
                <td class="px-2 py-0.5 border-r border-gray-200 dark:border-gray-700 text-left"><x-link href="#" class="hover:underline focus:underline">ANBA</x-link></td>
                <td class="px-2 py-0.5 border-r border-gray-200 dark:border-gray-700 text-left"><x-link href="#" class="hover:underline focus:underline">{{ $season_team->team->name }}</x-link></td>
                <td class="px-2 py-0.5 w-8 border-r border-gray-200 dark:border-gray-700 text-center">
                    {{ $season_team_record['w'] }}
                </td>
                <td class="px-2 py-0.5 w-8 border-r border-gray-200 dark:border-gray-700 text-center">
                    {{ $season_team_record['l'] }}
                </td>
                <td class="px-2 py-0.5 w-12 border-r border-gray-200 dark:border-gray-700 text-center">
                    {{ number_format(($season_team_record['w'] / $season_team_matches) * 100, 2, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
