<x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 mt-2 tracking-wide leading-6" wire:click.prevent="generateRounds">
    generar rondas
</x-buttons.primary>

<x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 mt-2 tracking-wide leading-6" wire:click.prevent="generateFirstMatches">
    generar primeros partidos
</x-buttons.primary>

@if ($playoff)
    @if ($playoff->full_bracket)
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
    @else
        @include('standings.playoffs.simple_bracket')
    @endif
@endif