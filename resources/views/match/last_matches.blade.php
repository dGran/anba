<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0 my-6">
	<div class="px-4 py-3">
		<p class="uppercase text-sm font-bold tracking-wider pb-3">últimos partidos</p>

		<div class="grid grid-cols-1 md:grid-cols-2">

			{{-- local --}}
			<div class="md:border-r border-gray-150 dark:border-gray-650 md:pr-4">

				<div class="flex items-center pb-1">
					<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" class="w-10 h-10">
					<div class="ml-2">
						<span>{{ $match->localTeam->team->name }}</span>
					</div>
				</div>

				@if ($match->localTeam->lastMatches()->count() > 0)
					@foreach ($match->localTeam->lastMatches() as $lastMatch)
						<div class="flex flex col">
							<div class="flex items-center justify-between text-sm py-2.5 w-full border-t border-gray-150 dark:border-gray-650">
								<div class="flex-1 flex items-center">
									<div class="flex-1 truncate flex items-center justify-end">
										<span class="sm:hidden">{{ $lastMatch->localTeam->team->short_name }}</span>
										<span class="hidden sm:block">{{ $lastMatch->localTeam->team->medium_name }}</span>
										@if ($lastMatch->localTeam->id == $match->localTeam->id)
											<div class="w-6 ml-2">
												@if ($lastMatch->winner() && $lastMatch->winner()->id == $match->localTeam->id)
													<span class="bg-green-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">V</span>
												@else
													<span class="bg-red-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">D</span>
												@endif
											</div>
										@endif
									</div>

									<a href="{{ route('match', $lastMatch->id) }}" class="flex-0 flex flex-col mx-3 rounded px-2 py-0.5 w-20 text-center bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-transparent | hover:bg-white focus:bg-white focus:outline-none dark:hover:bg-dark-link dark:hover:text-gray-900 dark:focus:bg-dark-link dark:focus:text-gray-900">
										<span class="">{{ $lastMatch->score() }}</span>
									</a>

									<div class="flex-1 truncate flex items-center justify-start">
										@if ($lastMatch->visitorTeam->id == $match->localTeam->id)
											<div class="w-6 mr-2">
												@if ($lastMatch->winner() && $lastMatch->winner()->id == $match->localTeam->id)
													<span class="bg-green-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">V</span>
												@else
													<span class="bg-red-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">D</span>
												@endif
											</div>
										@endif
										<span class="sm:hidden">{{ $lastMatch->visitorTeam->team->short_name }}</span>
										<span class="hidden sm:block">{{ $lastMatch->visitorTeam->team->medium_name }}</span>
									</div>
									{{-- <span class="flex-1 text-left truncate {{ $lastMatch->visitorTeam->team_id == $match->localTeam->id ? 'font-bold' : '' }}">{{ $lastMatch->visitorTeam->team->medium_name }}</span> --}}
								</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="text-sm py-2.5 w-full border-t border-gray-150 dark:border-gray-650 text-gray-500 dark:text-gray-300">
						No hay partidos disputados
					</div>
				@endif
			</div>

			{{-- visitor --}}
			<div class="md:pl-4 pt-3 md:pt-0">

				<div class="flex items-center pb-1">
					<img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->short_name }}" class="w-10 h-10">
					<div class="ml-2">
						<span>{{ $match->visitorTeam->team->name }}</span>
					</div>
				</div>

				@if ($match->visitorTeam->lastMatches()->count() > 0)
					@foreach ($match->visitorTeam->lastMatches() as $lastMatch)
						<div class="flex flex col">
							<div class="flex items-center justify-between text-sm py-2.5 w-full border-t border-gray-150 dark:border-gray-650">
								<div class="flex-1 flex items-center">
									<div class="flex-1 truncate flex items-center justify-end">
										<span class="sm:hidden">{{ $lastMatch->localTeam->team->short_name }}</span>
										<span class="hidden sm:block">{{ $lastMatch->localTeam->team->medium_name }}</span>
										@if ($lastMatch->localTeam->id == $match->visitorTeam->id)
											<div class="w-6 ml-2">
												@if ($lastMatch->winner() && $lastMatch->winner()->id == $match->visitorTeam->id)
													<span class="bg-green-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">V</span>
												@else
													<span class="bg-red-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">D</span>
												@endif
											</div>
										@endif
									</div>

									<a href="{{ route('match', $lastMatch->id) }}" class="flex-0 flex flex-col mx-3 rounded px-2 py-0.5 w-20 text-center bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-transparent | hover:bg-white focus:bg-white focus:outline-none dark:hover:bg-dark-link dark:hover:text-gray-900 dark:focus:bg-dark-link dark:focus:text-gray-900">
										<span class="">{{ $lastMatch->score() }}</span>
									</a>

									<div class="flex-1 truncate flex items-center justify-start">
										@if ($lastMatch->visitorTeam->id == $match->visitorTeam->id)
											<div class="w-6 mr-2">
												@if ($lastMatch->winner() && $lastMatch->winner()->id == $match->visitorTeam->id)
													<span class="bg-green-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">V</span>
												@else
													<span class="bg-red-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">D</span>
												@endif
											</div>
										@endif
										<span class="sm:hidden">{{ $lastMatch->visitorTeam->team->short_name }}</span>
										<span class="hidden sm:block">{{ $lastMatch->visitorTeam->team->medium_name }}</span>
									</div>
									{{-- <span class="flex-1 text-left truncate {{ $lastMatch->visitorTeam->team_id == $match->localTeam->id ? 'font-bold' : '' }}">{{ $lastMatch->visitorTeam->team->medium_name }}</span> --}}
								</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="text-sm py-2.5 w-full border-t border-gray-150 dark:border-gray-650 text-gray-500 dark:text-gray-300">
						No hay partidos disputados
					</div>
				@endif
			</div>

		</div> {{-- grid --}}
	</div>
</div>
