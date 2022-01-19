<x-app-layout blockHeader="0" title="{{ $team->name }} - Home">
    <div>
        @livewire('team.home', ['t' => $t, 'team' => $team])
    </div>
</x-app-layout>
