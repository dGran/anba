@php use App\Enum\TableFilters; @endphp

<div class="admin-crud-table-wrapper shadow-sm mt-2">
	@if ($data->count()>0)
		<table class="admin-crud-table {{ !$isFixedFirstColumn ?: 'fixed-first' }} {{ !$isShowStriped ?: 'striped' }}">
			@include('admin.admin_logs.table.table_head')
			@include('admin.admin_logs.table.table_body')
		</table>
	@else
		<div class="p-3">
			No existen resultados

			@if (
                $search !== TableFilters::VALUE_NULL_STRING
                || $user !== TableFilters::VALUE_ALL
                || $type !== TableFilters::VALUE_ALL
                || $table !== TableFilters::VALUE_ALL
                || $perPage !== TableFilters::PER_PAGE_DEFAULT_VALUE
            )
				con los filtros aplicados
			@endif
		</div>
	@endif
</div>

@include('admin.partials.table.table_footer')
