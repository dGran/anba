<div class="bg-white dark:bg-gray-750 | sm:rounded-md | border-t border-b sm:border border-gray-200 dark:border-gray-700">
    <div class="px-4 py-2 text-sm font-bold uppercase | border-b border-gray-200 dark:border-gray-700">Asistencias por partido</div>

    <div class="p-4">
        <div class="flex items-center justify-between px-3">
            <div class="flex flex-col">
                <span class="text-4xl lg:text-5xl font-bold font-miriam">
                    {{ number_format($stats_APG->first()->AVG_AST, 1, ',', '.') }}
                </span>
                <span class="font-semibold">{{ $stats_APG->first()->player->name }}</span>
                <span class="uppercase text-xs">{{ $stats_APG->first()->player->getPosition() }}</span>
            </div>
            <img src="{{ $stats_APG->first()->player->getImg() }}" alt="" class="rounded-full border border-gray-200 dark:border-gray-700 object-cover w-20 md:w-24 h-20 md:h-24">
        </div>

        <ul class="px-3 pt-4 mt-4 border-t border-gray-150 dark:border-gray-700">
            @foreach ($stats_APG as $key=>$stat)
                <li class="flex items-center justify-between">
                    <div class="">
                        <span class="font-mono font-bold">{{ $key+1 }}.</span>
                        <span class="ml-0.5 {{ $key+1 == 1 ? 'font-bold' : '' }}">{{ $stat->player->name }}</span>
                    </div>
                    <span class="font-bold font-mono">
                        {{ number_format($stat->AVG_AST, 1, ',', '.') }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
