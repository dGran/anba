<div class="flex items-center justify-between space-x-2 | mb-2 md:mb-4 mx-3 sm:mx-0 | overflow-x-auto">
    @foreach ($currentSeason->teams as $seasonTeam)
        <a href="{{ route($route, $seasonTeam->team->slug) }}" class="{{ $seasonTeam->team->id == $team->id ? 'hidden' : '' }} flex flex-col text-xxs md:text-xs text-center | select-none | focus:outline-none hover:underline focus:underline | leading-6 sm:leading-5">
            <img src="{{ $seasonTeam->team->getImg() }}" alt="" class="w-6 h-6 md:w-8 md:h-8 object-cover" style="min-width: 1.5rem;">
            <p>
                {{ $seasonTeam->team->short_name }}
            </p>
        </a>
    @endforeach
</div>
