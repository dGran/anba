<x-app-layout blockHeader="1" title="Estadísticas">

    <x-slot name="header">
        @include('stats.partials.menu')
    </x-slot>

    @livewire('stats.tops')

</x-app-layout>
