<div class="admin-crud-table-wrapper shadow-sm mt-2">
	@if ($regs->count()>0)
		<table class="admin-crud-table {{ !$striped ?: 'striped' }}">
			@include('livewire.admin.conferences.table.table_head')
			@include('livewire.admin.conferences.table.table_body')
		</table>
	@else
		<div class="p-3">
			No existen resultados
			@if ($search || $filterActive != "all" || $perPage != "10")
				con los filtros aplicados
			@endif
		</div>
	@endif
</div>

@include('livewire.partials.admin.table.table_footer')