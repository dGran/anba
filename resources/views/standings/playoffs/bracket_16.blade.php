<div class="shadow-md rounded-lg mx-3 md:mx-0">
	<div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg p-4">
		<table class="w-full mb-2">
			<tr>
				<td colspan="9">
					<div class="flex items-center mb-6">
						<p class="font-bold uppercase text-xl">{{ $playoff->name }}</p>
					</div>
				</td>
			</tr>

			<tr>
				{{-- left side --}}
				<td class="border h-16 w-48">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(1);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>

				<td></td>

				{{-- right side --}}
				<td class="border h-16 w-48">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(5);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'right'])
					@include('standings.playoffs.clash_visitor', ['position' => 'right'])
				</td>
			</tr>

			@include('standings.playoffs.blank_row')
			@include('standings.playoffs.blank_row')

			<tr>
				{{-- left side --}}
				<td class="border h-16 w-48">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(2);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>

				<td></td>

				{{-- right side --}}
				<td class="border h-16 w-48">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(6);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'right'])
					@include('standings.playoffs.clash_visitor', ['position' => 'right'])
				</td>
			</tr>

			@include('standings.playoffs.blank_row')
			@include('standings.playoffs.blank_row')

			<tr>
				{{-- left side --}}
				<td class="border h-16 w-48">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(3);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>

				<td></td>

				{{-- right side --}}
				<td class="border h-16 w-48">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(7);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'right'])
					@include('standings.playoffs.clash_visitor', ['position' => 'right'])
				</td>
			</tr>

			@include('standings.playoffs.blank_row')
			@include('standings.playoffs.blank_row')

			<tr>
				{{-- left side --}}
				<td class="border h-16 w-48">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(4);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'left'])
					@include('standings.playoffs.clash_visitor', ['position' => 'left'])
				</td>

				<td></td>

				{{-- right side --}}
				<td class="border h-16 w-48">
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(8);
					@endphp
					@include('standings.playoffs.clash_local', ['position' => 'right'])
					@include('standings.playoffs.clash_visitor', ['position' => 'right'])
				</td>
			</tr>

		</table>
	</div>
</div>