<x-app-layout blockHeader="1" title="Jugadores">

    <x-slot name="header">
        <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
            {{ __('Jugadores') }}
        </h2>
    </x-slot>

    @livewire('players')

</x-app-layout>