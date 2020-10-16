@if ($users->count()>0)
	<table class="min-w-full divide-y divide-gray-200">
		@include('livewire.users.table.table-head')
		@include('livewire.users.table.table-body')
	</table>
@else
	<div class="bg-white px-4 py-3 sm:px-6 text-gray-500 text-sm">
		No hay resultados para la búsqueda "{{ $search }}"
	</div>
@endif