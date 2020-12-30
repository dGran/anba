<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Partidos') }}
        </h2>
    </x-slot>

    <div>
		@livewire('matches')
    </div>
</x-app-layout>
