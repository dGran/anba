@if ($data->total() > $tableFilters['perPage'])
	<div class="pagination-wrapper">
		{{ $data->links('vendor.pagination.custom') }}
	</div>
@endif
