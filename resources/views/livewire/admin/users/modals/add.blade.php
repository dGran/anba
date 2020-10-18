<x-modals.dialog wire:model="addModal">
    <x-slot name="title">
        <div class="px-6 py-3 bg-gray-50 text-sm uppercase font-medium tracking-wide flex items-center">
            <span>{{ $modelGender == 'male' ? 'Nuevo' : 'Nueva' }} {{ $modelSingular }}</span>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="px-6 py-2 w-full">
            @include('livewire.admin.users.forms.form')
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="px-6 py-4 w-full bg-gray-50">
            <x-buttons.cancel wire:click="cancelAdd" wire:loading.attr="disabled">
                Cancelar
            </x-buttons.cancel>
            <x-buttons.success class="ml-2" wire:click="store" wire:loading.attr="disabled">
                Guardar
            </x-buttons.success>
        </div>
    </x-slot>
</x-modals.dialog>