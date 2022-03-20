<div>
    <h4 class="text-lg font-semibold mb-2.5">Managers conectados ({{ $seasonTeams->count() }})</h4>
    @if ($seasonTeams->count()>0)
        <ul class="text-sm | grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($seasonTeams as $seasonTeam)
                <li class="flex flex-col justify-center items-center | border rounded | py-1.5 | bg-white dark:bg-gray-750 | {{ $filterTeam == $seasonTeam->id ? 'border-blue-400 dark:border-dark-link | hover:border-blue-400 dark:hover:border-dark-link' : 'border-gray-200 dark:border-gray-700 | hover:border-gray-300 dark:hover:border-gray-600' }} select-none | cursor-pointer" wire:click="setFilterTeam({{ $seasonTeam->id }})">
                    <img src="{{ $seasonTeam->team->getImg() }}" alt="" class="w-16 mx-auto">
                    <p>{{ $seasonTeam->team->medium_name }}</p>
                    <p class="text-xs text-gray-400 dark:text-gray-300">{{ $seasonTeam->team->user->name }}</p>
                    <p class="text-xs font-semibold | py-1" wire:poll.1000ms>
                        expira
                        {{ Carbon\Carbon::parse($seasonTeam->team->user['ready_to_play'])->diffForHumans() }}
                    </p>
                </li>
            @endforeach
        </ul>
    @else
        <div class="bg-white dark:bg-gray-750 | border border-gray-200 dark:border-gray-700 | p-4 | text-center | text-sm">No hay managers conectados...</div>
    @endif

    <div class="flex items-center space-x-2 | pt-3 pb-1.5 | overflow-x-auto | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-transparent hover:scrollbar-thumb-gray-300 | dark:hover:scrollbar-thumb-gray-500">
        @foreach ($currentSeason->teams as $seasonTeam)
            <div class="flex flex-col text-xs text-center | select-none">
                <img src="{{ $seasonTeam->team->getImg() }}" alt="" class="w-8 h-8 object-cover" style="{{ !$seasonTeam->team->user->readyToPlay() ? 'opacity: .30;' : 'opacity: 1' }} min-width: 2rem;">
                <p class="{{ !$seasonTeam->team->user->readyToPlay() ? '' : 'border-b-2 border-blue-300' }}" style="{{ !$seasonTeam->team->user->readyToPlay() ? 'opacity: .30;' : 'opacity: 1' }}">
                    {{ $seasonTeam->team->short_name }}
                </p>
            </div>
        @endforeach
    </div>
</div>
