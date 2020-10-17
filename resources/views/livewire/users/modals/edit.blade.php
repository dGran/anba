<x-dialog-modal wire:model="editModal">
    <x-slot name="title">
        Editar usuario
    </x-slot>

    <x-slot name="content">
        <div class="flex flex-wrap -mx-3 mb-0 md:mb-4">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-semibold mb-2" for="name">
                    Nombre
                </label>
                <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-2 px-3 mb-1 leading-tight focus:outline-none hover:border-gray-200 focus:border-gray-300 text-sm" type="text" id="name" placeholder="Nombre..." wire:model="name">
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-semibold mb-2" for="email">
                    E-Mail
                </label>
                <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-2 px-3 mb-1 leading-tight focus:outline-none hover:border-gray-200 focus:border-gray-300 text-sm" type="email" id="email" placeholder="E-Mail..." wire:model="email">
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <button class ="inline-flex items-center justify-center px-4 py-2 font-semibold text-xs text-gray-600 hover:text-gray-500 focus:text-gray-500 uppercase tracking-widest focus:outline-none transition ease-in-out duration-150" wire:click="cancelEdit" wire:loading.attr="disabled">
            Cancelar
        </button>
        <x-jet-secondary-button wire:click="update" wire:loading.attr="disabled">
            Actualizar
        </x-jet-secondary-button>
    </x-slot>
</x-dialog-modal>