<div class="admin-crud-table-wrapper shadow-sm mt-2">
	@if ($regs->count()>0)
		<table class="admin-crud-table {{ !$fixedFirstColumn ?: 'fixed-first' }} {{ !$striped ?: 'striped' }}">
			@include('livewire.admin.divisions.table.table_head')
			@include('livewire.admin.divisions.table.table_body')
		</table>
	@else
		<div class="p-3">
			No existen resultados
			@if ($search || $filterConference != "all" || $filterActive != "all" || $perPage != "10")
				con los filtros aplicados
			@endif
		</div>
	@endif
</div>

@include('livewire.partials.admin.table.table_footer')