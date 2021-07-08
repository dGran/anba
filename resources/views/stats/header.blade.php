<div class="my-2">

	{{-- work in progress --}}
	<figure class="pb-8">
		<img src="https://lh3.googleusercontent.com/proxy/_50l1kcN9UCAq5pRIlSMM9HEWVLsowAHNmsRLBcQYWCPimaikchXP3T3zAkpu6O9rDp_jQARnMTutDTpMri5vriCUB1Izq6uPwZF7j4f1YmQSmACx8eqLUQkDQnZuBAPbaPmwXxzkLpdMQ" alt="" class="w-64 animate-pulse">
		<figcaption class="italic text-sm">
			*Tanto los datos mostrados como las opciones están en desarrollo
		</figcaption>
	</figure>

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
	</div>
</div>
