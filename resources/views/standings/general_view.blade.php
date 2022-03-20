<div class="overflow-hidden shadow-md rounded-lg mx-3 md:mx-0">
	<div class="bg-white dark:bg-gray-750 dark:text-white rounded-lg">
		<div class="table-wrapper overflow-x-auto | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-transparent hover:scrollbar-thumb-gray-300 | dark:hover:scrollbar-thumb-gray-500">
			<table class="w-full">
				<thead class="select-none">
					@include('standings.table_header')
				</thead>
				<tbody wire:loading.class="opacity-75">
					@foreach ($table_positions as $key => $position)
						<tr class="group border-t border-gray-200 dark:border-gray-700 text-sm hover:bg-blue-100 dark:hover:bg-dark-link dark:hover:text-gray-900">
							@include('standings.table_body')
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
