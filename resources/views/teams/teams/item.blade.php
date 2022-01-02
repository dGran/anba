<div class="flex items-center border-b md:border-none border-gray-200 dark:border-gray-700 | -mx-4 md:mx-0 px-4 md:px-0 py-2">
    <img src="{{ $team->getImg() }}" alt="{{ $team->medium_name }}" class="w-12 h-12 md:w-14 md:h-14 object-cover">
    <div class="flex flex-col ml-3 | leading-5">
        <a href="{{ route('team.roster', [$team->slug]) }}" class="font-semibold text-base md:text-lg hover:underline focus:underline">{{ $team->name }}</a>
        <ul class="flex items-center space-x-2 lg:space-x-4">
            <li>
                <x-link href="{{ route('team.roster', $team->slug) }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline focus:underline">Roster</x-link>
            </li>
            <li>
                <x-link href="{{ route('team.leaders', $team->slug) }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline focus:underline">Leaders</x-link>
            </li>
            <li>
                <x-link href="{{ route('team.team_stats', $team->slug) }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline focus:underline">Team Stats</x-link>
            </li>
            <li>
                <x-link href="{{ route('team.player_stats', $team->slug) }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline focus:underline">Player Stats</x-link>
            </li>
        </ul>
    </div>
</div>
