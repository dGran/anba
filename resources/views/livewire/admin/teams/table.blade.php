<div class="admin-crud-table-wrapper shadow-sm">
	@if ($regs->count()>0)
		<table class="admin-crud-table">
			@include('livewire.admin.teams.table.table-head')
			@include('livewire.admin.teams.table.table-body')
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