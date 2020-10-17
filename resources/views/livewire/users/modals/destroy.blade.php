<x-jet-confirmation-modal wire:model="confirmDestroyModal">
    <x-slot name="title">
        @if ($users_selected->count() == 1)
            Eliminar usuario "{{ $users_selected->first()->name }}"
        @else
            Eliminar usuarios seleccionados
        @endif
    </x-slot>

    <x-slot name="content">
        <div class="py-3 text-sm font-medium">
            <p>¿Estás seguro que deseas eliminar {{ $users_selected->count() == 1 ? 'el usuario' : 'los usuarios' }}?</p>
            <p class="mt-1 text-red-700">Esta acción será irreversible.</p>
        </div>
    </x-slot>

    <x-slot name="footer">
        <button class ="inline-flex items-center justify-center px-4 py-2 font-semibold text-xs text-gray-600 hover:text-gray-500 focus:text-gray-500 uppercase tracking-widest focus:outline-none transition ease-in-out duration-150" wire:click="cancelDestroy" wire:loading.attr="disabled">
            Cancelar
        </button>

        @if ($users_selected->count() == 1)
            <x-jet-danger-button class="ml-2" wire:click="destroy({{ $users_selected->first()->id }})" wire:loading.attr="disabled">
                Eliminar
            </x-jet-danger-button>
        @else
            <x-jet-danger-button class="ml-2" wire:click="destroySelected" wire:loading.attr="disabled">
                Eliminar
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-confirmation-modal>