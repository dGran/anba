<x-app-layout blockHeader="1" title="Clasificaciones">

    <x-slot name="header">
        <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
            {{ __('Clasificaciones') }}
        </h2>
    </x-slot>

    <div>
		@livewire('standings')
    </div>
</x-app-layout>
