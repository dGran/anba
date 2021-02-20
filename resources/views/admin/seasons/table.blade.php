<div class="admin-crud-table-wrapper shadow-sm mt-2">
	@if ($regs->count()>0)
		<table class="admin-crud-table {{ !$striped ?: 'striped' }}">
			@include('admin.seasons.table.table_head')
			@include('admin.seasons.table.table_body')
		</table>
	@else
		<div class="p-3">
			No existen resultados
			@if ($search || $perPage != "25")
				con los filtros aplicados
			@endif
		</div>
	@endif
</div>

@include('admin.partials.table.table_footer')