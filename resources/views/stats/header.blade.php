<div class="overflow-x-auto">
<div class="-mt-14 ml-32 pt-2 text-sm md:text-base md:-mt-16 md:ml-40 md:pt-1.5 z-40 fixed">
	<ul>
		<li class="inline-block">
			<a href="">Inicio</a>
		</li>
		<li class="inline-block mx-2">/</li>
		<li class="inline-block">
			<a href="">Jugadores</a>
		</li>
		<li class="inline-block mx-2">/</li>
		<li class="inline-block">
			<a href="">Equipos</a>
		</li>
	</ul>
</div>
</div>

<div class="my-2">
	<div class="filters flex items-center select-none overflow-x-auto">
		<div class="flex flex-col">
			<label for="season" class="text-xs uppercase">
				Temporada
			</label>
			<select id="season" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="season">
{{-- 					@foreach ($seasons as $season)
					<option value="{{ $season->slug }}">{{ $season->name }}</option>
				@endforeach --}}
			</select>
		</div>
		<div class="flex flex-col ml-4">
			<label for="phase" class="text-xs uppercase">
				Fase
			</label>
			<select id="phase" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="phase">
				<option value="regular">Liga regular</option>
				<option value="playoffs">Playoffs</option>
			</select>
		</div>
		<div class="flex flex-col ml-4">
			<label for="filter_PJ" class="text-xs uppercase">
				PJ
			</label>
			<input type="number" id="filter_PJ" wire:model="filter_PJ" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none">
		</div>
		<div class="flex flex-col ml-4">
			<label for="filter_SUM_MIN" class="text-xs uppercase">
				MIN
			</label>
			<input type="number" id="filter_SUM_MIN" wire:model="filter_SUM_MIN" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border light:border-gray-300 dark:border-gray-850 light:focus:border-gray-400 light:hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none">
		</div>
	</div>
</div>
