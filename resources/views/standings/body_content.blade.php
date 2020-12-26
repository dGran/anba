<td class="py-1 border-r border-gray-200 dark:border-gray-600">
	<div class="flex items-center">
		<p class="m-0 text-right mr-3 font-semibold" style="width: 30px">{{ $loop->iteration }}</p>
		<img src="{{ $position['team']->team->getImg() }}" alt="{{ $position['team']->team->short_name }}" style="width: 32px; height: 32px" class="mr-2">
		<span>
			{{ $position['team']->team->name }}
{{-- 			<span class="block text-gray-600">
				{{ $position['team']->seasonDivision->division->name }} / {{ $position['team']->seasonDivision->seasonConference->conference->name }}
			</span> --}}
		</span>
	</div>
</td>
<td style="width: 60px;" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['w'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="width: 60px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="width: 80px" class="text-center tracking-tight">
	{{ number_format($position['wavg'], 3) }}
</td>
<td style="width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['conf_w'] }}-{{ $position['conf_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['div_w'] }}-{{ $position['div_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['home_w'] }}-{{ $position['home_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['road_w'] }}-{{ $position['road_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="width: 80px" class="text-center tracking-tight">
	0-0
</td>
<td style="width: 80px" class="text-center tracking-tight">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['last10_w'] }}-{{ $position['last10_l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td style="width: 80px" class="text-center tracking-tight uppercase">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['streak'] > 0 ? 'W' : 'L' }} {{ abs($position['streak']) }}
	@else
		<span>-</span>
	@endif
</td>