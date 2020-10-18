<div class="py-3 px-4">
    <p class="text-center">
        <span class="text-gray-700 text-xxs uppercase font-semibold hover:underline hover:font-bold focus:underline cursor-pointer" wire:click="viewSelected(true)">
            {{ $regsSelected->count() }}
            {{ $regsSelected->count() == 1 ? 'registro seleccionado' : 'registros seleccionados' }}
        </span>
    </p>
    <p class="absolute right-0 top-0 my-1 mx-1 cursor-pointer flex flex-col text-gray-500 hover:text-gray-700 focus:text-gray-700 font-semibold uppercase md:mr-2" wire:click="cancelSelection">
        <i class="mx-auto fas fa-times text-xl"></i>
        <span class="text-xxxs">cerrar</span>
    </p>
</div>