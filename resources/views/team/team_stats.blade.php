<x-app-layout blockHeader="0" title="{{ $team->name }} - Team Stats">
    <div>
        @livewire('team.team-stats', ['team' => $team])
    </div>
</x-app-layout>
