<div class="sm:pt-2 pb-3 overflow-x-auto">
	<div class="flex items-center px-4 sm:px-0 relative">
		<button class="bg-teal-400 text-white active:bg-teal-600 focus:bg-teal-500 hover:bg-teal-500 font-bold uppercase text-sm px-4 py-2 mt-1 rounded-md outline-none focus:outline-none" type="button" style="transition: all .15s ease" wire:click="add">
			Nuevo
		</button>
		<input
			class="search-input outline-none border rounded px-4 py-2 text-sm rounded-md border-gray-200 mt-1 ml-3 block w-full focus:border-gray-300 hover:border-gray-300 text-gray-500"
			wire:model="search"
			type="text"
			placeholder="Buscar...( / )"
			autofocus>
		<figure class="ml-3 w-8">
			<img wire:loading src="https://rivers.mx/img/cargando.gif" alt="loading" class="w-6 h-auto">
		</figure>
		<div class="form-input text-sm rounded-md border-gray-200 mt-1 block ml-3">
			<select wire:model="state" wire:change="getStateEs" class="mousetrap outline-none text-gray-500 focus:border-gray-300 hover:border-gray-300 text-gray-500">
				<option value="all">Todos</option>
				<option value="active">Activos</option>
				<option value="inactive">Inactivos</option>
			</select>
		</div>
		<div class="form-input text-sm rounded-md border-gray-200 mt-1 block ml-3">
			<select wire:model="perPage" class="mousetrap outline-none text-gray-500">
				<option value="5">5 por página</option>
				<option value="10">10 por página</option>
				<option value="15">15 por página</option>
				<option value="25">25 por página</option>
				<option value="50">50 por página</option>
				<option value="100">100 por página</option>
				<option value="1000">1000 por página</option>
			</select>
		</div>
		<button class="rounded-md bg-white border border-gray-200 mt-1 ml-3 focus:outline-none {{ ($search == '' && $perPage == '5' && $state == 'all') ? 'bg-gray-50 text-gray-300 cursor-not-allowed' : 'text-gray-500 cursor-pointer hover:text-gray-900 focus:text-gray-900 hover:border-gray-300 focus:border-gray-300' }}  text-sm px-4 py-2" type="button" style="transition: all .15s ease" wire:click="clearAllFilters" {{ ($search == '' && $perPage == '5' && $state == 'all') ? 'disabled' : '' }}>
			<i class="fas fa-eraser"></i>
		</button>
{{-- 		<button wire:click="clearAllFilters" class="group text-xl rounded-md border-gray-200 mt-1 block ml-3 hover:border-gray-300 focus:border-gray-300 focus:outline-none {{ ($search == '' && $perPage == '5' && $state == 'all') ? 'opacity-25 hover:border-gray-200 focus:border-gray-200' : '' }}"
			{{ ($search == '' && $perPage == '5' && $state == 'all') ? 'disabled' : '' }}>
		</button> --}}

	{{-- 									@if ($search !== '' && $users->count() > 0 )
			<div class="absolute inset-x-0 top-15 border rounded bg-white mx-5 text-gray-500">
				@foreach ($users->take(5)->sortBy('name') as $user)
					<table class="min-w-full divide-y divide-gray-200">

						<tbody class="bg-white divide-y divide-gray-100">
							@foreach ($users as $user)
								<tr>
									<td class="p-2 whitespace-no-wrap">
										<div class="flex items-center">
											<div class="flex-shrink-0 h-10 w-10">
												<img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
											</div>
											<div class="ml-3">
												<div class="text-sm leading-5 font-medium text-gray-900">
													{{ $user->name }}
												</div>
												<div class="text-sm leading-5 text-gray-500">
													{{ $user->email }}
												</div>
											</div>
										</div>
									</td>
								</tr>
							@endforeach

							<!-- More rows... -->
						</tbody>
					</table>
				@endforeach
			</div>
		@endif --}}
	</div>
	@if ($search || $perPage !== "5" || $state !== 'all')
		<div class="flex items-center pt-2 px-4 sm:px-0 gap-2">
			@if ($search)
				<div class="text-xxs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-indigo-100 border border-indigo-200 text-indigo-500 rounded cursor-pointer"
				wire:click="cancelFilterSearch()">
					{{ $search }}
					<i class="fas fa-times ml-2 text-xs"></i>
				</div>
			@endif
			@if ($state !== 'all')
				<div class="text-xxs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-indigo-100 border border-indigo-200 text-indigo-500 rounded-lg cursor-pointer"
				wire:click="cancelFilterState()">
					{{ $state_es }}
					<i class="fas fa-times ml-2 text-xs"></i>
				</div>
			@endif
			@if ($perPage !== "5")
				<div class="text-xxs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-indigo-100 border border-indigo-200 text-indigo-500 rounded-lg cursor-pointer"
				wire:click="cancelFilterPerPage()">
					{{ $perPage }} / página
					<i class="fas fa-times ml-2 text-xs"></i>
				</div>
			@endif
		</div>
	@endif
</div>