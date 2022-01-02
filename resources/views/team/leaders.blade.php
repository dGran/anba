<x-app-layout blockHeader="1" title="{{ $team->name }} - Leaders">

    <x-slot name="header">
        @include('team.partials.header')
    </x-slot>

    <div>
        @livewire('team.leaders', ['team' => $team])
    </div>
</x-app-layout>
