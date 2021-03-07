<div>
	<!-- Page Heading -->
	@if (isset($table_positions))
		@include('standings.header')
	@endif

	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8 my-6 md:mt-0">
		@if (isset($table_positions))
			@if ($view == 'conference')
				@include('standings.conferences_view')
			@endif
			@if ($view == 'division')
				@include('standings.divisions_view')
			@endif
			@if ($view == 'general')
				@include('standings.general_view')
			@endif
		@else
			<div class="px-4 md:px-0 md:pt-4 h-screen md:h-auto">
				<h3 class="font-bold text-3xl">
					Ups!
				</h3>
				No existen temporadas configuradas, contacta con los administradores o espera a que se actualice el contenido.
			</div>
		@endif
	</div>
</div>

@section('js')
	<script>
	    window.livewire.onError(statusCode => {
	        if (statusCode === 419) {
	            toastr.options = {
	                "positionClass": "toast-top-center",
	                "closeButton": false,
	                "timeOut": "1000",
	            };
	            toastr.options.onHidden = function() {
	                window.location.href=window.location.href;
	            }
	            toastr.info('Recargando página por inactividad');
	            return false;
	        }
	    });
	</script>
@endsection