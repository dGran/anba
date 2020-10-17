<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabla: Usuarios') }}
        </h2>
    </x-slot>

{{--     @foreach ($selected_regs as $reg)
        <p>{{ $reg }}</p>
    @endforeach --}}

    <div class="pt-8 {{ $users_selected->count() > 0 ? 'pb-32' : 'pb-8' }}">
    	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    		@include('livewire.partials.flash-messages')

			<div class="flex flex-col">
				@include('livewire.users.filters')
				<div class="-my-2 overflow-x-auto">
					<div class="py-2 align-middle inline-block min-w-full">
						<div class="border border-gray-200 overflow-hidden sm:rounded-lg">
							@include('livewire.users.table')
						</div>
					</div>
				</div>
				@include('livewire.users.table.table-footer')
			</div>

    	</div>
    </div>

    @include('livewire.users.table.selected-regs')

    {{-- modals --}}
    @include('livewire.users.modals.add')
    @include('livewire.users.modals.edit')
    @include('livewire.users.modals.destroy')
    @include('livewire.users.modals.selected')

</div>

<script>
    Mousetrap.bind('/', function() {
        $('.search-input').focus();
        $('.search-input').select();
        return false;
    });

    document.addEventListener('livewire:load', function () {
        Mousetrap.bind('esc', function() {
            @this.cancelSelection();
        });
    });
</script>
