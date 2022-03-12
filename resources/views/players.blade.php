<x-app-layout blockHeader="1" title="Jugadores">
    <x-slot name="header">
        @include('players.partials.menu')
    </x-slot>

    <div>
        @livewire('players.index')
    </div>
</x-app-layout>
