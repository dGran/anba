<div class="flex gap-4 group cursor-pointer" >
	<div class="bg-white dark:bg-gray-750 dark:text-white shadow-md rounded mx-3 md:mx-0 mb-6 w-full lg:w-4/6 group-hover:bg-gray-50 dark:group-hover:bg-gray-700 border border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-550">
		<div class="flex">
			@include('matches.item_main')
			@include('matches.item_leaders')
		</div>
	</div>

	<div class="bg-white dark:bg-gray-750 dark:text-white shadow-md rounded mx-3 md:mx-0 mb-6 w-2/6 hidden lg:block group-hover:bg-gray-50 dark:group-hover:bg-gray-700 border border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-550">
		@include('matches.item_pre_post')
	</div>
</div>