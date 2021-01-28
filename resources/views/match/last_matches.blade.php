<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-6">
	<div class="px-4 py-3">
		<p class="uppercase text-sm font-bold tracking-wider">últimos partidos</p>

		<div class="grid grid-cols-1 md:grid-cols-2 mt-2">

			{{-- local --}}
			<div class="md:border-r border-gray-150 md:pr-4">

				<div class="flex items-center border-b border-gray-150 pb-1">
					<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" class="w-10 h-10">
					<div class="ml-2">
						<span>{{ $match->localTeam->team->name }}</span>
					</div>
				</div>

				@if ($match->localTeam->lastMatches())
					<div class="mt-2">
						@foreach ($match->localTeam->lastMatches() as $lastMatch)
							<div class="flex flex col">
								<div class="flex items-center text-sm py-1.5">
									<div class="w-10 mr-2">
										@if ($lastMatch->winner()->team_id == $match->localTeam->id)
											<span class="bg-green-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">V</span>
										@else
											<span class="bg-red-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">D</span>
										@endif
									</div>
									<span class="text-right {{ $lastMatch->localTeam->team_id == $match->localTeam->id ? 'font-bold' : '' }}">{{ $lastMatch->localTeam->team->medium_name }}</span>
									<span class="mx-3 border border-gray-300 rounded px-2 py-0.5 bg-gray-100">{{ $lastMatch->score() }}</span>
									<span class="{{ $lastMatch->visitorTeam->team_id == $match->localTeam->id ? 'font-bold' : '' }}">{{ $lastMatch->visitorTeam->team->medium_name }}</span>
								</div>
							</div>
						@endforeach
					</div>
				@endif
			</div>

			{{-- visitor --}}
			<div class="mt-4 md:mt-0 md:ml-4">

				<div class="flex items-center border-b border-gray-150 pb-1">
					<img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->short_name }}" class="w-10 h-10">
					<div class="text-sm ml-2">
						<span class="sm:hidden">{{ $match->visitorTeam->team->medium_name }}</span>
						<span class="hidden sm:block">{{ $match->visitorTeam->team->name }}</span>
					</div>
				</div>

				@if ($match->visitorTeam->lastMatches())
					<div class="mt-2">
						@foreach ($match->visitorTeam->lastMatches() as $lastMatch)
							<div class="flex flex col">
								<div class="flex items-center text-sm py-1.5">
									<div class="w-10 mr-2">
										@if ($lastMatch->winner()->team_id == $match->visitorTeam->id)
											<span class="bg-green-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">V</span>
										@else
											<span class="bg-red-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">D</span>
										@endif
									</div>
									<span class="{{ $lastMatch->localTeam->team_id == $match->visitorTeam->id ? 'font-bold' : '' }}">{{ $lastMatch->localTeam->team->medium_name }}</span>
									<span class="mx-3 border border-gray-300 rounded px-2 py-0.5 bg-gray-100">{{ $lastMatch->score() }}</span>
									<span class="{{ $lastMatch->visitorTeam->team_id == $match->visitorTeam->id ? 'font-bold' : '' }}">{{ $lastMatch->visitorTeam->team->medium_name }}</span>
								</div>
							</div>
						@endforeach
					</div>
				@endif
			</div>

		</div> {{-- grid --}}
	</div>
</div>