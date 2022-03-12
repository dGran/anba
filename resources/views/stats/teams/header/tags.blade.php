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
</div>
