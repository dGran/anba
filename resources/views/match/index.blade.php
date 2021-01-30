<div>
	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8">
		@include('match.header')

		<div class="mb-8">
			@if (!$match->played())
				@include('match.reports')

				@include('match.players_info')

				@include('match.last_matches')
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0">
						@include('match.last_clashes')
					</div>
					<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0">
						@include('match.forecasts')
					</div>
				</div>
			@endif

			@if ($match->played())
				@include('match.match_info')
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
					<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0">
						@include('match.mvp')
					</div>
					<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0">
						@include('match.game_tops')
					</div>
				</div>
			@endif
		</div>
	</div>
</div>