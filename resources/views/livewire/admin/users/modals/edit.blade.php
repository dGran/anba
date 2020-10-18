<x-modals.dialog wire:model="editModal">
    <x-slot name="title">
        <div class="px-6 py-3 bg-gray-50 text-sm uppercase font-medium tracking-wide flex items-center">
            <span>Editar {{ $modelSingular }}</span>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="px-6 py-2 w-full">
            @include('livewire.admin.users.forms.form')
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="px-6 py-4 w-full bg-gray-50">
            <x-buttons.cancel wire:click="cancelEdit" wire:loading.attr="disabled">
                Cancelar
            </x-buttons.cancel>
            <x-buttons.secondary class="ml-2" wire:click="update" wire:loading.attr="disabled">
                Actualizar
            </x-buttons.secondary>
        </div>
    </x-slot>
</x-modals.dialog>