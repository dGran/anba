<div>
	<!-- Page Heading -->
	@include('standings.header')

	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8 my-8">
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
			<div class="py-3">
				No existen temporadas configuradas
			</div>
		@endif
	</div>
</div>