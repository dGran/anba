<div>
	<div class="bg-white dark:bg-gray-750 shadow">
		<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8">
			@include('team.partials.breadcrumb')
			<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between | pt-4 lg:pb-4">
	    		@include('team.partials.header')
				@include('team.partials.menu', ['routeName' => 'team.team_stats'])
			</div>
    	</div>
	</div>
	<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 my-4 md:my-8">
		@include('team.partials.more_teams', ['route' => 'team.team_stats'])
        @include('team.team_stats.data')
	</div>
</div>

