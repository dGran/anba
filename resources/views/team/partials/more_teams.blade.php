<div class="flex items-center justify-between space-x-2 | mb-2 md:mb-4 mx-3 sm:mx-0 | overflow-x-auto">
    @foreach ($more_teams as $sTeam)
        <a href="{{ route($route, $sTeam->team->slug) }}" class="border border-transparent rounded | p-0.5 | flex flex-col text-xxs md:text-xs text-center | select-none | focus:outline-none hover:underline focus:underline | leading-6 sm:leading-5 {{ $sTeam->id == $season_team->id ? 'bg-white dark:bg-gray-750 border-gray-200 dark:border-gray-700' : '' }}">
            <img src="{{ $sTeam->team->getImg() }}" alt="" class="w-6 h-6 md:w-8 md:h-8 object-cover" style="min-width: 1.5rem;">
            <p>
                {{ $sTeam->team->short_name }}
            </p>
        </a>
    @endforeach
</div>
