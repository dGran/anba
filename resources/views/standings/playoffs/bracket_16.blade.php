<div class="shadow-md rounded-lg mx-3 md:mx-0">
	<div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg">
		<div class="inline-block p-4">
            <p class="font-bold uppercase text-xl">
                {{ $playoff->name }}
            </p>
			<table class="playoffs w-full">
				<tr>
					@php
						$round = $playoff->getRound(1);
					@endphp
					<td colspan="2" class="round-name">
						{{ $round->name }} ({{ $round->matches_max }})
					</td>
					<td colspan="22"></td>
					<td colspan="2" class="round-name right">
						{{ $round->name }} ({{ $round->matches_max }})
					</td>
				</tr>
				{{-- row 1 --}}
				<tr>
					{{-- left side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(1);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
	                    {{ $clash->result()['local_result'] }}
					</td>
					{{-- center side --}}
					<td colspan="6"></td>
					<td colspan="10" rowspan="4">
						<img src="{{ asset('img/playoffs.svg') }}" alt="" class="w-72 m-auto hidden dark:block">
						<img src="{{ asset('img/playoffs.png') }}" alt="" class="w-72 m-auto dark:hidden">
					</td>
					<td colspan="6"></td>
					{{-- right side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(5);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
	                    {{ $clash->result()['local_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'right'])
					</td>
				</tr>

				{{-- row 2 --}}
				<tr>
					{{-- left side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(1);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
	                    {{ $clash->result()['visitor_result'] }}
					</td>
					<td class="bracket border-t border-r dark:border-gray-650"></td>
					<td></td>
					@php
						$round = $playoff->getRound(2);
					@endphp
					<td colspan="2" class="round-name">
						{{ $round->name }} ({{ $round->matches_max }})
					</td>
					{{-- center side --}}
					<td colspan="14"></td>
					{{-- right side --}}
					@php
						$round = $playoff->getRound(2);
					@endphp
					<td colspan="2" class="round-name right">
						{{ $round->name }} ({{ $round->matches_max }})
					</td>
					<td></td>
					<td class="bracket border-t border-l dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(5);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
	                    {{ $clash->result()['visitor_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'right'])
					</td>
				</tr>

				{{-- row 3 --}}
				<tr>
					{{-- left side --}}
					<td colspan="2"></td>
					<td class="bracket border-r dark:border-gray-650"></td>
					<td class="bracket border-b dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(1);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
	                    {{ $clash->result()['local_result'] }}
					</td>
					{{-- center side --}}
					<td colspan="14"></td>
					{{-- right side --}}
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(3);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
	                    {{ $clash->result()['local_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="bracket border-b dark:border-gray-650"></td>
					<td class="bracket border-l dark:border-gray-650"></td>
				</tr>

				{{-- row 4 --}}
				<tr>
					{{-- left side --}}
					<td colspan="2"></td>
					<td class="bracket border-r dark:border-gray-650"></td>
					<td></td>
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(1);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="bracket border-t border-r dark:border-gray-650"></td>
					{{-- center side --}}
					<td colspan="12"></td>
					{{-- right side --}}
					<td class="bracket border-t border-l dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(3);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td></td>
					<td class="bracket border-l dark:border-gray-650"></td>
				</tr>

				{{-- row 5 --}}
				<tr>
					{{-- left side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(2);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="bracket border-b border-r dark:border-gray-650"></td>
					<td colspan="3"></td>
					<td class="bracket border-r dark:border-gray-650"></td>
					{{-- center side --}}
					<td colspan="12"></td>
					{{-- right side --}}
					<td class="bracket border-l dark:border-gray-650"></td>
					<td colspan="3"></td>
					<td class="bracket border-b border-l dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(6);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'right'])
					</td>
				</tr>

				{{-- row 6 --}}
				<tr>
					{{-- left side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(2);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td colspan="4"></td>
					<td class="bracket border-r dark:border-gray-650"></td>
					<td></td>
					@php
						$round = $playoff->getRound(3);
					@endphp
					<td colspan="2" class="round-name">
						{{ $round->name }} ({{ $round->matches_max }})
					</td>
					{{-- center side --}}
					<td colspan="6"></td>
					{{-- right side --}}
					@php
						$round = $playoff->getRound(3);
					@endphp
					<td colspan="2" class="round-name right">
						{{ $round->name }} ({{ $round->matches_max }})
					</p>
					</td>
					<td></td>
					<td class="bracket border-l dark:border-gray-650"></td>
					<td colspan="4"></td>
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(6);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'right'])
					</td>
				</tr>

				{{-- row 7 --}}
				<tr>
					{{-- left side --}}
					<td rowspan="2" colspan="6" class="px-3 text-right text-2xl">
						CONF. ESTE
					</td>
					<td class="bracket border-r dark:border-gray-650"></td>
					<td class="bracket border-b dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(3);
						$clash = $round->getClash(1);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					{{-- center side --}}
					<td colspan="6"></td>
					{{-- right side --}}
					@php
						$round = $playoff->getRound(3);
						$clash = $round->getClash(2);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'right'])
					</td>
					<td class="bracket border-b dark:border-gray-650"></td>
					<td class="bracket border-l dark:border-gray-650"></td>
					<td rowspan="2" colspan="6" class="px-3 text-2xl">
						CONF. OESTE
					</td>
				</tr>

				{{-- row 8 --}}
				<tr>
					{{-- left side --}}
					<td class="bracket border-r dark:border-gray-650"></td>
					<td></td>
					@php
						$round = $playoff->getRound(3);
						$clash = $round->getClash(1);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					{{-- center side --}}
					<td class="bracket border-t border-r dark:border-gray-650"></td>
					<td></td>
					@php
						$round = $playoff->getRound(4);
					@endphp
					<td colspan="2" class="round-name center">
						{{ $round->name }} ({{ $round->matches_max }})
					</td>
					<td></td>
					<td class="bracket border-t border-l dark:border-gray-650"></td>
					{{-- right side --}}
					@php
						$round = $playoff->getRound(3);
						$clash = $round->getClash(2);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'right'])
					</td>
					<td class="bracket border-t border-r dark:border-gray-650"></td>
				</tr>

				{{-- row 9 --}}
				<tr>
					{{-- left side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(3);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td colspan="4"></td>
					<td class="bracket border-r dark:border-gray-650"></td>
					<td colspan="3"></td>
					{{-- center side --}}
					<td class="bracket border-r dark:border-gray-650"></td>
					<td></td>
					@php
						$round = $playoff->getRound(4);
						$clash = $round->getClash(1);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="bracket border-r dark:border-gray-650"></td>
					{{-- right side --}}
					<td colspan="4"></td>
					<td class="bracket border-l dark:border-gray-650"></td>
					<td colspan="4"></td>
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(7);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'right'])
					</td>
				</tr>

				{{-- row 10 --}}
				<tr>
					{{-- left side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(3);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="bracket border-t border-r dark:border-gray-650"></td>
					<td colspan="3"></td>
					<td class="bracket border-r dark:border-gray-650"></td>
					<td colspan="4"></td>
					{{-- center side --}}
					<td class="bracket border-t dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(4);
						$clash = $round->getClash(1);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="bracket border-t dark:border-gray-650"></td>
					{{-- right side --}}
					<td colspan="4"></td>
					<td class="bracket border-l dark:border-gray-650"></td>
					<td colspan="3"></td>
					<td class="bracket border-t border-l dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(7);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'right'])
					</td>
				</tr>

				{{-- row 11 --}}
				<tr>
					{{-- left side --}}
					<td colspan="2"></td>
					<td class="bracket border-r dark:border-gray-650"></td>
					<td class="bracket border-b dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(2);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="bracket border-b border-r dark:border-gray-650"></td>
					{{-- center side --}}
					<td></td>
					<td colspan="10" rowspan="4">
						@if ($playoff->winner())
							<div class="flex flex-col justify-end text-center h-full">
								<img src="{{ $playoff->winner()->team->getImg() }}" alt="{{ $playoff->winner()->team->medium_name }}" class="w-24 h-24 object-cover mx-auto">
								<p class="text-sm uppercase font-bold">
									campeón ANBA
								</p>
								<p class="text-sm">
									<span class="uppercase">{{ $playoff->winner()->team->medium_name }}</span> - <span>{{ $playoff->winner()->team->user->name }}</span>
								</p>
							</div>
						@endif
					</td>
					<td></td>
					{{-- right side --}}
					<td class="bracket border-b border-l dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(4);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'right'])
					</td>
					<td class="bracket border-b dark:border-gray-650"></td>
					<td class="bracket border-l dark:border-gray-650"></td>
				</tr>

				{{-- row 12 --}}
				<tr>
					{{-- left side --}}
					<td colspan="2"></td>
					<td class="bracket border-r dark:border-gray-650"></td>
					<td></td>
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(2);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					{{-- center side --}}
					<td colspan="14"></td>
					{{-- right side --}}
					@php
						$round = $playoff->getRound(2);
						$clash = $round->getClash(4);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'right'])
					</td>
					<td></td>
					<td class="bracket border-l dark:border-gray-650"></td>
				</tr>

				{{-- row 13 --}}
				<tr>
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(4);
					@endphp
					{{-- left side --}}
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="bracket border-b border-r dark:border-gray-650"></td>
					{{-- center side --}}
					<td colspan="20"></td>
					{{-- right side --}}
					<td class="bracket border-b border-l dark:border-gray-650"></td>
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(8);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['local_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_local', ['position' => 'right'])
					</td>
				</tr>

				{{-- row 14 --}}
				<tr>
					{{-- left side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(4);
					@endphp
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'left'])
					</td>
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					{{-- center side --}}
					<td colspan="22"></td>
					{{-- right side --}}
					@php
						$round = $playoff->getRound(1);
						$clash = $round->getClash(8);
					@endphp
					<td class="result bg-gray-100 dark:bg-gray-700 dark:border-gray-650">
						{{ $clash->result()['visitor_result'] }}
					</td>
					<td class="clash dark:border-gray-650">
						@include('standings.playoffs.clash_visitor', ['position' => 'right'])
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>