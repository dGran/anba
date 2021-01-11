<x-app-layout>
    <x-slot name="header">
    	<div class="text-xs tracking-wider uppercase font-miriam">
	    	<a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 focus:text-gray-900 dark:text-gray-300 dark:hover:text-white dark:focus:text-white">Inicio</a>
	    	<span>/</span>
	    	<a href="{{ route('matches') }}" class="text-gray-600 hover:text-gray-900 focus:text-gray-900 dark:text-gray-300 dark:hover:text-white dark:focus:text-white">Partidos</a>
    	</div>
    </x-slot>

    <div>
		@livewire('match', ['match' => $match])
    </div>
</x-app-layout>
