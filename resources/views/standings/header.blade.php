<header class="">
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 border-b md:border-b-0 border-gray-300 dark:border-gray-650">
		@if (isset($table_positions) || isset($playoff))
			<div class="my-2">
				<div class="filters flex items-center select-none overflow-x-auto">
					<div class="flex flex-col">
						<label for="season" class="text-xs uppercase">
							Temporada
						</label>
						<select id="season" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="season">
							@foreach ($seasons as $season)
								<option value="{{ $season->slug }}">{{ $season->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="flex flex-col ml-4">
						<label for="phase" class="text-xs uppercase">
							Fase
						</label>
						<select id="phase" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="phase">
							<option value="regular">Liga regular</option>
							@foreach ($season->playoffs->sortBy('order') as $playoff)
								<option value="{{ $playoff->id }}">{{ $playoff->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="flex flex-col ml-4 {{ $phase != 'regular' ? 'hidden' : '' }}">
						<label for="view" class="text-xs uppercase">
							Vista
						</label>
						<select id="view" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="view">
							<option value="conference">Conferencia</option>
							<option value="division">División</option>
							<option value="general">General</option>
						</select>
					</div>
				</div>
			</div>
		@endif
    </div>
</header>