<td class="dark:border-gray-600 bg-white dark:bg-gray-750 group-hover:bg-blue-100 dark:group-hover:bg-dark-link" style="min-width: 200px; max-width: 200px; left: 0px; position: sticky;">
	<div class="flex items-center border-r border-gray-200 dark:border-gray-700 py-1">
		<p class="m-0 text-right mr-3 font-semibold w-6 md:w-8">{{ $loop->iteration }}</p>
		<img src="{{ $position['team']->team->getImg() }}" alt="{{ $position['team']->team->short_name }}" class="mr-2 w-8 h-8">
		<p class="truncate">
			<span class="hidden md:block">{{ $position['team']->team->name }}</span>
			<span class="md:hidden">{{ $position['team']->team->medium_name }}</span>
			<span class="block text-xs leading-4 truncate {{ $position['team']->team->user ? 'text-gray-500 dark:text-gray-300 dark:group-hover:text-gray-700' : 'text-gray-300 dark:text-gray-500 uppercase text-xs dark:group-hover:text-gray-600' }}">
				{{ $position['team']->team->user ? $position['team']->team->user->name : 'Sin manager' }}
			</span>
		</p>
	</div>
</td>

<td style="min-width: 40px; width: 60px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		<a href="" class="hover:underline focus:underline focus:outline-none" wire:click.prevent="openFieldTeamInfoMatches('w', {{ $position['team']->id }})">
			{{ $position['w'] }}
		</p>
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 40px; width: 60px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		<a href="" class="hover:underline focus:underline focus:outline-none" wire:click.prevent="openFieldTeamInfoMatches('l', {{ $position['team']->id }})">
			{{ $position['l'] }}
		</a>
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	{{ number_format($position['wavg'], 3) }}
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		<a href="" class="hover:underline focus:underline focus:outline-none" wire:click.prevent="openFieldTeamInfoMatches('conf', {{ $position['team']->id }})">
			{{ $position['conf_w'] }}-{{ $position['conf_l'] }}
		</a>
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		<a href="" class="hover:underline focus:underline focus:outline-none" wire:click.prevent="openFieldTeamInfoMatches('div', {{ $position['team']->id }})">
			{{ $position['div_w'] }}-{{ $position['div_l'] }}
		</a>
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['home_w'] }}-{{ $position['home_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['road_w'] }}-{{ $position['road_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['ot_w'] }}-{{ $position['ot_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['last10_w'] }}-{{ $position['last10_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 70px; width: 80px" class="text-center tracking-tight uppercase pr-3">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['streak'] > 0 ? 'W' : 'L' }} {{ abs($position['streak']) }}
	@else
		<span>-</span>
	@endif
</td>