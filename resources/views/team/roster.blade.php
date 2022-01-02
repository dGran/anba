<x-app-layout blockHeader="1" title="{{ $team->name }} - Roster">

    <x-slot name="header">
        @include('team.partials.header')
    </x-slot>

    <div>
        @livewire('team.roster', ['team' => $team])
    </div>
</x-app-layout>
