<div class="flex items-center justify-between space-x-2 | mt-10 pt-4 px-3 sm:px-0 | overflow-x-auto">
    @foreach ($currentSeason->teams as $seasonTeam)
        <a href="{{ route($route, $seasonTeam->team->slug) }}" class="{{ $seasonTeam->team->id == $team->id ? 'hidden' : '' }} flex flex-col text-xs text-center | select-none | focus:outline-none hover:underline focus:underline">
            <img src="{{ $seasonTeam->team->getImg() }}" alt="" class="w-8 h-8 object-cover" style="min-width: 2rem;">
            <p>
                {{ $seasonTeam->team->short_name }}
            </p>
        </a>
    @endforeach
</div>
