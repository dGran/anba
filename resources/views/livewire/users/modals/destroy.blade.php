<x-jet-confirmation-modal wire:model="confirmDestroyModal">
    <x-slot name="title">
        Eliminar usuario "{{ $name }}"
    </x-slot>

    <x-slot name="content">
        <div class="py-3 text-sm font-medium">
            <p>¿Estás seguro que deseas eliminar el usuario?</p>
            <p class="mt-1 text-red-700">Esta acción será irreversible.</p>
        </div>
    </x-slot>

    <x-slot name="footer">
        <button class ="inline-flex items-center justify-center px-4 py-2 font-semibold text-xs text-gray-600 hover:text-gray-500 focus:text-gray-500 uppercase tracking-widest focus:outline-none transition ease-in-out duration-150" wire:click="cancelDestroy" wire:loading.attr="disabled">
            Cancelar
        </button>

        <x-jet-danger-button class="ml-2" wire:click="destroy({{ $user_id }})" wire:loading.attr="disabled">
            Eliminar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>