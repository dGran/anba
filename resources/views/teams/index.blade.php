<div>
	<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 my-4 md:my-8">

			@foreach ($season->conferences as $seasonConference)
				<p class="text-3xl font-bold">
					{{ $seasonConference->conference->name }} conference
				</p>
				@foreach ($seasonConference->divisions as $seasonDivision)
					<p class="text-xl font-bold">
						{{ $seasonDivision->division->name }} division
					</p>
    				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 py-3">
						@foreach ($seasonDivision->teams as $seasonTeam)
				    		<a href="{{ route('team', [$seasonTeam, $seasonTeam->team->slug]) }}" class="rounded-md md:rounded-full p-3 opacity-75 hover:opacity-100 focus:opacity-100 transition duration-150 ease-in-out relative focus:outline-none border border-transparent focus:border-black dark:focus:border-white hover:border-black dark:hover:border-white" style="background-color: {{ $seasonTeam->team->color }}">
				    			<div class="flex items-center">
				    				<img src="{{ $seasonTeam->team->getImg() }}" alt="{{ $seasonTeam->team->medium_name }}" class="w-20 h-20 object-cover border rounded-full bg-white p-1">
				    				<div class="flex flex-col text-white">
				    					<p class="font-bold text-xl ml-3" style="color: {{ $seasonTeam->team->color }}">{{ $seasonTeam->team->name }}</p>
				    					<p class="text-sm ml-3">Manager: {{ $seasonTeam->team->user->name }}</p>
				    				</div>
				    			</div>
				    		</a>

						@endforeach
					</div>
				@endforeach

			@endforeach

{{-- 			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
			@foreach ($teams as $seasonTeam)
		    		<a href="{{ route('team', [$seasonTeam, $seasonTeam->team->slug]) }}" class="rounded-md md:rounded-full p-3 opacity-75 hover:opacity-100 focus:opacity-100 transition duration-150 ease-in-out relative focus:outline-none border border-transparent focus:border-black dark:focus:border-white hover:border-black dark:hover:border-white" style="background-color: {{ $seasonTeam->team->color }}">
		    			<div class="flex items-center">
		    				<img src="{{ $seasonTeam->team->getImg() }}" alt="{{ $seasonTeam->team->medium_name }}" class="w-20 h-20 object-cover border rounded-full bg-white p-1">
		    				<div class="flex flex-col text-white">
		    					<p class="font-bold text-xl ml-3" style="color: {{ $seasonTeam->team->color }}">{{ $seasonTeam->team->name }}</p>
		    					<p class="text-sm ml-3">Manager: {{ $seasonTeam->team->user->name }}</p>
		    				</div>
		    			</div>
		    		</a>
			@endforeach
			</div> --}}

	</div>
</div>
