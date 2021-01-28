<div>
	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8">
		@include('match.header')

		@if (!$match->played())

			@include('match.last_matches')

			<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-6">
				<div class="px-4 py-3">
					<p class="uppercase text-sm font-bold tracking-wider">últimos partidos</p>
					<p class="uppercase text-sm font-bold tracking-wider">últimos enfrentamientos</p>
					<p class="uppercase text-sm font-bold tracking-wider">pronósticos</p>
					<p class="uppercase text-sm font-bold tracking-wider">lesionados</p>
					<p class="uppercase text-sm font-bold tracking-wider">top jugadores</p>
				</div>
			</div>
		@endif

		@if ($match->played())
			@include('match.game_tops')
		@endif
	</div>
</div>