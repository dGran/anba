<div class="bg-white dark:bg-gray-750 border-b md:border-b-0 border-gray-150 dark:border-gray-900 md:shadow-md md:rounded md:mt-8">
	<div class="flex items-center justify-center px-4 py-4">
		<div class="flex-1">
			<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" class="mx-auto w-24 h-24 md:w-44 md:h-44 lg:w-60 lg:h-60">
			<div class="text-base md:text-xl lg:text-2xl text-center">
				<span class="sm:hidden">{{ $match->localTeam->team->medium_name }}</span>
				<span class="hidden sm:block">{{ $match->localTeam->team->name }}</span>
			</div>
			<div class="text-sm md:text-base lg:text-xl text-center light:text-gray-500 dark:text-gray-300">{{ $match->localTeam->team->user ? $match->localTeam->team->user->name : 'sin manager' }}</div>
		</div>
		<div class="flex-initial px-3 md:px-6">
			<p class="text-center font-bold text-3xl md:text-5xl lg:text-6xl">{{ $match->score() }}</p>
			@if ($match->played())
				<p class="text-center hidden md:block uppercase text-base text-pretty-red font-bold">
					{{ $match->stadium }}
				</p>
				<p class="text-center hidden md:block uppercase text-sm text-gray-600 dark:text-gray-300">
					<span class="text-xs">{{ $match->scores->first()->getUpdatedAt() }}</span>
				</p>
			@endif
		</div>
		<div class="flex-1">
			<img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->short_name }}" class="mx-auto w-24 h-24 md:w-44 md:h-44 lg:w-60 lg:h-60">
			<div class="text-base md:text-xl lg:text-2xl text-center">
				<span class="sm:hidden">{{ $match->visitorTeam->team->medium_name }}</span>
				<span class="hidden sm:block">{{ $match->visitorTeam->team->name }}</span>
			</div>
			<div class="text-sm md:text-base lg:text-xl text-center light:text-gray-500 dark:text-gray-300">{{ $match->visitorTeam->team->user ? $match->visitorTeam->team->user->name : 'sin manager' }}</div>
		</div>
	</div>
	@if ($match->played())
		<div class="md:hidden text-center px-4 py-2 flex flex-col items-center md:flex-row justify-between border-t text-center border-gray-150 dark:border-gray-650">
			<p class="text-center uppercase text-base text-pretty-red font-bold">
				{{ $match->stadium }}
			</p>
			<p class="text-center text-sm text-gray-600 dark:text-gray-300">
				<span class="text-xs">{{ $match->scores->first()->getUpdatedAt() }}</span>
			</p>
		</div>
	@endif
</div>