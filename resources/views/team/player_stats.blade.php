<x-app-layout blockHeader="0" title="{{ $team->name }} - Player Stats">
    <div>
        @livewire('team.player-stats', ['team' => $team])
    </div>
</x-app-layout>