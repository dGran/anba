<div class="{{ $users_selected->count() == 0 ? 'hidden' : 'block' }} fixed bottom-0 left-0 right-0 text-xs bg-gray-50 overflow-x-auto" style="-webkit-box-shadow: 1px -4px 4px -2px rgba(212,212,212,1);
-moz-box-shadow: 1px -4px 4px -2px rgba(212,212,212,1);
box-shadow: 1px -4px 4px -2px rgba(212,212,212,1);">
    <div class="py-3 px-4">
        <p class="text-center">
            <span class="text-gray-700 text-xxs uppercase font-semibold hover:underline hover:font-bold focus:underline cursor-pointer" wire:click="viewSelected(true)">
                {{ $users_selected->count() }}
                {{ $users_selected->count() == 1 ? 'registro seleccionado' : 'registros seleccionados' }}
            </span>
        </p>
        <p class="absolute right-0 top-0 my-1 mx-1 cursor-pointer flex flex-col text-gray-500 hover:text-gray-700 focus:text-gray-700 font-semibold uppercase md:mr-2" wire:click="cancelSelection">
            <i class="mx-auto fas fa-times text-xl"></i>
            <span class="text-xxxs">cerrar</span>
        </p>
    </div>

    {{-- options --}}
    <div class="flex items-center justify-center gap-1 pb-4">
        @if ($users_selected->count() == 1)
            <div class="flex items-center justify-center p-2 w-12 h-10 rounded border border-indigo-200 bg-white text-xl cursor-pointer text-gray-600 hover:text-indigo-500 focus:text-indigo-500 hover:border-indigo-300 focus:border-indigo-300"
            wire:click="editSelected">
                <i class="fas fa-edit"></i>
            </div>
        @endif
        <div class="flex items-center justify-center p-2 w-12 h-10 rounded border border-indigo-200 bg-white text-xl cursor-pointer text-gray-600 hover:text-indigo-500 focus:text-indigo-500 hover:border-indigo-300 focus:border-indigo-300"
        wire:click="confirmDestroy">
            <i class="fas fa-trash"></i>
        </div>


    </div>
</div>