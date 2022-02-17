<div>
{{-- 	<div class="bg-white dark:bg-gray-750 shadow">
		<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8">
			@include('players.index.breadcrumb')
			<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between | pt-4 lg:pb-4">
	    		@include('players.index.header')
				@include('players.partials.menu', ['routeName' => 'players.index'])
			</div>
    	</div>
	</div> --}}
	<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 my-4 md:my-8">
		@include('players.index.filters')
		<div wire:loading.class="opacity-50">
        	@include('players.index.data')
        </div>
	</div>
</div>
