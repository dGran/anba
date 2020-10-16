<x-dialog-modal wire:model="addModal">
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
    </x-slot>
</x-dialog-modal>