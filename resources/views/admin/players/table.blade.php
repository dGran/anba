<div class="admin-crud-table-wrapper shadow-sm mt-2">
	@if ($regs->count()>0)
		<table class="admin-crud-table {{ !$fixedFirstColumn ?: 'fixed-first' }} {{ !$striped ?: 'striped' }}">
			@include('admin.players.table.table_head')
			@include('admin.players.table.table_body')
		</table>
	@else
		<div class="p-3">
			No existen resultados
			@if ($search || $filterPosition != "all" || $filterTeam != "all" || $filterNation != "all" || $filterAge != ['from' => 15, 'to' => 45] || $filterHeight != ['from' => 5, 'to' => 8] || $filterWeight != ['from' => 125, 'to' => 500] || $filterYearDraft != ['from' => 1995, 'to' => 2020] || $filterCollege != "all" || $filterRetired != "all" || $filterOutNBA != "all" || $perPage != "25")
				con los filtros aplicados
			@endif
		</div>
	@endif
</div>

@include('admin.partials.table.table_footer')