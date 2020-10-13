<tbody class="bg-white divide-y divide-gray-100">
	@foreach ($users as $user)
		<tr>
			<td class="px-6 py-4 whitespace-no-wrap">
				<div class="flex items-center">
					<div class="flex-shrink-0 h-10 w-10">
						<img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
					</div>
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
			<td class="px-6 py-4 whitespace-no-wrap">
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
			<td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium w-24">
				<a wire:click="edit({{ $user->id }})" class="text-blue-600 hover:text-blue-900 cursor-pointer">Editar</a>
				<a wire:click="destroy({{ $user->id }})" class="text-blue-600 hover:text-blue-900 cursor-pointer">Eliminar</a>
			</td>
		</tr>
	@endforeach
</tbody>