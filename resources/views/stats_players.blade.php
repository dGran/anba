<x-app-layout blockHeader="1" title="Estadísticas">

    <x-slot name="header">
        <div class="relative">
            <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
                {{ __('Estadísticas') }}
            </h2>
            <div class="overflow-x-auto absolute top-0 left-0">
                <div class="ml-40 mt-1 text-sm md:text-base z-40">
                    <ul>
                        <li class="inline-block">
                            <a href="{{ route('stats') }}">Inicio</a>
                        </li>
                        <li class="inline-block mx-2">/</li>
                        <li class="inline-block">
                            <a href="{{ route('stats.players') }}">Jugadores</a>
                        </li>
                        <li class="inline-block mx-2">/</li>
                        <li class="inline-block">
                            <a href="">Equipos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </x-slot>

    @livewire('players_stats')

</x-app-layout>