<div class="flex items-center px-1 {{ $position == 'right' ? 'justify-end' : 'justify-start' }}">
    @if ($clash && $clash->visitorTeam || !$round->previousRound())
        @if ($position == 'left')
            <img src="{{ $clash->visitorTeam ? $clash->visitorTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->visitorTeam ? $clash->visitorTeam->team->short_name : '' }}" class="w-8 h-8 object-cover">
            <div class="ml-1.5 flex flex-col text-left truncate">
                <div class="text-xs uppercase leading-4">
                    @if ($clash->visitorTeam)
                        <a href="{{ route('team.home', $clash->visitorTeam->team->slug) }}" class="hover:underline focus:underline focus:outline-none">
                            ({{ $clash->regular_position_visitor }}) {{ $clash->visitorTeam->team->short_name }}
                        </a>
                    @else
                        <span>N/D</span>
                    @endif
                </div>
                <p class="text-xxs truncate text-gray-600 dark:text-gray-350">
                    {{ $clash->visitorManager ? $clash->visitorManager->name : '' }}
                </p>
            </div>
        @else
            <div class="mr-1.5 flex flex-col text-right truncate">
                <div class="text-xs uppercase leading-4">
                    @if ($clash->visitorTeam)
                        <a href="{{ route('team.home', $clash->visitorTeam->team->slug) }}" class="hover:underline focus:underline focus:outline-none">
                            {{ $clash->visitorTeam->team->short_name }} ({{ $clash->regular_position_visitor }})
                        </a>
                    @else
                        <span>N/D</span>
                    @endif
                </div>
                <p class="text-xxs truncate text-gray-600 dark:text-gray-350">
                    {{ $clash->visitorManager ? $clash->visitorManager->name : '' }}
                </p>
            </div>
            <img src="{{ $clash->visitorTeam ? $clash->visitorTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->visitorTeam ? $clash->visitorTeam->team->short_name : '' }}" class="w-8 h-8 object-cover">
        @endif
    @endif
</div>
