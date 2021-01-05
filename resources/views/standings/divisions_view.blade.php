@foreach ($seasons_divisions as $divfKey => $division)
	<p class="font-semibold text-xl pb-1 {{ $divfKey > 0 ? 'mt-6' : '' }} flex items-center px-3 md:px-0">
		<img src="{{ $division->seasonConference->conference->getImg() }}" alt="{{ $division->seasonConference->conference->name }}" style="width: 48px; height: 48px" class="mr-2">
		{{ $division->name }} Division
	</p>
	<div class="overflow-hidden shadow-md rounded-lg mx-3 md:mx-0">
		<div class="bg-white dark:bg-gray-750 dark:text-white rounded-lg">
			<div class="table-wrapper overflow-x-auto">
				<table class="w-full">
					<thead class="select-none">
						@include('standings.table_header')
					</thead>
					<tbody wire:loading.class="opacity-50">
						@foreach ($table_positions[$divfKey] as $key => $position)
							<tr class="group border-t border-gray-200 dark:border-gray-700 text-sm hover:bg-blue-100 dark:hover:bg-dark-link dark:hover:text-gray-900">
								@include('standings.table_body')
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endforeach