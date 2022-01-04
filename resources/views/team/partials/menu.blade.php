<ul class="px-3 sm:px-0 flex items-center space-x-4 md:space-x-6 | select-none | mb-6 md:mb-8 | md:text-lg | overflow-x-auto">
    <li class="">
        <a class="truncate focus:outline-none border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.roster' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.roster', $team->slug) }}">Roster</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.results' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.results', $team->slug) }}">Results</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.leaders' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.leaders', $team->slug) }}">Leaders</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.team_stats' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.team_stats', $team->slug) }}">Team Stats</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.player_stats' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.player_stats', $team->slug) }}">Player Stats</a>
    </li>
</ul>
