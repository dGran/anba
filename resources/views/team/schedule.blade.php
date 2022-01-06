<x-app-layout blockHeader="0" title="{{ $team->name }} - Resultados">
    <div>
        @livewire('team.schedule', ['team' => $team])
    </div>
</x-app-layout>
