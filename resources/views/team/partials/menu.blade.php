<ul class="px-3 sm:px-0 flex items-center space-x-4 md:space-x-6 | select-none | mb-6 md:mb-8 | md:text-lg | overflow-x-auto">
    <li class="border-b-2 transition duration-150 ease-in-out {{ request()->routeIs('team.roster') ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link' }}">
        @if (request()->routeIs('team.roster'))
            <span>Roster</span>
        @else
            <a href="{{ route('team.roster', $team->slug) }}">Roster</a>
        @endif
    </li>
    <li class="border-b-2 transition duration-150 ease-in-out {{ request()->routeIs('team.leaders') ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link' }}">
        @if (request()->routeIs('team.leaders'))
            <span>Leaders</span>
        @else
            <a href="{{ route('team.leaders', $team->slug) }}">Leaders</a>
        @endif
    </li>
    <li class="border-b-2 transition duration-150 ease-in-out {{ request()->routeIs('team.team_stats') ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link' }}">
        @if (request()->routeIs('team.team_stats'))
            <span>Team Stats</span>
        @else
            <a href="{{ route('team.team_stats', $team->slug) }}">Team Stats</a>
        @endif
    </li>
    <li class="border-b-2 transition duration-150 ease-in-out {{ request()->routeIs('team.player_stats') ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link' }}">
        @if (request()->routeIs('team.player_stats'))
            <span>Player Stats</span>
        @else
            <a href="{{ route('team.player_stats', $team->slug) }}">Player Stats</a>
        @endif
    </li>
</ul>
