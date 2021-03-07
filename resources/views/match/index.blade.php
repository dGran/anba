<div>
	@include('layouts.partials.session_messages')
	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8">
		@include('match.header')
		@include('match.reports')

		<div class="mb-8">
			@if (!$match->played())
				@include('match.players_info')
				@include('match.last_matches')
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0">
						@include('match.last_clashes')
					</div>
					<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0">
						@include('match.forecasts')
					</div>
				</div>
			@endif

			@if ($match->played())
				@include('match.boxscore')
				@include('match.match_info')
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6 {{ !$localBoxscoreReport && !$visitorBoxscoreReport ?: 'hidden' }}">
					<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0">
						@include('match.mvp')
					</div>
					<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0">
						@include('match.game_tops')
					</div>
				</div>
				@include('match.localBoxscoreReport')
				@include('match.visitorBoxscoreReport')
			@endif
		</div>
	</div>

	@include('match.scoreReportModal')
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