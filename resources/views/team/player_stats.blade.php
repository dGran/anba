<x-app-layout blockHeader="0" title="{{ $team->name }} - Players Stats">
    <div>
        @livewire('team.player-stats', ['t' => $t, 'team' => $team, 'season' => $season])
    </div>
</x-app-layout>
