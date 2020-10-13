@if ($users->count()>0)
	<table class="min-w-full divide-y divide-gray-200">
		@include('livewire.users.table-head')
		@include('livewire.users.table-body')
	</table>
@else
	<div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 text-gray-500 text-sm">
		No hay resultados para la búsqueda "{{ $search }}"
	</div>
@endif