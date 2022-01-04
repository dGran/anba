<div>

	<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 my-4 md:my-8">

		@include('team.partials.menu', ['routeName' => 'team.leaders'])

        @include('team.leaders.data')

		@include('team.partials.footer', ['route' => 'team.leaders'])

	</div>

	@include('team.partials.player_info_modal')

</div>

