<x-modals.confirmation wire:model="confirmDestroyModal">
    <x-slot name="title">
        @if ($regsSelected->count() == 1)
            Eliminar {{ $modelSingular }} "{{ $regsSelected->first()->getName() }}"
        @else
            Eliminar {{ $modelPlural }} seleccionados
        @endif
    </x-slot>

    <x-slot name="content">
        <div class="py-3 text-sm font-medium">
            @if ($regsSelected->count() == 1)
                <p>¿Estás seguro que deseas eliminar {{ $modelGender = 'male' ? 'el' : 'la' }} {{ $modelSingular }}?</p>
            @else
                <p>¿Estás seguro que deseas eliminar {{ $modelGender = 'male' ? 'los' : 'las' }} {{ $modelPlural }}?</p>
            @endif
            <p class="mt-1 text-red-700">Esta acción será irreversible.</p>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-buttons.cancel wire:click="cancelDestroy" wire:loading.attr="disabled">
            Cancelar
        </x-buttons.cancel>

        @if ($regsSelected->count() == 1)
            <x-buttons.danger class="ml-2" wire:click="destroy({{ $regsSelected->first()->id }})" wire:loading.attr="disabled">
                Eliminar
            </x-buttons.danger>
        @else
            <x-buttons.danger class="ml-2" wire:click="destroySelected" wire:loading.attr="disabled">
                Eliminar
            </x-buttons.danger>
        @endif
    </x-slot>
</x-modals.confirmation>