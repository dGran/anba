<div>
	<!-- Page Heading -->
	@include('matches.header')

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
					No existen partidos
				</div>
			@endif
		@else
			<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 w-full p-4">
				No existen temporadas configuradas
			</div>
		@endif
	</div>

	@include('matches.forecasts')
	@include('matches.boxscore')

</div>