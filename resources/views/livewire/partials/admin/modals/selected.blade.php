<x-modals.dialog wire:model="selectedModal" maxWidth="md">
    <x-slot name="title">
        {{-- Registros seleccionados --}}
        <div class="px-4 sm:px-6 py-3 bg-gray-50 text-xs sm:text-sm uppercase font-medium tracking-wide flex items-center">
            <i class="fas fa-tasks mr-3 text-base sm:text-xl text-indigo-500"></i>
            <span>Registros seleccionados</span>
            <p class="absolute right-0 top-0 my-2 mx-2 cursor-pointer flex flex-col text-gray-500 hover:text-gray-700 focus:text-gray-700 font-semibold w-12 text-center" wire:click="viewSelected(false)">
                <i class="mx-auto fas fa-times text-base"></i>
                <span class="text-xxxs">cerrar</span>
            </p>
        </div>
    </x-slot>

    <x-slot name="content">
        <ul class="overflow-y-auto h-auto" style="max-height: 25rem">
            @foreach ($regsSelected as $reg)
                <li class="flex items-center text-gray-600 text-xs sm:text-sm border-b border-gray-100 px-3 sm:px-6 py-2 w-full">
                    @if ($modelHasImg)
                        <figure class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 mr-3">
                            <img class="h-8 w-8 sm:h-10 sm:w-10 rounded-full" src="{{ $reg->getImg() }}" alt="{{ $reg->getName() }}">
                        </figure>
                    @endif
                    <div class="leading-4">
                        <p>
                            {{ $reg->getName() }}
                        </p>
                        <p class="text-xxs text-gray-400">
                            ID: {{ $reg->id }}
                        </p>
                    </div>
                    <div class="flex-auto text-right">
                        <button wire:click="deselect({{ $reg->id }})" class="text-lg text-red-400 hover:text-red-600 focus:text-red-600 focus:outline-none mr-3 sm:mr-0">
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    </x-slot>

    <x-slot name="footer">
    </x-slot>
</x-modals.dialog>