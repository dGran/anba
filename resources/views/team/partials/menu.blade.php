<ul class="px-3 sm:px-0 py-3 flex items-center space-x-4 md:space-x-6 | select-none | text-sm md:text-base font-roboto | overflow-x-auto md:overflow-x-hidden">
    <li class="">
        <a class="truncate focus:outline-none pb-1 border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.home' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.home', $team->slug) }}">Home</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none pb-1 border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.roster' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.roster', $team->slug) }}">Roster</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none pb-1 border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.test' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.schedule', ['t' => $team->slug, 'season' => null]) }}">Schedule</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none pb-1 border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.leaders' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.leaders', $team->slug) }}">Leaders</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none pb-1 border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.team_stats' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.team_stats', $team->slug) }}">Team Stats</a>
    </li>
    <li class="">
        <a class="truncate focus:outline-none pb-1 border-b-2 transition duration-150 ease-in-out {{ $routeName == 'team.player_stats' ? 'font-semibold border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link' }}" href="{{ route('team.player_stats', $team->slug) }}">Player Stats</a>
    </li>
</ul>
