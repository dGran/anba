<div class="shadow-md rounded-lg mx-3 md:mx-0">
	<div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg p-4">
		<table class="mb-2">
			<tr>
				<td colspan="9">
					<div class="flex items-center mb-6">
						<p class="font-bold uppercase text-xl">{{ $playoff->name }}</p>
					</div>
				</td>
			</tr>

			<tr>
				@php $round = $playoff->getRound(1); @endphp
				<td class="text-xs uppercase font-medium pb-1.5">
					{{ $round->name }} ({{ $round->matches_max }})
				</td>
			</tr>
			{{-- row 1 --}}
			<tr>
				{{-- left side --}}
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				{{-- center side --}}
				<td colspan="19" class="h-8 w-3"></td>
				{{-- right side --}}
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(5);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'right'])
				</td>
			</tr>

			{{-- row 2 --}}
			<tr>
				{{-- left side --}}
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border-t border-r w-3"></td>
				<td class="h-8 w-3"></td>
				@php $round = $playoff->getRound(2); @endphp
				<td class="text-xs uppercase font-medium align-bottom pb-1.5">
					{{ $round->name }} ({{ $round->matches_max }})
				</td>
				{{-- center side --}}
				<td colspan="17" class="h-8 w-3"></td>
				{{-- right side --}}
				@php $round = $playoff->getRound(2); @endphp
				<td class="text-xs uppercase font-medium align-bottom text-right pb-1.5">
					{{ $round->name }} ({{ $round->matches_max }})
				</td>
				<td class="h-8 w-3"></td>
				<td class="border-t border-l w-3"></td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'right'])
				</td>
			</tr>

			{{-- row 3 --}}
			<tr>
				{{-- left side --}}
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
				<td class="border-b h-8 w-3"></td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm h-8 w-6 text-center">-</td>
				{{-- center side --}}
				<td colspan="15" class="h-8 w-3"></td>
				{{-- right side --}}
				<td class="bg-gray-150 border text-sm h-8 w-6 text-center">-</td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(3);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="border-b h-8 w-3"></td>
				<td class="border-l h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>

			</tr>

			{{-- row 4 --}}
			<tr>
				{{-- left side --}}
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm h-8 w-6 text-center">-</td>
				<td class="border-t border-r h-8 w-3"></td>
				{{-- center side --}}
				<td colspan="13" class="h-8 w-3"></td>
				{{-- right side --}}
				<td class="border-t border-l h-8 w-3"></td>
				<td class="bg-gray-150 border text-sm h-8 w-6 text-center">-</td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(3);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>
				<td class="h-8 w-3"></td>
				<td class="border-l h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
			</tr>

			{{-- row 5 --}}
			<tr>
				{{-- left side --}}
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(2);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm h-8 w-6 text-center">-</td>
				<td class="border-b border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
				{{-- center side --}}
				<td colspan="13" class="h-8 w-3"></td>
				{{-- right side --}}
				<td class="border-l h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-b border-l h-8 w-3"></td>
				<td class="bg-gray-150 border text-sm h-8 w-6 text-center">-</td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(6);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'right'])
				</td>
			</tr>

			{{-- row 6 --}}
			<tr>
				{{-- left side --}}
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(2);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="w-3"></td>
				<td class="w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				@php $round = $playoff->getRound(3); @endphp
				<td class="text-xs uppercase font-medium align-bottom pb-1.5">
					{{ $round->name }} ({{ $round->matches_max }})
				</td>
				{{-- center side --}}
				<td colspan="9" class="h-8 w-3"></td>
				{{-- right side --}}
				@php $round = $playoff->getRound(3); @endphp
				<td class="text-xs uppercase font-medium align-bottom text-right pb-1.5">
					{{ $round->name }} ({{ $round->matches_max }})
				</td>
				<td class="h-8 w-3"></td>
				<td class="border-l h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(6);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'right'])
				</td>
			</tr>

			{{-- row 7 --}}
			<tr>
				{{-- left side --}}
				<td rowspan="2" colspan="6" class="h-8 w-3 px-3 text-right text-2xl">
					CONF. ESTE
				</td>
				<td class="border-r h-8 w-3"></td>
				<td class="border-b h-8 w-3"></td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(3);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				{{-- center side --}}
				<td colspan="6" class="h-8 w-3"></td>
				{{-- right side --}}
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(3);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'right'])
				</td>
			</tr>

			{{-- row 8 --}}
			<tr>
				{{-- left side --}}
				<td class="border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(3);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				{{-- center side --}}
				<td class="border-t border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-t border-l h-8 w-3"></td>
				{{-- right side --}}
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(3);
						$clash = $round->getClash(2);
						@endphp
					@include('standings.playoffs.clash_local', ['position' => 'right'])
				</td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
			</tr>

			{{-- row 9 --}}
			<tr>
				{{-- left side --}}
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(3);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>

				{{-- center side --}}
				<td class="border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(4);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border-r h-8 w-3"></td>
			</tr>

			{{-- row 10 --}}
			<tr>
				{{-- left side --}}
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(3);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border-t border-r w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>

				{{-- center side --}}
				<td class="border-t h-8 w-3"></td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(4);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border-t h-8 w-3"></td>
			</tr>

			{{-- row 11 --}}
			<tr>
				{{-- left side --}}
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
				<td class="border-b h-8 w-3"></td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(2);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border-b border-r h-8 w-3"></td>
			</tr>

			{{-- row 12 --}}
			<tr>
				{{-- left side --}}
				<td class="h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border-r h-8 w-3"></td>
				<td class="h-8 w-3"></td>
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(2);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
			</tr>

			{{-- row 13 --}}
			<tr>
				{{-- left side --}}
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(4);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="border-b border-r w-3"></td>
				<td class="h-8 w-3"></td>
			</tr>

			{{-- row 14 --}}
			<tr>
				{{-- left side --}}
				<td class="border h-8 w-36">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(4);
					@endphp
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>
				<td class="bg-gray-150 border text-sm w-6 text-center">-</td>
				<td class="w-3"></td>
				<td class="w-3"></td>
			</tr>

		</table>
	</div>
</div>