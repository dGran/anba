<x-app-layout blockHeader="0" title="Equipos">
	<div class="max-w-7xl mx-auto md:px-6 lg:px-8 md:my-8">
		<div class="bg-white dark:bg-gray-750 md:rounded-md md:border border-gray-200 dark:border-gray-700 | pt-2 pb-4 px-4">
			<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 md:gap-4 lg:gap-8 | sm:px-3">
				@foreach ($divisions as $division)
					<div class="">
						<p class="text-base uppercase font-semibold pt-4 pb-2">
							{{ $division->name }}
						</p>
						@foreach ($division->teams as $team)
							@include('teams.teams.item')
						@endforeach
					</div>

				@endforeach
			</div>
		</div>
    </div>
</x-app-layout>
