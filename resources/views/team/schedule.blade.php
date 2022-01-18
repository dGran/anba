<x-app-layout blockHeader="0" title="{{ $team->name }} - Schedule">
    <div>
        @livewire('team.schedule', ['t' => $t, 'team' => $team, 'season' => $season])
    </div>
</x-app-layout>
