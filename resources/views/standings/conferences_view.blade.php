@foreach ($seasons_conferences as $confKey => $conference)
	<p class="font-semibold text-xl pb-1 {{ $confKey > 0 ? 'mt-6' : '' }} flex items-center px-3 md:px-0">
		<img src="{{ $conference->conference->getImg() }}" alt="{{ $conference->name }}" style="width: 48px; height: 48px" class="mr-2">
		{{ $conference->name }} Conference
	</p>
	<div class="overflow-hidden shadow-xl rounded-lg mx-3 md:mx-0">
		<div class="bg-white dark:bg-gray-750 dark:text-white rounded-lg">
			<div class="table-wrapper overflow-x-auto">
				<table class="w-full">
					<thead class="select-none">
						@include('standings.table_header')
					</thead>
					<tbody wire:loading.class="opacity-50">
						@foreach ($table_positions[$confKey] as $key => $position)
							<tr class="group border-t {{ $loop->iteration == 7 || $loop->iteration == 11 ? 'border-t-2 border-gray-400 dark:border-gray-600' : 'border-gray-200 dark:border-gray-700' }} text-sm hover:bg-blue-100 dark:hover:bg-dark-link dark:hover:text-gray-900">
								@include('standings.table_body')
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endforeach