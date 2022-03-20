<div class="px-3 sm:px-0 flex flex-col md:flex-row space-x-0 md:space-x-0.5 space-y-1 md:space-y-0 items-center select-none | mb-2 | overflow-x-auto | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-transparent hover:scrollbar-thumb-gray-300 | dark:hover:scrollbar-thumb-gray-500">
    <div class="flex-1 w-full flex flex-col relative">
        <label for="fteam" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Equipo
        </label>
        <select id="fteam" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="fteam" wire:change="applyFilter">
            <option value="all">Todos los equipos</option>
            <option value="free_agents">Agentes libres</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->medium_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative">
        <label for="fposition" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Posición
        </label>
        <select id="fposition" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="fposition" wire:change="applyFilter">
            <option value="all">Todas las posiciones</option>
            <option value="pg">Base</option>
            <option value="sg">Escolta</option>
            <option value="sf">Alero</option>
            <option value="pf">Ala-Pivot</option>
            <option value="c">Pivot</option>
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative">
        <label for="fnation" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Pais
        </label>
        <select id="fnation" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="fnation" wire:change="applyFilter">
            <option value="all">Todos los paises</option>
            @foreach ($nations as $nation)
                <option value="{{ $nation->nation_name }}">{{ $nation->nation_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative">
        <label for="fcollege" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Universidad
        </label>
        <select id="fcollege" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="fcollege" wire:change="applyFilter">
            <option value="all">Todas las universidades</option>
            @foreach ($colleges as $college)
                <option value="{{ $college->college }}">{{ $college->college }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative" style="min-width: 8rem">
        <label for="fstate" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Estado
        </label>
        <select id="fstate" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="fstate" wire:change="applyFilter">
            <option value="all">Todas los estados</option>
            <option value="active">En activo</option>
            <option value="retired">Retirados</option>
        </select>
    </div>
    <div class="flex-1 w-full flex flex-col relative" style="min-width: 8rem">
        <label for="foutnba" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
            Fuera de la NBA
        </label>
        <select id="foutnba" class="appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" wire:model="foutnba" wire:change="applyFilter">
            <option value="all">Todos</option>
            <option value="yes">Sí</option>
            <option value="no">No</option>
        </select>
    </div>
</div>

<div class="my-4 sm:my-0 sm:mb-4 | px-3 sm:px-0">
    <div class="flex flex-col md:flex-row items-center select-none">
        <div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0">
            <label for="search" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
                Buscar jugadores
            </label>
            <input type="search" id="search" wire:model="search" class="search-input appearance-none rounded text-sm text-blue-500 dark:text-dark-link font-bold | h-12 md:h-16 pt-4 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none" placeholder="nombre, equipo, universidad...">
        </div>
    </div>
</div>
