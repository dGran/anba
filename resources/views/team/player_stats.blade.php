<x-app-layout blockHeader="1" title="{{ $team->name }} - Player Stats">

    <x-slot name="header">
        @include('team.partials.header')
    </x-slot>

    <div>
        @livewire('team.player-stats', ['team' => $team])
    </div>
</x-app-layout>
