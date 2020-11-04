

    <div>

{{--         <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tabla: Usuarios') }}
            </h2>
        </x-slot> --}}

        <div class="py-6">

            @include('livewire.partials.flash-messages')

            <div class="flex flex-col">

                    <div class="leading-10">
                        <ul>
                            <li class="inline-block">
                                <a href="#" class="text-blue-500 hover:text-blue-700">Dashboard</a>
                            </li>
                            <li class="inline-block">
                                <span class="text-gray-500 px-1">/</span>
                            </li>
                            <li class="inline-block">
                                <span class="text-gray-500">Usuarios</span>
                            </li>
                        </ul>
                    </div>
                <div class="flex">
                    <h1 class="flex-auto text-3xl mb-4">Usuarios</h1>
                </div>

                @include('livewire.admin.users.filters')

                <div class="-my-2 overflow-x-auto">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="border border-gray-300 overflow-hidden rounded-lg">
                            @include('livewire.admin.users.table')
                        </div>
                    </div>
                </div>

                @include('livewire.partials.admin.table.table-footer')

            </div>
        </div>

        {{-- @include('livewire.admin.users.table.selected-options') --}}

        {{-- modals --}}
        @include('livewire.admin.users.modals.add')
        @include('livewire.admin.users.modals.edit')
        @include('livewire.admin.users.modals.filters')
        @include('livewire.partials.admin.modals.destroy')
        @include('livewire.partials.admin.modals.selected')

        @include('livewire.partials.admin.js')
    </div>
