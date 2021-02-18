<td class="dark:border-gray-600 pl-4">
	<div class="flex items-center border-gray-200 dark:border-gray-650 py-1">
		<p class="m-0 text-left mr-3 font-semibold w-2">{{ $loop->iteration }}</p>
		<img src="{{ $position['team_img'] }}" alt="{{ $position['team_short_name'] }}" class="mr-2 w-8 h-8">
		<p class="truncate">
			<span class="">{{ $position['team_medium_name'] }}</span>
			<span class="block text-xs leading-4 truncate {{ $position['team_with_manager'] ? 'text-gray-500 dark:text-gray-300' : 'text-gray-300 dark:text-gray-500 uppercase text-xs' }}">
				{{ $position['team_manager'] }}
			</span>
		</p>
	</div>
</td>
<td class="text-center tracking-tight w-8">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['w'] }}
	@else
		<span>-</span>
	@endif
</td>
<td class="text-center tracking-tight w-8">
	@if ($position['w'] > 0 || $position['l'] > 0)
		{{ $position['l'] }}
	@else
		<span>-</span>
	@endif
</td>
<td class="text-right tracking-tight w-14 pr-4 ml-3">
	{{ number_format($position['wavg'], 3) }}
</td>