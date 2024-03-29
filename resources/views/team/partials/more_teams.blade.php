<div class="flex items-center justify-between space-x-2 | mb-2 md:mb-4 mx-3 sm:mx-0 | overflow-x-auto | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-transparent hover:scrollbar-thumb-gray-300 | dark:hover:scrollbar-thumb-gray-500">
    @foreach ($more_teams as $sTeam)
        <a class="cursor-pointer border border-transparent rounded | p-0.5 | flex flex-col text-xxs md:text-xs text-center | select-none | focus:outline-none hover:underline focus:underline | leading-5 {{ $sTeam->id == $season_team->id ? 'bg-white dark:bg-gray-750 border-gray-200 dark:border-gray-700' : '' }}" wire:click="change_team({{ $sTeam->id }})">
            <img src="{{ $sTeam->team->getImg() }}" alt="" class="w-6 h-6 md:w-8 md:h-8 object-cover" style="min-width: 1.5rem;">
            <p>
                {{ $sTeam->team->short_name }}
            </p>
        </a>
    @endforeach
</div>
