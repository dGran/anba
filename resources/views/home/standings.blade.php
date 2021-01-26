<div class="bg-white dark:bg-gray-700 overflow-hidden text-gray-900 dark:text-gray-200 py-3 md:shadow-md md:rounded-md">
	@if ($season)
		@foreach ($seasons_conferences as $confKey => $conference)
			<p class="font-semibold text-xl {{ $confKey > 0 ? 'mt-3 border-t border-gray-200 dark:border-gray-650 pt-2' : '' }} flex items-center px-4 pb-2">
				<img src="{{ $conference->conference->getImg() }}" alt="{{ $conference->name }}" class="mr-1.5 w-8 h-8 object-cover">
				{{ $conference->name }} Conference
			</p>
			<div class="rounded-lg">
				<div class="table-wrapper">
					<table class="w-full">
						<thead class="select-none">
							@include('home.standings.table_header')
						</thead>
						<tbody>
							@foreach (array_slice($table_positions[$confKey], 0, 8) as $key => $position)
								<tr class="group border-t border-gray-200 dark:border-gray-650 text-sm">
									@include('home.standings.table_body')
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		@endforeach
	@else
		<p class="px-4 py-2">
			Temporada actual no encontrada
		</p>
	@endif
</div>