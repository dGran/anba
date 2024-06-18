@if ($data->total() > $filters['perPage'])
	<div class="pagination-wrapper">
		{{ $data->links('vendor.pagination.custom') }}
	</div>
@endif
