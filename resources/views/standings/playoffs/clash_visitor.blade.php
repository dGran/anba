<div class="flex items-center">
    @if ($clash->visitorTeam || !$round->previousRound())
        @if ($position == 'left')
            <img src="{{ $clash->visitorTeam ? $clash->visitorTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->visitorTeam ? $clash->visitorTeam->team->short_name : '' }}" class="w-12 h-12 object-cover m-1">
            <div class="ml-1.5 flex flex-col text-left w-32">
                <p class="text-sm uppercase leading-4">
                    {{ $clash->visitorTeam ? $clash->visitorTeam->team->medium_name : 'N/D' }}
                </p>
                <p class="text-xs">
                    {{ $clash->visitorTeam ? $clash->visitorTeam->team->user->name : '' }}
                </p>
            </div>
            @if ($clash->localTeam && $clash->visitorTeam)
                <div class="w-8 font-bold text-xl">
                    @if ($clash->localResult() == 0 && $clash->visitorResult() == 0)
                        -
                    @else
                        {{ $clash->localResult() }}
                    @endif
                </div>
                @foreach ($clash->matches as $match)
                    <div class="w-8 text-xs">
                        @foreach ($match->scores as $score)
                            @if ($clash->local_team_id == $match->local_team_id)
                                {{ $score->local_score }}
                            @else
                                {{ $score->visitor_score }}
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @endif
        @else
            @if ($clash->localTeam && $clash->visitorTeam)
                <div class="w-8 font-bold text-xl">
                    @if ($clash->localResult() == 0 && $clash->visitorResult() == 0)
                        -
                    @else
                        {{ $clash->localResult() }}
                    @endif
                </div>
                @foreach ($clash->matches as $match)
                    <div class="w-8 text-xs">
                        @foreach ($match->scores as $score)
                            @if ($clash->local_team_id == $match->local_team_id)
                                {{ $score->local_score }}
                            @else
                                {{ $score->visitor_score }}
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @endif
            <div class="ml-1.5 flex flex-col text-left w-32">
                <p class="text-sm uppercase leading-4">
                    {{ $clash->visitorTeam ? $clash->visitorTeam->team->medium_name : 'N/D' }}
                </p>
                <p class="text-xs">
                    {{ $clash->visitorTeam ? $clash->visitorTeam->team->user->name : '' }}
                </p>
            </div>
            <img src="{{ $clash->visitorTeam ? $clash->visitorTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $clash->visitorTeam ? $clash->visitorTeam->team->short_name : '' }}" class="w-12 h-12 object-cover m-1">
        @endif
    @else
        @if ($round->previousRound())
            @if ($clash->previousClash('local'))
                <div class="">
                    ganador {{ $clash->previousClash('local') }}
                </div>
            @endif
        @endif
    @endif
</div>