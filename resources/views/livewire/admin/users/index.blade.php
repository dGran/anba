<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabla: Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-3">
    	<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

    		@include('livewire.partials.flash-messages')

			<div class="flex flex-col">

				@include('livewire.admin.users.filters')

				<div class="-my-2 overflow-x-auto">
					<div class="py-2 align-middle inline-block min-w-full">
						<div class="border border-gray-200 overflow-hidden rounded-lg">
							@include('livewire.admin.users.table')
						</div>
					</div>
				</div>

				@include('livewire.partials.admin.table.table-footer')

			</div>

    	</div>
    </div>

    {{-- @include('livewire.admin.users.table.selected-options') --}}

    {{-- modals --}}
    @include('livewire.admin.users.modals.add')
    @include('livewire.admin.users.modals.edit')
    @include('livewire.admin.users.modals.filters')
    @include('livewire.partials.admin.modals.destroy')
    @include('livewire.partials.admin.modals.selected')

</div>

@include('livewire.partials.admin.js')
<script>
    // dedicated js
</script>
