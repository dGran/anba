<div>
	<!-- Page Heading -->
	@if (isset($table_positions) || isset($playoff))
		@include('standings.header')
	@endif

	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8 my-6 md:mt-0">
		@if ($phase == 'regular')
			@if (isset($table_positions))
				@if ($view == 'conference')
					@include('standings.conferences_view')
					@if (!$current_season->regular_finished() || $current_season->playoffs->count() == 0)
						@include('standings.current_playoffs')
					@endif
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
		@else
			@include('standings.playoffs')
		@endif

		{{-- temporal --}}
{{--        @hasanyrole('super-admin|admin')--}}
{{--			<div class="py-3">--}}
{{--				<h4 class="pt-1.5 uppercase text-sm tracking-wide font-bold pb-1.5">--}}
{{--					Opciones de Admin--}}
{{--				</h4>--}}
{{--				@if ($phase == "regular")--}}
{{--					<x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 tracking-wide leading-6 mr-3" wire:click="generatePlayoff">--}}
{{--					    generar playoff--}}
{{--					</x-buttons.primary>--}}
{{--				@else--}}
{{--					<x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 tracking-wide leading-6 mr-3" wire:click="generateRounds">--}}
{{--					    generar rondas--}}
{{--					</x-buttons.primary>--}}

{{--					<x-buttons.primary class="uppercase text-xs px-2.5 py-0.5 tracking-wide leading-6 mr-3" wire:click="generateFirstMatches">--}}
{{--					    generar primeros partidos--}}
{{--					</x-buttons.primary>--}}

{{--					<x-buttons.danger class="uppercase text-xs px-2.5 py-0.5 tracking-wide leading-6 mr-3" wire:click="destroyPlayoff">--}}
{{--					    eliminar playoff--}}
{{--					</x-buttons.danger>--}}
{{--				@endif--}}

{{--			</div>--}}
{{--        @endhasanyrole--}}
	</div>

	@include('standings.team_info_modal')

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
