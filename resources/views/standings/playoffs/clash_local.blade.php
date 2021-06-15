<div class="flex items-center px-1 {{ $position == 'right' ? 'justify-end' : 'justify-start' }}">
    @if ($clash && $clash->localTeam || !$round->previousRound())
        @if ($position == 'left')
            <img src="{{ $clash->localTeam ? $clash->localTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->localTeam ? $clash->localTeam->team->short_name : '' }}" class="w-8 h-8 object-cover">
            <div class="ml-1.5 flex flex-col text-left truncate">
                <p class="text-xs uppercase leading-4">
                    {{ $clash->localTeam ? $clash->localTeam->team->short_name : 'N/D' }}
                </p>
                <p class="text-xxs truncate text-gray-600">
                    {{ $clash->localTeam ? $clash->localTeam->team->user->name : '' }}
                </p>
            </div>
            {{-- @if ($clash->localTeam && $clash->visitorTeam)
                <div class="w-8 font-bold text-xl">
                    @if ($clash->localResult() == 0 && $clash->visitorResult() == 0)
                        -
                    @else
                        {{ $clash->localResult() }}
                    @endif
                </div>
                @foreach ($clash->matches as $match)
                    <div class="w-8 text-xxs">
                        @foreach ($match->scores as $score)
                            @if ($clash->local_team_id == $match->local_team_id)
                                {{ $score->local_score }}
                            @else
                                {{ $score->visitor_score }}
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @endif --}}
        @else
            {{-- @if ($clash->localTeam && $clash->visitorTeam)
                <div class="w-8 font-bold text-xl">
                    @if ($clash->localResult() == 0 && $clash->visitorResult() == 0)
                        -
                    @else
                        {{ $clash->localResult() }}
                    @endif
                </div>
                @foreach ($clash->matches as $match)
                    <div class="w-8 text-xxs">
                        @foreach ($match->scores as $score)
                            @if ($clash->local_team_id == $match->local_team_id)
                                {{ $score->local_score }}
                            @else
                                {{ $score->visitor_score }}
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @endif --}}
            <div class="mr-1.5 flex flex-col text-right truncate">
                <p class="text-xs uppercase leading-4">
                    {{ $clash->localTeam ? $clash->localTeam->team->short_name : 'N/D' }}
                </p>
                <p class="text-xxs truncate text-gray-600">
                    {{ $clash->localTeam ? $clash->localTeam->team->user->name : '' }}
                </p>
            </div>
            <img src="{{ $clash->localTeam ? $clash->localTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->localTeam ? $clash->localTeam->team->short_name : '' }}" class="w-8 h-8 object-cover">

            {{-- <div class="mr-1.5 flex flex-col text-right w-20">
                <p class="text-sm uppercase leading-4">
                    {{ $clash->localTeam ? $clash->localTeam->team->short_name : 'N/D' }}
                </p>
                <p class="text-xxs truncate">
                    {{ $clash->localTeam ? $clash->localTeam->team->user->name : '' }}
                </p>
            </div>
            <img src="{{ $clash->localTeam ? $clash->localTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->localTeam ? $clash->localTeam->team->short_name : '' }}" class="w-7 h-7 object-cover m-1"> --}}
        @endif
    @else
        {{-- @if ($round->previousRound())
            @if ($clash->previousClash('local'))
                <div class="text-xs text-center w-full">
                    {{ $clash->previousClash('local') }}
                </div>
            @endif
        @endif --}}
    @endif
</div>