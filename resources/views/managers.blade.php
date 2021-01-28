<x-app-layout blockHeader="1">

    @section('title', 'Managers')

    <x-slot name="header">
        <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
            {{ __('Managers') }}
        </h2>
    </x-slot>

    <div>
        {{-- @livewire('managers') --}}
    </div>
</x-app-layout>
