@foreach ($seasons_conferences as $confKey => $conference)
	<p class="font-semibold text-xl pb-1 {{ $confKey > 0 ? 'mt-6' : '' }} flex items-center">
		<img src="{{ $conference->conference->getImg() }}" alt="{{ $conference->name }}" style="width: 48px; height: 48px" class="mr-2">
		{{ $conference->name }} Conference
	</p>
	<div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
		<div class="dark:bg-gray-700 dark:text-white dark:border dark:border-gray-800 rounded-lg">
			<div class="table-wrapper border-t border-gray-200">
				<table class="w-full">
					<thead class="select-none">
						@include('standings.header_content')
					</thead>
					<tbody wire:loading.class="opacity-50">
						@foreach ($table_positions[$confKey] as $key => $position)
							<tr class="border-t {{ $loop->iteration == 7 || $loop->iteration == 11 ? 'border-t-2 border-gray-400 dark:border-gray-400' : 'border-gray-200 dark:border-gray-600' }} text-sm hover:bg-blue-100 dark:hover:bg-blue-500">
								@include('standings.body_content')
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endforeach