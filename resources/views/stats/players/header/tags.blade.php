<div class="my-4 -mx-1 flex items-center">
	@if ($season != $currentSeason->slug)
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="cancel_season_filter">
			{{ $season }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($name)
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('name', null)">
			{{ $name }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($phase != "regular")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('phase', 'regular')">
			{{ $phase }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($mode != "per_game")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('mode', 'per_game')">
			Totales<i class="fas fa-times ml-2"></i>
		</div>
	@endif

	@if ($position != "all")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('position', 'all')">
			{{ $position_text }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($experience != "all")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('experience', 'all')">
			{{ $experience }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($draft_year != "all")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('draft_year', 'all')">
			Draft {{ $draft_year }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($college != "all")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('college', 'all')">
			{{ $college }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($nation != "all")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('nation', 'all')">
			{{ $nation }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif

	@if ($team != "all")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('team', 'all')">
			{{ $team_text }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($division != "all")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('division', 'all')">
			{{ $division_text }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
	@if ($conference != "all")
		<div class="text-xs uppercase | text-gray-400 dark:text-gray-300 | mx-1 px-3 py-1 | rounded | bg-gray-200 dark:bg-gray-700 | border border-transparent | hover:text-blue-500 dark:hover:text-dark-link hover:border-gray-300 dark:hover:border-gray-650 | cursor-pointer" wire:click="$set('conference', 'all')">
			{{ $conference_text }}<i class="fas fa-times ml-2"></i>
		</div>
	@endif
</div>

<div class="pending pb-4 text-sm uppercase text-pretty-red">
	pending
	<ul class="list-disc">
		<li class="list-inside">query experience (subquery)</li>
	</ul>
</div>
