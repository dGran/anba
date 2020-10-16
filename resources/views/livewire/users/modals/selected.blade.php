<x-dialog-modal wire:model="selectedModal" maxWidth="md">
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
            @foreach ($selected_regs_names as $reg)
                <li class="flex items-center text-gray-600 text-sm border-b border-gray-100 px-6 py-2">
                    <figure class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full" src="{{ $reg['profile_photo_url'] }}" alt="{{ $reg['name'] }}">
                    </figure>
                    <div class="pl-3 leading-4">
                        <p>
                            {{ $reg['name'] }}
                        </p>
                        <p class="text-xxs text-gray-400">
                            ID: {{ $reg['id'] }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </x-slot>

    <x-slot name="footer">
    </x-slot>
</x-dialog-modal>