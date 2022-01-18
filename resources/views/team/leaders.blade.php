<x-app-layout blockHeader="0" title="{{ $team->name }} - Leaders">
    <div>
        @livewire('team.leaders', ['t' => $t, 'team' => $team, 'season' => $season])
    </div>
</x-app-layout>
