<div>
	<!-- Page Heading -->
	@if (isset($regs))
		@include('matches.header')
	@endif

	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8 my-6 md:mt-0">
		@if (isset($regs))
			@if ($regs->count() > 0)
				@foreach ($regs as $key => $reg)

					@include('matches.item')

				@endforeach
				@if ($regs->total() > $perPage)
					<div class="pagination-wrapper">
						{{ $regs->links('vendor.pagination.tailwind') }}
					</div>
				@endif
			@else
				<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 w-full p-4">
					No se han encontrado partidos
				</div>
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

	@include('matches.forecasts')

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

	    document.addEventListener('livewire:load', function () {
	        Mousetrap.bind("right", function() {
	            @this.setNextPage();
	            return false;
	        });
	        Mousetrap.bind("left", function() {
	            @this.setPreviousPage();
	            return false;
	        });
	    });
	</script>
@endsection