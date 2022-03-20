<div class="border-t border-b sm:border border-gray-200 dark:border-gray-700 sm:rounded bg-white dark:bg-gray-750 | overflow-x-auto | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-transparent hover:scrollbar-thumb-gray-300 | dark:hover:scrollbar-thumb-gray-500">
    <table class="w-full">
        <thead class="font-semibold tracking-wider uppercase text-sm select-none | bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="text-left bg-gray-100 dark:bg-gray-700" style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;">
                    <div class="px-3 py-2.5 flex items-center space-x-1 | border-r border-gray-200 dark:border-gray-700">

                            @if ($order == 'name')
                                <span class="cursor-pointer" wire:click="setOrder('name_desc')">Jugador</span><i class="fas fa-sort-up"></i>
                            @elseif ($order == 'name_desc')
                                <span class="cursor-pointer" wire:click="setOrder('name')">Jugador</span><i class="fas fa-sort-down"></i>
                            @else
                                <span class="cursor-pointer" wire:click="setOrder('name')">Jugador</span><i class="fas fa-sort text-gray-300 dark:text-gray-500"></i>
                            @endif
                    </div>
                </th>
                <th class="px-3 text-left">
                    <div class="flex items-center space-x-1">
                        @if ($order == 'position')
                            <span class="cursor-pointer" wire:click="setOrder('position_desc')">Pos.</span><i class="fas fa-sort-up"></i>
                        @elseif ($order == 'position_desc')
                            <span class="cursor-pointer" wire:click="setOrder('position')">Pos.</span><i class="fas fa-sort-down"></i>
                        @else
                            <span class="cursor-pointer" wire:click="setOrder('position')">Pos.</span><i class="fas fa-sort text-gray-300 dark:text-gray-500"></i>
                        @endif
                    </div>
                </th>
                <th class="px-3 text-center">
                    <div class="flex items-center space-x-1">
                        @if ($order == 'height')
                            <span class="cursor-pointer" wire:click="setOrder('height_desc')">Altura</span><i class="fas fa-sort-up"></i>
                        @elseif ($order == 'height_desc')
                            <span class="cursor-pointer" wire:click="setOrder('height')">Altura</span><i class="fas fa-sort-down"></i>
                        @else
                            <span class="cursor-pointer" wire:click="setOrder('height')">Altura</span><i class="fas fa-sort text-gray-300 dark:text-gray-500"></i>
                        @endif
                    </div>
                </th>
                <th class="px-3 text-left">
                    <div class="flex items-center space-x-1">
                        @if ($order == 'weight')
                            <span class="cursor-pointer" wire:click="setOrder('weight_desc')">Peso</span><i class="fas fa-sort-up"></i>
                        @elseif ($order == 'weight_desc')
                            <span class="cursor-pointer" wire:click="setOrder('weight')">Peso</span><i class="fas fa-sort-down"></i>
                        @else
                            <span class="cursor-pointer" wire:click="setOrder('weight')">Peso</span><i class="fas fa-sort text-gray-300 dark:text-gray-500"></i>
                        @endif
                    </div>
                </th>
                <th class="px-3 text-left">
                    <div class="flex items-center space-x-1">
                        @if ($order == 'age')
                            <span class="cursor-pointer" wire:click="setOrder('age_desc')">Edad</span><i class="fas fa-sort-up"></i>
                        @elseif ($order == 'age_desc')
                            <span class="cursor-pointer" wire:click="setOrder('age')">Edad</span><i class="fas fa-sort-down"></i>
                        @else
                            <span class="cursor-pointer" wire:click="setOrder('age')">Edad</span><i class="fas fa-sort text-gray-300 dark:text-gray-500"></i>
                        @endif
                    </div>
                </th>
                <th class="px-3 text-center">
                    <div class="flex items-center space-x-1">
                        @if ($order == 'exp')
                            <span class="cursor-pointer" wire:click="setOrder('exp_desc')">Exp.</span><i class="fas fa-sort-up"></i>
                        @elseif ($order == 'exp_desc')
                            <span class="cursor-pointer" wire:click="setOrder('exp')">Exp.</span><i class="fas fa-sort-down"></i>
                        @else
                            <span class="cursor-pointer" wire:click="setOrder('exp')">Exp.</span><i class="fas fa-sort text-gray-300 dark:text-gray-500"></i>
                        @endif
                    </div>
                </th>
                <th class="px-3 text-left">
                    <div class="flex items-center space-x-1">
                        @if ($order == 'nation')
                            <span class="cursor-pointer" wire:click="setOrder('nation_desc')">Pais</span><i class="fas fa-sort-up"></i>
                        @elseif ($order == 'nation_desc')
                            <span class="cursor-pointer" wire:click="setOrder('nation')">Pais</span><i class="fas fa-sort-down"></i>
                        @else
                            <span class="cursor-pointer" wire:click="setOrder('nation')">Pais</span><i class="fas fa-sort text-gray-300 dark:text-gray-500"></i>
                        @endif
                    </div>
                </th>
                <th class="px-3 text-left">
                    <div class="flex items-center space-x-1">
                        @if ($order == 'college')
                            <span class="cursor-pointer" wire:click="setOrder('college_desc')">Universidad</span><i class="fas fa-sort-up"></i>
                        @elseif ($order == 'college_desc')
                            <span class="cursor-pointer" wire:click="setOrder('college')">Universidad</span><i class="fas fa-sort-down"></i>
                        @else
                            <span class="cursor-pointer" wire:click="setOrder('college')">Universidad</span><i class="fas fa-sort text-gray-300 dark:text-gray-500"></i>
                        @endif
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
                <tr class="group border-t border-gray-200 dark:border-gray-700 text-sm md:text-base hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="bg-white dark:bg-gray-750 group-hover:bg-gray-50 dark:group-hover:bg-gray-700" style="width: 275px; min-width: 200px; max-width: 275px; left: 0px; position: sticky; position: -webkit-sticky;">
                        <div class="relative px-3 py-1.5 flex items-center space-x-3 | border-r border-gray-200 dark:border-gray-700">
                            <img src="{{ $player->getImg() }}" alt="{{ $player->name }}" class="w-8 h-8 object-cover">
                            <a class="truncate cursor-pointer hover:underline focus:underline focus:outline-none" wire:click="openPlayerInfo({{ $player->id }})">
                                {{ $player->name }}
                            </a>
                            @if ($player->injury_id)
                                <span class="absolute bottom-0 right-0 pr-1.5 pb-0.5 | text-sm sm:text-base | {{ $player->injury_playable ? 'text-yellow-300' : 'text-pretty-red' }}">
                                    <i class="fas fa-briefcase-medical"></i>
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-3 w-24 min-w-max" style="min-width: 5.5rem; max-width: 5.5rem">
                        {{ $player->getPosition() }}
                    </td>
                    <td class="px-3 w-24 text-center" style="min-width: 5rem; max-width: 5rem">
                        {{ $player->getHeight() }}
                    </td>
                    <td class="px-3 w-24" style="min-width: 5rem; max-width: 5rem">
                        {{ $player->weight }} lbs
                    </td>
                    <td class="px-3 w-24" style="min-width: 5rem; max-width: 5rem">
                        {{ $player->birthdate != 0 ? $player->age() . ' años' : 'N/D' }}
                    </td>
                    <td class="px-3 w-24 text-center" style="min-width: 5rem; max-width: 5rem">
                        {{ $player->getYearsPro() }}
                    </td>
                    <td class="px-3 w-40 truncate" style="min-width: 10rem; max-width: 10rem">
                        <span class="truncate">{{ $player->nation_name }}</span>
                    </td>
                    <td class="px-3 w-40 truncate" style="min-width: 10rem; max-width: 10rem">
                        <span class="truncate">{{ $player->college }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
