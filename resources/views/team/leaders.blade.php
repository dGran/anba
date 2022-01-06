<x-app-layout blockHeader="0" title="{{ $team->name }} - Leaders">
    <div>
        @livewire('team.leaders', ['team' => $team])
    </div>
</x-app-layout>
