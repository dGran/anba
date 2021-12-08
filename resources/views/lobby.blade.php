<x-app-layout blockHeader="1" title="Clasificaciones">

    <x-slot name="header">
        <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
            {{ __('Vestíbulo de partidos') }}
        </h2>
    </x-slot>

    <div>
        @livewire('lobby')
    </div>
</x-app-layout>
