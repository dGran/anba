@section('title', 'Jugadores')

@section('content_header')
    <h5 class="content-header-name">
        Jugadores
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
    {{-- Bootstrap Datepicker --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    {{-- ion.rangeSlider --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@stop

@section('js')
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    {{-- ion.rangeSlider --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    @include('livewire.admin.players.js')
    @include('livewire.partials.admin.js')
@stop

<div class="py-2"> {{-- slot --}}

    {{-- for admin log --}}
    {{-- {!! nl2br($test->description) !!} --}}

    @include('livewire.partials.admin.session_messages')
    @include('livewire.admin.players.filters')
    @include('livewire.admin.players.table')

    {{-- modals --}}
    @include('livewire.admin.players.modals.add')
    @include('livewire.admin.players.modals.edit')
    @include('livewire.admin.players.modals.filters')
    @include('livewire.admin.players.modals.transfer')
    @include('livewire.admin.players.modals.view')

    @include('livewire.partials.admin.modals.destroy')
    @include('livewire.partials.admin.modals.duplicate')
    @include('livewire.partials.admin.modals.import_table')
    @include('livewire.partials.admin.modals.export_table')
    @include('livewire.partials.admin.modals.export_selected')
    @include('livewire.partials.admin.modals.selected')

    {{-- right-sidebar --}}
    @if (config('adminlte.right_sidebar'))
        <aside class="control-sidebar control-sidebar-{{ config('adminlte.right_sidebar_theme') }} shadow overflow-auto">
            @include('livewire.admin.players.right-sidebar')
        </aside>
    @endif

</div> {{-- end-slot --}}