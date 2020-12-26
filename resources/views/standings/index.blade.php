<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

{{-- 	<p class="font-semibold text-2xl pb-1 border-b border-gray-200 dark:border-gray-500">
		Clasificación Liga Regular {{ $current_season ? " - $current_season->name" : '' }}
	</p> --}}
	@if (isset($table_positions))
		<div class="filters flex items-center pb-6 mb-1 gap-4">
			<div class="flex flex-col">
				<label for="season" class="text-xs uppercase">
					Temporada
				</label>
				<select id="season" class="rounded py-1 px-3 text-sm bg-white dark:bg-gray-600 border dark:border-gray-700 mt-1 appearance-none hover:bg-gray-100 dark:hover:bg-gray-600" wire:model="season">
					@foreach ($seasons as $season)
						<option value="{{ $season->slug }}">{{ $season->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="flex flex-col">
				<label for="season" class="text-xs uppercase">
					Vista
				</label>
				<select id="season" class="rounded py-1 px-3 text-sm bg-white border mt-1 appearance-none hover:bg-gray-100" wire:model="view">
					<option value="conference">Conferencia</option>
					<option value="division">División</option>
					<option value="general">General</option>
				</select>
			</div>
		</div>

		@if ($view == 'conference')
			@include('standings.conferences_view')
		@endif
		@if ($view == 'division')
			@include('standings.divisions_view')
		@endif
		@if ($view == 'general')
			@include('standings.general_view')
		@endif

	@else
		<div class="py-3">
			No existen temporadas configuradas
		</div>
	@endif

</div>