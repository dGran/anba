@if ($regs->total() > $perPage)
	<div class="px-4 sm:px-0 pt-3">
		{{ $regs->links() }}
	</div>
@endif