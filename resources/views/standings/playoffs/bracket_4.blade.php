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
                    <td class="bracket border-t border-r dark:border-gray-650"></td>
                    <td></td>
                    @php
                        $round = $playoff->getRound(2);
                    @endphp
                    <td colspan="2" class="round-name">
                        {{ $round->name }} ({{ $round->matches_max }})
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
                </tr>
            </table>
        </div>
    </div>
</div>