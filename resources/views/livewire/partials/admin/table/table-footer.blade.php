@if ($regs->total() > $perPage)
	<div class="pt-3">
		{{ $regs->links() }}
	</div>
@endif