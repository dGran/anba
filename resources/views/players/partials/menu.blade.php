<div class="flex items-center">
    <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
        {{ __('Jugadores') }}
    </h2>

    <ul class="sm:ml-4 pl-4 | border-l border-gray-300 dark:border-gray-600 |  flex items-center space-x-4">
        <li>
            <a href="{{ route('players') }}" class="focus:outline-none border-b-2 transition duration-150 ease-in-out {{ request()->route()->getName() == 'players' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'text-gray-500 dark:text-gray-400 border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}">
                Index
            </a>
        </li>
        <li>
            <a href="{{ route('players.injuries') }}" class="focus:outline-none border-b-2 transition duration-150 ease-in-out {{ request()->route()->getName() == 'players.injuries' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'text-gray-500 dark:text-gray-400 border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}">
                Lesionados
            </a>
        </li>
    </ul>
</div>
