<x-app-layout blockHeader="0" title="{{ $team->name }} - Home">
    <div>
        @livewire('team.home', ['team' => $team])
    </div>
</x-app-layout>