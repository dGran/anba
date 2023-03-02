@section('title', 'Log')

@section('content_header')
    <h5 class="content-header-name">
        Notificaciones
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

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@stop

@section('js')
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

    @include('admin.partials.toast_js')
@stop

<div class="py-2"> {{-- slot --}}

    @include('admin.partials.session_messages')

    <div class="bg-white border rounded">
    	<div class="d-flex align-items-center p-3 pb-4">
    		<i class="fab fa-discord text-4xl text-info"></i>
    		<h3 class="ml-3">Discord</h3>
    	</div>
	    <form wire:submit.prevent="update">
	    	<div class="px-3">
		        <div class="text-xs mr-auto pb-2">
			        <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
			            <input type="checkbox" wire:model="active_notifications">
			            <div class="state p-primary d-flex align-items-center">
			                <svg class="svg svg-icon" viewBox="0 0 20 20">
			                    <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
			                </svg>
			                <label class="text-xs text-uppercase tracking-widest ml-1" style="">Notificaciones activas</label>
			            </div>
			        </div>
			    </div>

			    <div class="text-xs mr-auto">
			        <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
			            <input type="checkbox" wire:model="notifications_test_mode">
			            <div class="state p-primary d-flex align-items-center">
			                <svg class="svg svg-icon" viewBox="0 0 20 20">
			                    <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
			                </svg>
			                <label class="text-xs text-uppercase tracking-widest ml-1" style="">Test Mode</label>
			            </div>
			        </div>
			    </div>
	    	</div>

            <div class="pt-3 px-3 @error('name') error @enderror">
                <label class="text-sm text-uppercase tracking-wide">partidos minimos jugados</label>
                <input type="number" class="form-control text-sm" placeholder="Número de partidos mínimos jugados" wire:model="min_played_matches">
                @error('name')
                <p class="text-xs pt-1 m-0">{{ $message }}</p>
                @enderror
            </div>

		    <div class="p-3 mt-3 border-top">
		        <button type="submit" class="btn btn-primary text-xs text-uppercase tracking-widest">
		            Guardar
		        </button>
	        </div>
	    </form>
    </div>

    {{-- right-sidebar --}}
    @if (config('adminlte.right_sidebar'))
        <aside class="hidden control-sidebar control-sidebar-{{ config('adminlte.right_sidebar_theme') }} shadow overflow-auto">
            @include('admin.admin_logs.right-sidebar')
        </aside>
    @endif

</div> {{-- end-slot --}}
