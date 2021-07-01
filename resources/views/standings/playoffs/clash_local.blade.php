

<div class="flex items-center px-1 {{ $position == 'right' ? 'justify-end' : 'justify-start' }}">
    @if ($clash && $clash->localTeam || !$round->previousRound())
        @if ($position == 'left')
            <img src="{{ $clash->localTeam ? $clash->localTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->localTeam ? $clash->localTeam->team->short_name : '' }}" class="w-8 h-8 object-cover">
            <div class="ml-1.5 flex flex-col text-left truncate">
                <p class="text-xs uppercase leading-4">
                    {{ $clash->localTeam ? '(' . $clash->regular_position_local . ') ' . $clash->localTeam->team->short_name : 'N/D' }}
                </p>
                <p class="text-xxs truncate text-gray-600 dark:text-gray-350">
                    {{ $clash->localManager ? $clash->localManager->name : '' }}
                </p>
            </div>
        @else
            <div class="mr-1.5 flex flex-col text-right truncate">
                <p class="text-xs uppercase leading-4">
                    {{ $clash->localTeam ? $clash->localTeam->team->short_name . ' (' . $clash->regular_position_local . ')' : 'N/D' }}
                </p>
                <p class="text-xxs truncate text-gray-600 dark:text-gray-350">
                    {{ $clash->localManager ? $clash->localManager->name : '' }}
                </p>
            </div>
            <img src="{{ $clash->localTeam ? $clash->localTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->localTeam ? $clash->localTeam->team->short_name : '' }}" class="w-8 h-8 object-cover">
        @endif
    @endif
</div>