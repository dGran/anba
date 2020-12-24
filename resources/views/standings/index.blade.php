<div class="p-4">
	<p class="font-semibold text-2xl pb-1 border-b border-gray-200 text-gray-800">
		Clasificación Liga Regular - {{ $season->name }}
	</p>
	{{-- @if (isset($table_positions)) --}}
		<div class="filters flex items-center py-4 mb-1 gap-4">
			<div class="flex flex-col">
				<label for="season" class="text-xs uppercase">
					Temporada
				</label>
				<select id="season" class="rounded py-1 px-3 text-sm bg-white border mt-1 appearance-none hover:bg-gray-100">
					<option value="">Season 2020-2021</option>
				</select>
			</div>
			<div class="flex flex-col">
				<label for="season" class="text-xs uppercase">
					Vista
				</label>
				<select id="season" class="rounded py-1 px-3 text-sm bg-white border mt-1 appearance-none hover:bg-gray-100" wire:model="view">
					<option value="conferencia">Conferencia</option>
					<option value="division">División</option>
					<option value="general">General</option>
				</select>
			</div>
		</div>
		@if ($view == 'conferencia')
			@include('standings.conferences_view')
		@endif
		@if ($view == 'division')
			@include('standings.divisions_view')
		@endif
		@if ($view == 'general')
			@include('standings.general_view')
		@endif

{{-- 	@else
		<div class="py-3">
			No existen temporadas configuradas
		</div>
	@endif --}}
</div>
