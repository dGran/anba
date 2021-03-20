<div class="flex items-center select-none mb-6 -mt-2">
	<div class="flex flex-col">
		<label for="teams" class="text-xs uppercase">
			Rival
		</label>
		<select id="teams" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none" wire:model="filterTeam">
			<option value="all">Todos</option>
			@foreach ($season_teams as $season_team)
				<option value="{{ $season_team->id }}">{{ $season_team->team->medium_name }}</option>
			@endforeach
		</select>
	</div>
</div>