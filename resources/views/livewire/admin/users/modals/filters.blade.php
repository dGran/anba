<x-modals.dialog wire:model="filtersModal">
    <x-slot name="title">
    </x-slot>

    <x-slot name="content">
        <div class="px-6 py-2 w-full">
			<div class="form-input text-sm rounded-md border-gray-200 ml-1">
				<select wire:model="state" wire:change="getStateEs" class="mousetrap outline-none text-gray-500 focus:border-gray-300 hover:border-gray-300 text-gray-500">
					<option value="all">Todos</option>
					<option value="active">Activos</option>
					<option value="inactive">Inactivos</option>
				</select>
			</div>

			<div class="form-input text-sm rounded-md border-gray-200 ml-1">
				<select wire:model="perPage" class="mousetrap outline-none text-gray-500">
					<option value="5">5 por página</option>
					<option value="10">10 por página</option>
					<option value="15">15 por página</option>
					<option value="25">25 por página</option>
					<option value="50">50 por página</option>
					<option value="100">100 por página</option>
					<option value="1000">1000 por página</option>
				</select>
			</div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="px-6 py-4 w-full bg-gray-50">
            <x-buttons.cancel wire:click="clearAllFilters" wire:loading.attr="disabled">
                Cancelar filtros
            </x-buttons.cancel>
            <x-buttons.secondary class="ml-2" wire:click="viewFilters(false)" wire:loading.attr="disabled">
                Cerrar
            </x-buttons.secondary>
        </div>
    </x-slot>
</x-modals.dialog>