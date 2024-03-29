<div class="flex group">
	<div class="bg-white dark:bg-gray-750 dark:text-white shadow-md rounded mx-3 md:mx-0 mb-6 w-full lg:w-4/6 group-hover:bg-gray-50 dark:group-hover:bg-gray-700 border border-gray-150 dark:border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-550" wire:loading.class="opacity-75">
		<div class="flex">
			@include('matches.item_main')
			@include('matches.item_leaders')
		</div>
	</div>

	<div class="ml-4 bg-white dark:bg-gray-750 dark:text-white shadow-md rounded mb-6 w-2/6 hidden lg:block group-hover:bg-gray-50 dark:group-hover:bg-gray-700 border border-gray-150 dark:border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-550" wire:loading.class="opacity-75">
		@include('matches.item_pre_post')
	</div>
</div>