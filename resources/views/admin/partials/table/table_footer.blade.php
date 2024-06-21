@if ($data->total() > $perPage)
	<div class="pagination-wrapper">
		{{ $data->links('vendor.pagination.custom') }}
	</div>
@endif
