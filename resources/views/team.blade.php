<x-app-layout blockHeader="1" title="Equipos">

    <x-slot name="header">
        <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
            {{-- {{ $seasonTeam->team->name }} --}}
        </h2>
    </x-slot>

    <div>
        {{-- @livewire('team_management', ['seasonTeam' => $seasonTeam]) --}}
    </div>
</x-app-layout>
