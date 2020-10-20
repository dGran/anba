<tbody class="bg-white divide-y divide-gray-200 leading-4 sm:leading-5">
	@foreach ($regs as $user)
		<tr class="group {{ $regsSelected->find($user->id) ? 'bg-indigo-50' : 'hover:bg-gray-50 focus:bg-gray-50' }}" wire:click="checkSelected({{ $user->id }})">
			<td class="pl-3 sm:pl-6 py-2 w-6 sm:w-8">
				<input id="check{{ $user->id }}" type="checkbox" class="mousetrap form-checkbox h-4 w-4 sm:h-5 sm:w-5 text-indigo-400"
				wire:model="regsSelectedArray.{{ $user->id }}" value="{{ $user->id }}"
				wire:change="checkSelected({{ $user->id }})">
			</td>
			<td class="pl-2 sm:pl-3 pr-3 sm:pr-6 py-2 whitespace-no-wrap">
				<div class="flex items-center">
					<figure class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
						<img class="h-8 w-8 sm:h-10 sm:w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
					</figure>
					<div class="pl-2 sm:pl-3 truncate w-40 sm:w-auto">
						<div class="text-xs sm:text-sm font-medium text-gray-900 truncate group-hover:text-indigo-600">
							{{ $user->name }}
						</div>
						<div class="text-xxs sm:text-xs text-gray-500 truncate">
							{{ $user->email }}
						</div>
					</div>
				</div>
			</td>
			<td class="hidden md:table-cell w-48 px-3 sm:px-6 py-2 whitespace-no-wrap text-center">
				<div class="text-xxs leading-5 font-medium flex flex-col uppercase">
					<span>{{ $user->getCreatedAtDate() }}</span>
					<span class="text-gray-500">
						<i class="far fa-clock mr-1"></i>
						{{ $user->getCreatedAtTime() }}
					</span>
				</div>
			</td>
			<td class="hidden md:table-cell px-3 sm:px-6 py-2 whitespace-no-wrap w-24">
				<div class="text-center">
				@if ($user->email_verified_at)
					<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-green-100 text-green-800">
						Activo
					</span>
				@else
					<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-red-100 text-red-800">
						Inactivo
					</span>
				@endif
				</div>
			</td>
			<td class="px-3 sm:px-6 py-2 whitespace-no-wrap w-auto">
				<div class="opacity-25 group-hover:opacity-75 text-xs cursor-pointer text-right">
		            <a wire:click="edit({{ $user->id }})" class="hover:text-gray-600">
		            	<i class="fas fa-edit w-5"></i>
		            </a>
		            <a wire:click="confirmDestroy" class="hover:text-red-600">
		            	<i class="fas fa-trash w-5"></i>
		            </a>

				</div>
			</td>
		</tr>
	@endforeach
</tbody>