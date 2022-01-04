<x-app-layout blockHeader="1" title="{{ $team->name }} - Resultados">

    <x-slot name="header">
        @include('team.partials.header')
    </x-slot>

    <div>
        @livewire('team.results', ['team' => $team])
    </div>
</x-app-layout>
