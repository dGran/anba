<div>
    <h4 class="text-lg font-semibold pt-4 pb-2 | border-t border-gray-200 dark:border-gray-700 | flex flex-col">
        <span>Partidos disponibles ({{ $matches->count() }})</span>
        <span class="text-sm text-gray-400">{{ $filterTeam ? $filterTeamName : 'Todos los equipos' }}</span>
    </h4>
    @if ($filterTeam)
        <div class="flex items-center | text-blue-500 dark:text-dark-link | mt-4">
            <i class="fas fa-caret-right text-xl mr-1.5"></i>
            <h4 class="text-base font-semibold mb-1">Partido prioritario</h4>
        </div>
        @if ($priorityMatch)
            <div class="bg-white dark:bg-gray-750 | border border-gray-200 dark:border-gray-700 rounded | py-1.5 mb-4 | hover:border-blue-400 | select-none">
                <a href="{{ route('match', $priorityMatch->id) }}">
                    <div class="px-4">
                        <div class="flex items-center | w-full">
                            <div class="flex-1 flex items-center justify-end">
                                <div class="flex flex-col items-end">
                                    <span>{{ $priorityMatch->localTeam->team->medium_name }}</span>
                                    <span class="text-xs text-gray-400">{{ $priorityMatch->localTeam->team->user->name }}</span>
                                </div>
                                <img src="{{ $priorityMatch->localTeam->team->getImg() }}" alt="{{ $priorityMatch->localTeam->team->medium_name }}" class="w-12 h-12 object-cover | ml-1.5">
                            </div>
                            <div class="flex-0 w-12 text-center | flex flex-col">
                                <span class="text-2xl font-bold">Vs</span>
                                <span class="text-xxs">ID: {{ $priorityMatch->id }}</span>
                            </div>
                            <div class="flex-1 flex items-center justify-start">
                                <img src="{{ $priorityMatch->visitorTeam->team->getImg() }}" alt="{{ $priorityMatch->visitorTeam->team->medium_name }}" class="w-12 h-12 object-cover | mr-1.5">
                                <div class="flex flex-col items-start">
                                    <span>{{ $priorityMatch->visitorTeam->team->medium_name }}</span>
                                    <span class="text-xs text-gray-400">{{ $priorityMatch->visitorTeam->team->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex justify-center | mb-4">
                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 leading-6 | flex items-center" wire:click="priorityMatchNotification({{ $priorityMatch->id }})">
                    <i class="fab fa-discord text-lg mr-1.5"></i>
                    <span class="">Notificar por discord</span>
                </x-buttons.primary>
            </div>
        @else
            <div class="bg-white dark:bg-gray-750 | border border-gray-200 dark:border-gray-700 | p-4 mb-4 | text-center | text-sm">No se ha encontrado el partido prioritario...</div>
        @endif
    @endif

    @if ($filterTeam)
        <div class="flex items-center">
            <i class="fas fa-caret-right text-xl mr-1.5"></i>
            <h4 class="text-base font-semibold mb-1">Resto de partidos</h4>
        </div>
    @endif
    @if ($matches->count() > 0)
        <ul class="text-sm | space-y-2.5">
            @foreach ($matches as $match)
                @if (!$priorityMatch || $priorityMatch->id != $match->id)
                    <li class="bg-white dark:bg-gray-750 | border border-gray-200 dark:border-gray-700 rounded | py-1.5 | hover:border-blue-400 dark:hover:border-dark-link | select-none">
                       <a href="{{ route('match', $match->id) }}">
                            <div class="px-4">
                                <div class="flex items-center | w-full">
                                    <div class="flex-1 flex items-center justify-end">
                                        <div class="flex flex-col items-end">
                                            <span>{{ $match->localTeam->team->medium_name }}</span>
                                            <span class="text-xs text-gray-400">{{ $match->localTeam->team->user->name }}</span>
                                        </div>
                                        <img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->medium_name }}" class="w-12 h-12 object-cover | ml-1.5">
                                    </div>
                                    <div class="flex-0 w-12 text-center | flex flex-col">
                                        <span class="text-2xl font-bold">Vs</span>
                                        <span class="text-xxs">ID: {{ $match->id }}</span>
                                    </div>
                                    <div class="flex-1 flex items-center justify-start">
                                        <img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->medium_name }}" class="w-12 h-12 object-cover | mr-1.5">
                                        <div class="flex flex-col items-start">
                                            <span>{{ $match->visitorTeam->team->medium_name }}</span>
                                            <span class="text-xs text-gray-400">{{ $match->visitorTeam->team->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    @else
        <div class="bg-white dark:bg-gray-750 | border border-gray-200 dark:border-gray-700 | p-4 | text-center | text-sm">No hay partidos disponibles...</div>
    @endif
</div>
