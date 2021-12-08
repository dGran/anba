<div>
    <h4 class="text-lg font-semibold py-4 | border-t border-gray-200 dark:border-gray-700 | flex flex-col">
        <span>Partidos disponibles ({{ $matches->count() }})</span>
        <span class="text-sm text-gray-400">{{ $filterTeam ? $filterTeamName : 'Todos los equipos' }}</span>
    </h4>

    @if ($matches->count() > 0)
        <ul class="space-y-2.5">
            @foreach ($matches as $match)
                <li>
                    @if ($priorityMatch && $priorityMatch->id == $match->id)
                        <div class="flex items-center | text-blue-500 dark:text-dark-link">
                            <i class="fas fa-caret-right text-xl mr-1.5"></i>
                            <h4 class="text-base font-semibold mb-1">Partido prioritario</h4>
                        </div>
                    @endif
                    <a href="{{ route('match', $match->id) }}" class="block bg-white dark:bg-gray-750 | border rounded | py-1.5 mb-2 | select-none {{ $priorityMatch && $priorityMatch->id == $match->id ? 'border-blue-400 dark:border-dark-link | hover:border-blue-500 dark:hover:border-blue-300 | focus:border-blue-500 dark:focus:border-blue-300' : 'border-gray-200 dark:border-gray-700 | hover:border-gray-300 dark:hover:border-gray-600 | focus:border-gray-300 dark:focus:border-gray-600' }} focus:outline-none">
                        <div class="px-4">
                            <div class="flex items-center | w-full">
                                <div class="flex-1 flex items-center justify-end">
                                    <div class="flex flex-col items-end">
                                        <span class="hidden sm:block">{{ $match->localTeam->team->medium_name }}</span>
                                        <span class="sm:hidden">{{ $match->localTeam->team->short_name }}</span>
                                        <span class="hidden sm:block text-xs text-gray-400">{{ $match->localTeam->team->user->name }}</span>
                                    </div>
                                    <img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->medium_name }}" class="w-10 w-10 sm:w-12 sm:h-12 object-cover | mx-3">
                                </div>

                                <div class="flex-0 w-12 text-center | flex flex-col">
                                    <span class="text-lg sm:text-2xl font-bold">Vs</span>
                                    <span class="text-xxs sm:text-xs">ID: {{ $match->id }}</span>
                                </div>

                                <div class="flex-1 flex items-center justify-start">
                                    <img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->medium_name }}" class="w-10 w-10 sm:w-12 sm:h-12 object-cover | mx-3">
                                    <div class="flex flex-col items-start">
                                        <span class="hidden sm:block">{{ $match->visitorTeam->team->medium_name }}</span>
                                        <span class="sm:hidden">{{ $match->visitorTeam->team->short_name }}</span>
                                        <span class="hidden sm:block text-xs text-gray-400">{{ $match->visitorTeam->team->user->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @hasanyrole('super-admin|admin')
                        <div class="flex justify-center | mb-4">
                            @if ($priorityMatch && $priorityMatch->id == $match->id)
                                <x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 leading-6 | flex items-center" wire:click="priorityMatchNotification({{ $match->id }})">
                                    <i class="fab fa-discord text-lg mr-1.5"></i>
                                    <span class="">Notificar por discord</span>
                                </x-buttons.primary>
                            @else
                                <x-buttons.primary-outline class="uppercase text-xs px-2.5 py-0.5 leading-6 | flex items-center | border-none" wire:click="priorityMatchNotification({{ $match->id }})">
                                    <i class="fab fa-discord text-lg mr-1.5"></i>
                                    <span class="">Notificar por discord</span>
                                </x-buttons.primary-outline>
                            @endif
                        </div>
                    @endhasanyrole
                </li>
            @endforeach
        </ul>
    @else
        <div class="bg-white dark:bg-gray-750 | border border-gray-200 dark:border-gray-700 | p-4 | text-center | text-sm">No hay partidos disponibles...</div>
    @endif
</div>
