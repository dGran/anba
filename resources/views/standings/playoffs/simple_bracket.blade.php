<div class="shadow-md rounded-lg mx-3 md:mx-0">
	<div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg p-4">
		<table class="w-full mb-2">
            @foreach ($playoff->rounds as $round)
                <tr>
                    <td class="pt-4 pb-2 uppercase font-bold">
                        {{ $round->name }}
                    </td>
                </tr>
                @foreach ($round->clashes as $clash)
                    <tr>
                        <td class="border w-48 h-14" style="min-width: 12em; max-width: 12em">
                            {{ $clash->id }} - {{ $clash->bracketPosition() }}

                            @include('standings.playoffs.clash_local')
                            @include('standings.playoffs.clash_visitor')

                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    </div>
</div>