<div class="pt-2 pb-3">
	<div class="flex items-center bg-white px-4 sm:px-6 relative">
{{-- 		<button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-3 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease"
		wire:click="add">
			<i class="fas fa-plus"></i>
		</button> --}}
		<button wire:click="add" class="text-3xl mt-1 block focus:outline-none">
			<i class="fas fa-plus-circle text-teal-500"></i>
		</button>
		<input
			class="search-input outline-none border rounded px-4 py-2 text-sm rounded-md border-gray-200 mt-1 ml-3 block w-full focus:border-gray-300 hover:border-gray-300 text-gray-500"
			wire:model="search"
			type="text"
			placeholder="Buscar...( / )"
			autofocus>
		<div class="form-input text-sm rounded-md shadow-sm border-gray-200 mt-1 block ml-3">
			<select wire:model="state" wire:change="getStateEs" class="outline-none text-gray-500 focus:border-gray-300 hover:border-gray-300 text-gray-500">
				<option value="all">Todos</option>
				<option value="active">Activos</option>
				<option value="inactive">Inactivos</option>
			</select>
		</div>
		<div class="form-input text-sm rounded-md shadow-sm border-gray-200 mt-1 block ml-3">
			<select wire:model="perPage" class="outline-none text-gray-500">
				<option value="5">5 por página</option>
				<option value="10">10 por página</option>
				<option value="15">15 por página</option>
				<option value="25">25 por página</option>
				<option value="50">50 por página</option>
				<option value="100">100 por página</option>
				<option value="1000">1000 por página</option>
			</select>
		</div>
		<figure class="ml-3 w-8">
			<img wire:loading src="https://rivers.mx/img/cargando.gif" alt="loading" class="w-6 h-auto">
		</figure>
		<button wire:click="clearAllFilters" class="group text-xl rounded-md border-gray-200 mt-1 block ml-3 hover:border-gray-300 focus:border-gray-300 focus:outline-none {{ ($search == '' && $perPage == '5' && $state == 'all') ? 'opacity-25 hover:border-gray-200 focus:border-gray-200' : '' }}"
			{{ ($search == '' && $perPage == '5' && $state == 'all') ? 'disabled' : '' }}>
			<i class="fas fa-eraser text-gray-500 {{ ($search == '' && $perPage == '5' && $state == 'all') ? 'group-hover:text-gray-500 group-focus:text-gray-500 cursor-not-allowed' : 'group-hover:text-gray-900 group-focus:text-gray-900' }}"></i>
		</button>

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
		<div class="flex items-center px-4 pt-2 sm:px-6 gap-2">
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