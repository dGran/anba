<x-app-layout blockHeader="0" title="{{ $team->name }} - Roster">
    <div>
        @livewire('team.roster', ['t' => $t, 'team' => $team])
    </div>
</x-app-layout>
