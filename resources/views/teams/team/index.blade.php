<div>

	<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 my-4 md:my-8">

		@include('teams.team.menu')

		@switch($op)
		    @case('roster')
		        @include('teams.team.roster')
		        @break
		    @case('leaders')
		        @include('teams.team.leaders')
		        @break
		    @case('team_stats')
		        @include('teams.team.team_stats')
		        @break
		    @case('player_stats')
		        @include('teams.team.player_stats')
		        @break
		    @default
	            @include('teams.team.roster')
		@endswitch

	    <div class="flex items-center justify-between space-x-2 | mt-10 pt-4 px-3 sm:px-0 | overflow-x-auto">
	        @foreach ($currentSeason->teams as $seasonTeam)
	        	<a href="{{ route('team', $seasonTeam->team->slug) }}" class="{{ $seasonTeam->team->id == $team->id ? 'hidden' : '' }} flex flex-col text-xs text-center | select-none | focus:outline-none">
	                <img src="{{ $seasonTeam->team->getImg() }}" alt="" class="w-8 h-8 object-cover" style="min-width: 2rem;">
	                <p>
	                    {{ $seasonTeam->team->short_name }}
	                </p>
	            </a>
	        @endforeach
	    </div>
	</div>

	@include('teams.team.player_info_modal')

</div>

