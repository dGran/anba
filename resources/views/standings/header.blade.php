	<p class="font-semibold text-2xl pb-1 border-b border-gray-200 dark:border-gray-500">
		Clasificación Liga Regular {{ $current_season ? " - $current_season->name" : '' }}
	</p>
	<div class="filters flex items-center py-4 mb-1 gap-4">
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