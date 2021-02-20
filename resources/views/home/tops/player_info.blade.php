<div class="flex-1">
	<div class="flex items-center">
		<img src="{{ $top->player->getImg() }}" alt="" class="hidden xs:block h-14 w-14 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650" style="background-color: {{ $top->player->team ? $top->player->team->color : '' }}">
		<div class="flex flex-col ml-2">
			<div class="flex items-center">
				<p class="font-bold">
					{{ $loop->iteration }}. {{ $top->player->name }}
				</p>
			</div>
			<div class="flex items-center">
				<img src="{{ $top->player->team->getImg() }}" alt="{{ $top->player->team->medium_name }}" class="w-7 h-7 mr-1">
				<p>{{ $top->player->team ? $top->player->team->short_name : '' }}<span class="mx-1.5">|</span><span class="uppercase">{{ $top->player->position }}</span></p>
			</div>
		</div>

	</div>
</div>