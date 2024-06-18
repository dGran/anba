<div class="admin-crud-table-wrapper shadow-sm mt-2">
	@if ($data->count()>0)
		<table class="admin-crud-table {{ !$tableOptions['fixedFirstColumn'] ?: 'fixed-first' }} {{ !$tableOptions['showStriped'] ?: 'striped' }}">
			@include('admin.admin_logs.table.table_head')
			@include('admin.admin_logs.table.table_body')
		</table>
	@else
		<div class="p-3">
			No existen resultados
			@if ($tableFilters['search'] || $tableFilters['user'] !== "all" || $tableFilters['type'] !== "all" || $tableFilters['table'] !== "all" || $tableFilters['perPage'] !== "25")
				con los filtros aplicados
			@endif
		</div>
	@endif
</div>

@include('admin.partials.table.table_footer')
