<div class="{{ $advanced_filters ?: 'pt-4' }}">
	<h4 class="text-xs uppercase font-bold text-gray-500 dark:text-gray-300 select-none pb-0.5 pl-1">
		Buscar jugador
	</h4>
	<div class="flex flex-col md:flex-row items-center select-none">
		<div class="flex-1 w-full flex flex-col relative mt-0.5 md:mt-0 md:ml-0.5">
			<label for="name" class="text-xs uppercase absolute top-1.5 md:top-3 left-3 text-gray-500 dark:text-gray-300">
				Nombre
			</label>
			<input type="search" id="name" wire:model="name" class="appearance-none rounded text-sm | h-12 md:h-16 pt-5 px-3 | bg-white dark:bg-gray-700 | border border-gray-200 dark:border-gray-850 focus:border-gray-300 hover:border-gray-300 hover:bg-gray-50 focus:bg-gray-50 dark:focus:border-gray-600 dark:hover:border-gray-600 dark:hover:bg-gray-650 dark:focus:bg-gray-650 | focus:outline-none | text-sm text-blue-500 dark:text-dark-link font-bold" placeholder="Buscar..." autofocus="true">
		</div>
	</div>
</div>