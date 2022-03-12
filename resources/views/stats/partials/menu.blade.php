<div class="flex items-center">
    <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
        {{ __('Estadísticas') }}
    </h2>

    <ul class="sm:ml-4 pl-4 | border-l border-gray-300 dark:border-gray-600 |  flex items-center space-x-4">
        <li>
            <a href="{{ route('stats') }}" class="focus:outline-none border-b-2 transition duration-150 ease-in-out {{ request()->route()->getName() == 'stats' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'text-gray-500 dark:text-gray-400 border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}">
                Index
            </a>
        </li>
        <li>
            <a href="{{ route('stats.players') }}" class="focus:outline-none border-b-2 transition duration-150 ease-in-out {{ request()->route()->getName() == 'stats.players' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'text-gray-500 dark:text-gray-400 border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}">
                Jugadores
            </a>
        </li>
        <li>
            <a href="{{ route('stats.teams') }}" class="focus:outline-none border-b-2 transition duration-150 ease-in-out {{ request()->route()->getName() == 'stats.teams' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'text-gray-500 dark:text-gray-400 border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}">
                Equipos
            </a>
        </li>
    </ul>
</div>
