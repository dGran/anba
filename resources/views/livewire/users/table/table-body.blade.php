<tbody class="bg-white divide-y divide-gray-200">
	@foreach ($users as $index => $user)
		<tr class="group hover:bg-yellow-50 focus:bg-yellow-50" wire:click="checkSelected({{ $user->id }})">
			<td class="pl-6 py-4 whitespace-no-wrap w-8">
				<input id="check{{ $user->id }}" type="checkbox" class="mousetrap form-checkbox h-5 w-5 text-indigo-400"
				wire:model="selected_regs.{{ $user->id }}" value="{{ $user->id }}"
				wire:change="checkSelected({{ $user->id }})">
			</td>
			<td class="px-6 py-4 whitespace-no-wrap">
				<div class="flex items-center">
					<figure class="flex-shrink-0 h-10 w-10">
						<img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
					</figure>
					<div class="ml-4">
						<div class="text-sm leading-5 font-medium text-gray-900">
							{{ $user->name }}
						</div>
						<div class="text-sm leading-5 text-gray-500">
							{{ $user->email }}
						</div>
					</div>
				</div>
			</td>
			<td class="w-32 px-6 py-4 whitespace-no-wrap">
				<div class="text-sm leading-5 font-medium text-gray-900">
					{{ $user->created_at }}
				</div>
			</td>
			<td class="px-6 py-4 whitespace-no-wrap w-24">
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
{{-- 			<td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium w-16">
	    		<x-dropdown>
	    			<x-slot name="trigger">
	    				<i class="fas fa-ellipsis-v cursor-pointer border hover:border-gray-200 focus:border-gray-200 border-transparent px-4 rounded py-2"></i>
	    			</x-slot>
	                <x-slot name="content">
	                    <x-dropdown-link href="#" wire:click="edit({{ $user->id }})">
	                        <p class="text-left">Editar</p>
	                    </x-dropdown-link>
	                    <x-dropdown-link href="#" wire:click="confirmDestroy({{ $user->id }})">
	                    	<p class="text-left text-red-500">Eliminar</p>
	                    </x-dropdown-link>
	                </x-slot>
	    		</x-dropdown>
			</td> --}}
		</tr>
	@endforeach
</tbody>