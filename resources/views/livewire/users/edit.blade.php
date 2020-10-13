<x-dialog-modal wire:model="editModal" class="bg-red-400">
    <x-slot name="title">
        Editar usuario "{{ $name }}"
    </x-slot>

    <x-slot name="content">
        @include('livewire.users.form')
    </x-slot>

    <x-slot name="footer">
        <button class ="inline-flex items-center justify-center px-4 py-2 font-semibold text-xs text-gray-600 uppercase tracking-widest focus:outline-none transition ease-in-out duration-150" wire:click="cancelEdit" wire:loading.attr="disabled">
            Cancelar
        </button>
        <x-jet-secondary-button wire:click="update" wire:loading.attr="disabled">
            Actualizar
        </x-jet-secondary-button>

{{--         <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
            Delete Account
        </x-jet-danger-button> --}}
    </x-slot>
</x-dialog-modal>