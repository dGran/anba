<x-app-layout blockHeader="1" title="Mis partidos pendientes">

    <x-slot name="header">
        <h2 class="font-semibold text-xl md:text-2xl leading-tight px-4 sm:px-0">
            {{ __('Mis partidos pendientes') }}
        </h2>
    </x-slot>

	<div>
		@livewire('pending_matches')
	</div>

</x-app-layout>