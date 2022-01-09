<div class="flex items-center space-x-2 md:space-x-4 justify-center | border-b border-gray-200 dark:border-gray-700 pb-6">
    <p class="rounded-md sm:rounded-full bg-blue-500 dark:bg-dark-link w-14 h-14 sm:w-20 sm:h-20 | flex flex-col items-center justify-center | leading-5 sm:leading-6 | border border-blue-600 dark:border-blue-300">
        <span class="hidden sm:block text-xs uppercase | text-gray-100 dark:text-gray-700">JUGADORES</span>
        <span class="sm:hidden text-sm uppercase | text-gray-100 dark:text-gray-700">J</span>
        <span class="text-xl sm:text-3xl font-bold | text-white dark:text-gray-900">{{ $season_team->team->players->count() }}</span>
    </p>
    <p class="rounded-md sm:rounded-full bg-gray-150 dark:bg-gray-650 w-14 h-14 sm:w-20 sm:h-20 | flex flex-col items-center justify-center | leading-5 sm:leading-6 | border border-gray-200 dark:border-gray-600">
        <span class="hidden sm:block text-xs uppercase | text-gray-600 dark:text-gray-200">BASES</span>
        <span class="sm:hidden text-sm uppercase | text-gray-600 dark:text-gray-200">B</span>
        <span class="text-xl sm:text-3xl font-bold">{{ $total_pg }}</span>
    </p>
    <p class="rounded-md sm:rounded-full bg-gray-150 dark:bg-gray-650 w-14 h-14 sm:w-20 sm:h-20 | flex flex-col items-center justify-center | leading-5 sm:leading-6 | border border-gray-200 dark:border-gray-600">
        <span class="hidden sm:block text-xs uppercase | text-gray-600 dark:text-gray-200">ESCOLTAS</span>
        <span class="sm:hidden text-sm uppercase | text-gray-600 dark:text-gray-200">e</span>
        <span class="text-xl sm:text-3xl font-bold">{{ $total_sg }}</span>
    </p>
    <p class="rounded-md sm:rounded-full bg-gray-150 dark:bg-gray-650 w-14 h-14 sm:w-20 sm:h-20 | flex flex-col items-center justify-center | leading-5 sm:leading-6 | border border-gray-200 dark:border-gray-600">
        <span class="hidden sm:block text-xs uppercase | text-gray-600 dark:text-gray-200">ALEROS</span>
        <span class="sm:hidden text-sm uppercase | text-gray-600 dark:text-gray-200">a</span>
        <span class="text-xl sm:text-3xl font-bold">{{ $total_sf }}</span>
    </p>
    <p class="rounded-md sm:rounded-full bg-gray-150 dark:bg-gray-650 w-14 h-14 sm:w-20 sm:h-20 | flex flex-col items-center justify-center | leading-5 sm:leading-6 | border border-gray-200 dark:border-gray-600">
        <span class="hidden sm:block text-xs uppercase | text-gray-600 dark:text-gray-200">ALA-PIVOTS</span>
        <span class="sm:hidden text-sm uppercase | text-gray-600 dark:text-gray-200">ap</span>
        <span class="text-xl sm:text-3xl font-bold">{{ $total_pf }}</span>
    </p>
    <p class="rounded-md sm:rounded-full bg-gray-150 dark:bg-gray-650 w-14 h-14 sm:w-20 sm:h-20 | flex flex-col items-center justify-center | leading-5 sm:leading-6 | border border-gray-200 dark:border-gray-600">
        <span class="hidden sm:block text-xs uppercase | text-gray-600 dark:text-gray-200">PIVOTS</span>
        <span class="sm:hidden text-sm uppercase | text-gray-600 dark:text-gray-200">p</span>
        <span class="text-xl sm:text-3xl font-bold">{{ $total_c }}</span>
    </p>
</div>

<div class="py-6 border-b border-gray-200 dark:border-gray-700">
    <p class="uppercase text-sm md:text-base tracking-wider | text-center | pb-2">
        mvp
    </p>
    <div class="flex flex-col items-center justify-center">
        <img src="{{ $team_mvp->player->getImg() }}" alt="" class="w-32 h-32 sm:w-36 sm:h-36 md:w-48 md:h-48 lg:w-56 lg:h-56 object-cover rounded-full border border-gray-200 dark:border-gray-700">
        <span class="mt-2 text-xs sm:text-sm uppercase">{{ $team_mvp->player->name }}</span>
    </div>
</div>

<div class="py-6">
    <p class="uppercase text-sm md:text-base tracking-wider | text-center | pb-2">
        quinteto inicial
    </p>
    <ul class="flex items-center justify-center space-x-0.5">
        @foreach ($headline->sortBy('POS') as $ps)
            <li class="group cursor-pointer w-16 sm:w-20 md:w-28 lg:w-32 border border-gray-200 dark:border-gray-600 rounded | bg-gray-100 dark:bg-gray-650" wire:click="openPlayerInfo({{ $ps->player->id }})">
                <img src="{{ $ps->player->getImg() }}" alt="{{ $ps->player->name }}" class="mt-3 w-16 h-32 sm:w-20 sm:h-40 md:w-28 md:h-56 lg:w-32 lg:h-64 object-cover | transform origin-bottom group-hover:scale-105 group-focus:scale-105 transition duration-300 ease-in-out">
                <div class="flex flex-col items-center px-2 py-2 | border-t border-gray-200 dark:border-gray-600">
                    <span class="uppercase text-xs sm:text-sm text-center | w-14 sm:16 md:w-24 lg:w-28 truncate ">{{ $ps->player_name }}</span>
                    <span class="hidden sm:block uppercase text-xxs md:text-xs text-center text-gray-500 dark:text-gray-300">{{ $ps->player->getPosition() }}</span>
                    <span class="sm:hidden uppercase text-xxxs sm:text-xs text-center text-gray-500 dark:text-gray-300">{{ $ps->player->getPosition() }}</span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
