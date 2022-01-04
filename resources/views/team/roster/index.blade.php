<div>

	<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 my-4 md:my-8">

		{{-- work in progress mark... --}}
		{{-- <h4 class="px-3 sm:px-0 pb-3 text-pretty-red text-2xl">Work in progress...</h4> --}}
		{{-- work in progress mark... --}}

		@include('team.partials.menu', ['routeName' => 'team.roster'])

        @include('team.roster.data')

        @include('team.partials.footer', ['route' => 'team.roster'])

	</div>

	@include('team.partials.player_info_modal')

</div>

