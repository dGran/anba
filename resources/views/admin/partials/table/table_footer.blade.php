@if ($regs->total() > $perPage)
	<div class="pagination-wrapper">
		{{ $regs->links('vendor.pagination.custom') }}
	</div>
@endif