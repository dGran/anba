<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-6">
	<p class="text-center px-4 pt-3 flex flex-col items-center md:flex-row justify-between border-b mb-2 pb-2 text-center border-gray-150">
		<span class="text-sm md:text-base lg:text-xl uppercase tracking-wide">
			{{ $match->stadium }}
		</span>
		@if ($match->played())
			<span class="text-xs">{{ $match->scores->first()->getUpdatedAt() }}</span>
		@endif
	</p>
	<div class="flex items-center justify-center px-4 pb-4">
		<div class="flex-1">
			<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" class="mx-auto w-24 h-24 md:w-44 md:h-44 lg:w-60 lg:h-60">
			<div class="text-base md:text-xl lg:text-2xl text-center">
				<span class="sm:hidden">{{ $match->localTeam->team->medium_name }}</span>
				<span class="hidden sm:block">{{ $match->localTeam->team->name }}</span>
			</div>
			<div class="text-sm md:text-base lg:text-xl text-center light:text-gray-500 dark:text-gray-300">{{ $match->localTeam->team->user ? $match->localTeam->team->user->name : 'sin manager' }}</div>
		</div>
		<div class="flex-initial px-3 md:px-8">
			<p class="font-bold text-3xl md:text-5xl lg:text-6xl">{{ $match->score() }}</p>
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
</div>