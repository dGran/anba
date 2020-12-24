<div class="table-wrapper border-t border-gray-200 ">
	<table class="w-full">
		<thead>
			@include('standings.header_content')
		</thead>
		<tbody>
			@foreach ($table_positions as $key => $position)
				<tr class="border-t border-gray-200 text-sm hover:bg-blue-100">
					@include('standings.body_content')
				</tr>
			@endforeach
		</tbody>
	</table>
</div>