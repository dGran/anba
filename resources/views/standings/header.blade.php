<header class="bg-gray-50 dark:bg-gray-800 shadow border-t border-gray-150 dark:border-gray-850 transition duration-500 ease-in-out">
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
{{-- 		<p class="font-semibold text-base md:text-2xl px-3 md:px-0 py-3">
			{{ $current_season ? "Temporada - $current_season->name" : '' }}
		</p> --}}
		@if (isset($table_positions))
			<div class="filters flex items-center select-none">
				<div class="flex flex-col">
					<label for="season" class="text-xs uppercase">
						Temporada
					</label>
					<select id="season" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="season">
						@foreach ($seasons as $season)
							<option value="{{ $season->slug }}">{{ $season->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="flex flex-col ml-4">
					<label for="view" class="text-xs uppercase">
						Vista
					</label>
					<select id="view" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none" wire:model="view">
						<option value="conference">Conferencia</option>
						<option value="division">División</option>
						<option value="general">General</option>
					</select>
				</div>
			</div>
		@endif
    </div>
</header>