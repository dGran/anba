<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Clasificación Liga Regular') }}
        </h2>
    </x-slot>

    <div class="py-8">
		@livewire('standing')
    </div>
</x-app-layout>