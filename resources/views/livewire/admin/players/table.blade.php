<div class="admin-crud-table-wrapper shadow-sm mt-2">
	@if ($regs->count()>0)
		<table class="admin-crud-table">
			@include('livewire.admin.players.table.table-head')
			@include('livewire.admin.players.table.table-body')
		</table>
	@else
		<div class="p-3">
			No existen resultados
			@if ($search)
				para la búsqueda <span class="text-primary">"{{ $search }}"</span>
			 @endif
		</div>
	@endif
</div>