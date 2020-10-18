<x-modals.dialog wire:model="selectedModal" maxWidth="md">
    <x-slot name="title">
        {{-- Registros seleccionados --}}
        <div class="px-6 py-3 bg-gray-50 text-sm uppercase font-medium tracking-wide flex items-center">
            <i class="fas fa-check mr-3 text-3xl text-indigo-500"></i>
            <span>Registros seleccionados</span>
            <p class="absolute right-0 top-0 my-3 mx-3 cursor-pointer flex flex-col text-gray-500 hover:text-gray-700 focus:text-gray-700 font-semibold" wire:click="viewSelected(false)">
                <i class="mx-auto fas fa-times text-xl"></i>
                <span class="text-xxxs">cerrar</span>
            </p>
        </div>
    </x-slot>

    <x-slot name="content">
        <ul class="overflow-y-auto h-auto" style="max-height: 25rem">
            @foreach ($regsSelected as $reg)
                <li class="flex items-center text-gray-600 text-sm border-b border-gray-100 px-6 py-2 w-full">
                    @if ($modelHasImg)
                        <figure class="flex-shrink-0 h-10 w-10 mr-3">
                            <img class="h-10 w-10 rounded-full" src="{{ $reg->getImg() }}" alt="{{ $reg->getName() }}">
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
                        <button wire:click="deselect({{ $reg->id }})" class="text-lg text-red-400 hover:text-red-600 focus:text-red-600 focus:outline-none">
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