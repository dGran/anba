<img src="{{ $top->player->getImg() }}" alt="" class="hidden xs:block h-14 w-14 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650">
<div class="flex-1 flex flex-col ml-2">

	<div class="flex items-center">
		<p class="font-bold">
			{{ $loop->iteration }}. {{ $top->player->name }}
		</p>
	</div>
	<div class="flex items-center">
		<img src="{{ $top->seasonTeam ? $top->seasonTeam->team->getImg() : asset('storage/teams/default.png') }}" alt="{{ $top->seasonTeam->team->medium_name }}" class="w-7 h-7 mr-1">
		<p>{{ $top->seasonTeam ? $top->seasonTeam->team->medium_name : '' }} | <span class="text-xs uppercase">{{ $top->player->position }}</span></p>
	</div>
</div>