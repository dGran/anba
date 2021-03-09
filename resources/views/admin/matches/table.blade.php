<div class="admin-crud-table-wrapper shadow-sm mt-2">
	@if ($regs->count()>0)
		<table class="admin-crud-table {{ !$fixedFirstColumn ?: 'fixed-first' }} {{ !$striped ?: 'striped' }}">
			@include('admin.matches.table.table_head')
			@include('admin.matches.table.table_body')
		</table>
	@else
		<div class="p-3">
			No existen resultados
			@if ($search || $filterTeam != "all" || $filterUser != "all" || $filterPlayed != "all" || $filterTeamStats != "all" || $filterPlayerStats != "all" || $perPage != "25")
				con los filtros aplicados
			@endif
		</div>
	@endif
</div>

@include('admin.partials.table.table_footer')