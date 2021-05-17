@foreach ($round->clashes as $clash)
    <p>
        {{ $clash->localTeam ? $clash->localTeam->team->medium_name : 'No definido' }} vs {{ $clash->visitorTeam ? $clash->visitorTeam->team->medium_name : 'No definido' }}
    </p>
@endforeach
{{--
<div class="shadow-md rounded-lg mx-3 md:mx-0">
	<div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg p-4">
		<table class="w-full mb-2">
			<tr>
				<td colspan="5">
					<div class="flex items-center mb-6">
						<p class="text-blue-600 dark:text-blue-500 font-bold uppercase text-xl">{{ $playoff->name }}</p>
					</div>
				</td>
			</tr>
			<tr>
				<td class="border-b border-blue-500 dark:border-blue-500 w-48 h-14" style="min-width: 12em; max-width: 12em">
					<div class="flex items-center">
						<img src="{{ $table_positions[0][0]['team']->team->getImg() }}" alt="{{ $table_positions[0][0]['team']->team->short_name }}" class="w-12 h-12 object-cover m-1">
						<div class="ml-1.5 flex flex-col text-left">
							<p class="text-sm uppercase leading-4">
								{{ $table_positions[0][0]['team']->team->medium_name }}
							</p>
							<p class="text-xs">
								{{ $table_positions[0][0]['team']->team->user->name }}
							</p>
						</div>
					</div>
				</td>
				<td class="border-b border-blue-500 dark:border-blue-500 w-6" style="min-width: 1.5em; max-width: 1.5em"></td>
			</tr>
		</table>
	</div>
</div> --}}