@section('title', 'Equipos')

@section('content_header')
    <h5 class="content-header-name">
        Equipos
    </h5>
@stop

@section('css')
    {{-- animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    {{-- Alpine JS --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    {{-- Mouse Trap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.3/mousetrap.min.js"></script>
    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@stop

@section('js')
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

    @include('admin.teams.js')
    @include('admin.partials.js')
@stop

<div class="py-2"> {{-- slot --}}

    @include('admin.partials.session_messages')
    @include('admin.teams.filters')
    @include('admin.teams.table')

    {{-- modals --}}
    @include('admin.teams.modals.add')
    @include('admin.teams.modals.edit')
    @include('admin.teams.modals.filters')
    @include('admin.teams.modals.view')

    @include('admin.partials.modals.destroy')
    @include('admin.partials.modals.duplicate')
    @include('admin.partials.modals.import_table')
    @include('admin.partials.modals.export_table')
    @include('admin.partials.modals.export_selected')
    @include('admin.partials.modals.selected')

    {{-- right-sidebar --}}
    @if (config('adminlte.right_sidebar'))
        <aside class="control-sidebar control-sidebar-{{ config('adminlte.right_sidebar_theme') }} shadow overflow-auto">
            @include('admin.teams.right-sidebar')
        </aside>
    @endif

</div> {{-- end-slot --}}