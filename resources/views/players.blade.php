<x-app-layout blockHeader="1">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl leading-tight py-4 px-4 sm:px-0">
            {{ __('Jugadores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                <ul>
                    <li>Todos</li>
                    <li>Novatos</li>
                    <li>Agentes libres</li>
                    <li>Retirados</li>
                </ul>
                <p class="p-4">
                    <img src="{{ asset('img/players.png') }}" alt="">
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
