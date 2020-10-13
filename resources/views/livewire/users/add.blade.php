<x-dialog-modal wire:model="addModal" class="bg-red-400">
    <x-slot name="title">
        Nuevo usuario
    </x-slot>

    <x-slot name="content">
        @include('livewire.users.form')
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="store" wire:loading.attr="disabled">
            Guardar
        </x-jet-secondary-button>

{{--         <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
            Delete Account
        </x-jet-danger-button> --}}
    </x-slot>
</x-dialog-modal>