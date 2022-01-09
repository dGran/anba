<div>
    <p>
        <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">Temporadas</span>
        <span>{{ $team_seasons->count() }}</span>
        <span class="text-xs md:text-sm ml-1.5">({{ $team_seasons->first()->season->name }} to {{ $team_seasons->last()->season->name }})</span>
    </p>
    <p>
        <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">record</span>
        <span>{{ $team_all_seasons_record['w'] }}-{{ $team_all_seasons_record['l'] }}</span>
        <span class="text-xs md:text-sm ml-1.5">({{ number_format($team_all_seasons_record_percent, 2, ',', '.') }}% G-P)</span>
    </p>
    <p>
        <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">apariciones en playoffs</span>
        <span>{{ $season_team->team->get_playoffs_apparences() }}</span>
    </p>
    <p>
        <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">campeonatos</span>
        <span>{{ $season_team->team->get_championships() }}</span>
    </p>
    <p class="pt-4">
        <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">Conferencia</span>
        <span>{{ $season_team->seasonDivision->seasonConference->conference->name }}</span>
    </p>
    <p>
        <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">Division</span>
        <span>{{ $season_team->seasonDivision->division->name }}</span>
    </p>
    <p>
        <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">manager</span>
        <a href="#" class="hover:underline focus:underline focus:outline-none">{{ $season_team->team->user->name }}</a>
    </p>
    <p>
        <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">Estadio</span>
        <span>{{ $season_team->team->stadium }}</span>
    </p>
</div>
<img src="https://ak.picdn.net/shutterstock/videos/18325363/thumb/1.jpg" alt="" class="w-full h-auto md:w-96 md:h-60 object-cover rounded | pt-6 lg:pt-0">
