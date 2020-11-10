@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('css')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    {{-- animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    {{-- Alpine JS --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    {{-- Mouse Trap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.3/mousetrap.min.js"></script>
    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    @include('livewire.partials.admin.js')
@stop

<div class="py-2"> {{-- slot --}}

    @include('livewire.admin.users.filters')

    @include('livewire.admin.users.table')

    @include('livewire.partials.admin.table.table-footer')

    {{-- @include('livewire.admin.users.table.selected-options') --}}

    @include('livewire.admin.users.modals.add')
    @include('livewire.admin.users.modals.edit')
    @include('livewire.admin.users.modals.filters')
    @include('livewire.partials.admin.modals.destroy')
    @include('livewire.partials.admin.modals.selected')
</div> {{-- end-slot --}}

{{-- @section('modals') --}}
{{-- @endsection --}}