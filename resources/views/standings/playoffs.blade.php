@if ($playoff)
    {{-- PENDING --}}
    {{-- implements full_bracket for bracket left & right side or simple bracket only left side --}}
    @if ($playoff->rounds->count() > 0)
        @switch($playoff->num_participants)
            @case(2)
                @include('standings.playoffs.bracket_2')
                @break
            @case(4)
                @include('standings.playoffs.bracket_4')
                @break
            @case(16)
                @include('standings.playoffs.bracket_16')
                @break
            @default
                @include('standings.playoffs.bracket_16')
        @endswitch
    @endif
@endif