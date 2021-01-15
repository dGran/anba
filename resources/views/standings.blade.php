<x-app-layout blockHeader="1">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl leading-tight py-4 px-4 sm:px-0">
            {{ __('Clasificación Liga Regular') }}
        </h2>
    </x-slot>

    <div>
		@livewire('standing')
    </div>
</x-app-layout>
