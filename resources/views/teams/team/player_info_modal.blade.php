@if ($playerInfoModal)
    <x-modals.dialog maxWidth="md" wire:model="playerInfoModal" >
        <x-slot name="title">
            <div class="w-full flex items-center justify-between | leading-5 | py-3 px-4 | border-b border-gray-150 dark:border-gray-700">
                <div class="flex flex-col">
                    <span class="font-semibold text-lg">{{ $playerInfo->name }}</span>
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $playerInfo->getPosition() }}</span>
                </div>
                <span class="text-xl | uppercase | font-bold">
                    {{ $playerInfo->position }}
                </span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex items-center px-4">
                <div class="flex-initial border-r border-gray-150 dark:border-gray-700 | pr-4 mr-4">
                    <img src="{{ $playerInfo->getImg() }}" alt="" class="w-32 h-32 object-cover rounded-full bg-gray-50 dark:bg-gray-650 border border-gray-150 dark:border-transparent">
                </div>

                <div class="flex-1 py-4">
                    <div class="grid grid-cols-2 gap-4 | text-xs">
                        <span class="truncate text-right sm:text-left font-semibold text-gray-700 dark:text-gray-400">Altura</span>
                        <span class="truncate">{{ $playerInfo->getHeight() }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 | text-xs">
                        <span class="truncate text-right sm:text-left font-semibold text-gray-700 dark:text-gray-400">Peso</span>
                        <span class="truncate">{{ $playerInfo->weight }} lbs</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 | text-xs">
                        <span class="truncate text-right sm:text-left font-semibold text-gray-700 dark:text-gray-400">Edad</span>
                        <span class="truncate">{{ $playerInfo->age() }} años</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 | text-xs">
                        <span class="truncate text-right sm:text-left font-semibold text-gray-700 dark:text-gray-400">Fecha Nacimiento</span>
                        <span class="truncate">{{ $playerInfo->getBirthdate() }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 | text-xs">
                        <span class="truncate text-right sm:text-left font-semibold text-gray-700 dark:text-gray-400">Universidad</span>
                        <span class="truncate capitalize">{{ $playerInfo->college }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 | text-xs">
                        <span class="truncate text-right sm:text-left font-semibold text-gray-700 dark:text-gray-400">País</span>
                        <span class="truncate">{{ $playerInfo->nation_name }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 | text-xs">
                        <span class="truncate text-right sm:text-left font-semibold text-gray-700 dark:text-gray-400">Años Pro.</span>
                        <span class="truncate">{{ $playerInfo->getYearsPro() }}</span>
                    </div>
                </div>
            </div>

            <div class="p-4 | border-t border-gray-150 dark:border-gray-700">
                <div class="flex items-top justify-between space-x-3">
                    <a href="{{ route('player', $playerInfo->slug) }}" class="block text-white dark:text-gray-900 rounded bg-blue-500 dark:bg-dark-link focus:outline-none hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-300 dark:focus:bg-blue-300 transition duration-150 ease-in-out | text-sm uppercase px-4 | flex items-center">
                        <p class="text-center">full bio</p>
                    </a>
                    <div class="flex-1 bg-gray-50 dark:bg-gray-650 rounded border border-gray-150 dark:border-transparent px-3 py-1.5 | flex flex-col">
                        <div class="flex items-center justify-center space-x-4">
                            <div class="flex flex-col items-center">
                                <span class="sm:hidden font-bold text-sm">PJ</span>
                                <span class="hidden sm:block font-bold text-sm">PARTIDOS</span>
                                <span class="text-sm">{{ number_format($playerInfoStats[0]['PJ'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="font-bold text-sm">PPG</span>
                                <span class="text-sm">{{ number_format($playerInfoStats[0]['AVG_PTS'], 1, ',', '.') }}</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="font-bold text-sm">RPG</span>
                                <span class="text-sm">{{ number_format($playerInfoStats[0]['AVG_REB'], 1, ',', '.') }}</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="font-bold text-sm">APG</span>
                                <span class="text-sm">{{ number_format($playerInfoStats[0]['AVG_AST'], 1, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($playerInfo->injury_id)
                <div class="p-4 | border-t border-gray-150 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <span class="text-3xl | pr-3 | {{ $playerInfo->injury_playable ? 'text-yellow-300' : 'text-pretty-red' }} | border-r border-gray-150 dark:border-gray-650">
                            <i class="fas fa-briefcase-medical"></i>
                        </span>
                        <span class="text-sm | leading-4 | flex flex-col">
                            <span>{{ $playerInfo->injury->name }}</span>
                            <span>{{ $playerInfo->injury_days }} {{ $playerInfo->injury_days == 1 ? 'día' : 'días' }}, {{ $playerInfo->injury_matches }} {{ $playerInfo->injury_matches == 1 ? 'partido' : 'partidos' }}</span>
                        </span>
                    </div>
                </div>
            @endif
        </x-slot>
    </x-modals.dialog>
@endif
