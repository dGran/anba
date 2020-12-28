<div class="table-wrapper border-t border-gray-200 ">
	<table class="w-full">
		<thead class="select-none">
			@include('standings.table_header')
		</thead>
		<tbody wire:loading.class="opacity-50">
			@foreach ($table_positions as $key => $position)
				<tr class="border-t border-gray-200 text-sm hover:bg-blue-100">
					@include('standings.table_body')
				</tr>
			@endforeach
		</tbody>
	</table>
</div>