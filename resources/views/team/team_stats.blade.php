<x-app-layout blockHeader="0" title="{{ $team->name }} - Team Stats">
    <div>
        @livewire('team.team-stats', ['t' => $t, 'team' => $team, 'season' => $season])
    </div>
</x-app-layout>
