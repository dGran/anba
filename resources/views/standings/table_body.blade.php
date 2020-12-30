<td class="dark:border-gray-600 bg-white dark:bg-gray-750 group-hover:bg-blue-100 dark:group-hover:bg-dark-link" style="min-width: 230px; left: 0px; position: sticky;">
	<div class="flex items-center border-r border-gray-200 dark:border-gray-700 py-1">
		<p class="m-0 text-right mr-3 font-semibold" style="width: 30px">{{ $loop->iteration }}</p>
		<img src="{{ $position['team']->team->getImg() }}" alt="{{ $position['team']->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
		<p>
			<span class="hidden md:block">{{ $position['team']->team->name }}</span>
			<span class="md:hidden">{{ $position['team']->team->medium_name }}</span>
			<span class="block text-xs leading-4 {{ $position['team']->team->user ? 'light:text-gray-500 dark:text-gray-200' : 'light:text-gray-400 dark:text-red-200 uppercase text-xs' }}">
				{{ $position['team']->team->user ? $position['team']->team->user->name : 'Sin manager' }}
			</span>
		</p>
	</div>
</td>
<td style="min-width: 40px; width: 60px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['w'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 40px; width: 60px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	{{ number_format($position['wavg'], 3) }}
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['conf_w'] }}-{{ $position['conf_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="min-width: 60px; width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['div_w'] }}-{{ $position['div_l'] }}
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
	0-0
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