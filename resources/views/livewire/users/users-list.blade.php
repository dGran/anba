<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }} desde Liverwire
        </h2>
    </x-slot>

    {{-- modals --}}
    @include('livewire.users.add')
    @include('livewire.users.edit')

	<button wire:click="add">
		Nuevo usuario
	</button>

    <div class="py-12" wire:offline.class="bg-red-300">
    	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    		<p wire:offline class="pb-4">You are offine...</p>
    		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				<div class="flex flex-col">
					<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
						<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
							<div class="shadow overflow-hidden sm:rounded-lg">
								@include('livewire.users.filters')
								@include('livewire.users.table')
							</div>
						</div>
					</div>
				</div>

    		</div>
    	</div>
    </div>

</div>
