@foreach ($seasons_conferences as $confKey => $conference)
	<p class="font-semibold text-xl pb-1 {{ $confKey > 0 ? 'mt-4' : '' }} text-gray-800">
		{{ $conference->name }} Conference
	</p>
	<div class="table-wrapper border-t border-gray-200 ">
			<table class="w-full">
				<thead>
					@include('standings.header_content')
				</thead>
				<tbody>
					@foreach ($table_positions[$confKey] as $key => $position)
						<tr class="{{ $loop->iteration == 9 ? 'border-t-2 border-gray-500' : 'border-t border-gray-200' }} text-sm hover:bg-blue-100">
							@include('standings.body_content')
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@endforeach