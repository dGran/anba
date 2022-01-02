<div>

	<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 my-4 md:my-8">

		{{-- work in progress mark... --}}
		{{-- <h4 class="px-3 sm:px-0 pb-3 text-pretty-red text-2xl">Work in progress...</h4> --}}
		{{-- work in progress mark... --}}

		@include('team.partials.menu')

        @include('team.leaders.data')

	    <div class="flex items-center justify-between space-x-2 | mt-10 pt-4 px-3 sm:px-0 | overflow-x-auto">
	        @foreach ($currentSeason->teams as $seasonTeam)
	        	<a href="{{ route('team.leaders', $seasonTeam->team->slug) }}" class="{{ $seasonTeam->team->id == $team->id ? 'hidden' : '' }} flex flex-col text-xs text-center | select-none | focus:outline-none">
	                <img src="{{ $seasonTeam->team->getImg() }}" alt="" class="w-8 h-8 object-cover" style="min-width: 2rem;">
	                <p>
	                    {{ $seasonTeam->team->short_name }}
	                </p>
	            </a>
	        @endforeach
	    </div>
	</div>

</div>

