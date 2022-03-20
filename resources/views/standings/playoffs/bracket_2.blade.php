<div class="shadow-md rounded-lg mx-3 md:mx-0">
    <div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-transparent hover:scrollbar-thumb-gray-300 | dark:hover:scrollbar-thumb-gray-500">
        <div class="inline-block p-4">
            <p class="font-bold uppercase text-xl">
                {{ $playoff->name }}
            </p>
	        <table class="playoffs">
	            <tr>
	                @php
	                    $round = $playoff->getRound(1);
	                @endphp
	                <td colspan="2" class="round-name">
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
	            </tr>
	        </table>
        </div>
    </div>
</div>