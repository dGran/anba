{{-- work in progress mark... --}}
<h4 class="px-3 sm:px-0 pb-3 text-pretty-red text-2xl">Work in progress...</h4>
{{-- work in progress mark... --}}

<div class="bg-white dark:bg-gray-750 sm:rounded border-t border-b sm:border border-gray-200 dark:border-gray-700">
    <div class="flex flex-col">
        <div class="flex items-center space-x-2 md:space-x-4 | text-sm md:text-base | p-4">
            <img src="{{ $season_team->team->getImg() }}" alt="{{ $season_team->team->medium_name }}" class="w-24 h-24 md:w-36 md:h-36 object-cover">
            <div class="flex flex-col">
                <span class="text-lg md:text-3xl">{{ $season_team->team->name }}</span>
                <span class="text-base md:text-xl">({{ $season_team->team->short_name }}) {{ $season_team->team->medium_name }}</span>
            </div>
        </div>

        <div class="bg-gray-100 dark:bg-gray-700 | border-t border-b border-gray-200 dark:border-gray-700 | px-4 py-3 | uppercase text-sm md:text-base tracking-wider">
            ficha
        </div>
        <div class="p-6 | flex flex-col lg:flex-row items-start justify-between">
            <div>
                <p>
                    <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">Conferencia</span>
                    <span>{{ $season_team->seasonDivision->seasonConference->conference->name }}</span>
                </p>
                <p>
                    <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">Division</span>
                    <span>{{ $season_team->seasonDivision->division->name }}</span>
                </p>
                <p>
                    <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">manager</span>
                    <a href="#" class="hover:underline focus:underline focus:outline-none">{{ $season_team->team->user->name }}</a>
                </p>
                <p>
                    <span class="text-xs md:text-sm uppercase text-gray-400 font-medium mr-2">Estadio</span>
                    <span>{{ $season_team->team->stadium }}</span>
                </p>
            </div>
            <img src="https://cdn.themedizine.com/2020/07/united-centerr.jpg" alt="" class="w-full h-auto md:w-96 md:h-60 object-cover rounded | pt-6 lg:pt-0">
        </div>

        <div class="bg-gray-100 dark:bg-gray-700 | border-t border-b border-gray-200 dark:border-gray-700 | px-4 py-3 | uppercase text-sm md:text-base tracking-wider">
            roster
        </div>
        <div class="p-6">
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
                        {{-- <p>{{ $player->player->name }}</p> --}}
                    @endforeach
                </ul>
            </div>

            <div>mvp</div>

            <div class="flex items-center | space-x-4">
                <div class="">
                    jóvenes
                    @foreach ($season_team->team->players->sortByDesc('birthdate')->take(3) as $player)
                        <p>{{ $player->name }}, {{ $player->Age() }}</p>
                    @endforeach
                </div>
                <div class="">
                    veteranos
                    @foreach ($season_team->team->players->sortBy('birthdate')->take(3) as $player)
                        <p>{{ $player->name }}, {{ $player->Age() }}</p>
                    @endforeach
                </div>

            </div>
        </div>

        <div class="bg-gray-100 dark:bg-gray-700 | border-t border-b border-gray-200 dark:border-gray-700 | px-4 py-3 | uppercase text-sm md:text-base tracking-wider">
            últimos partidos
        </div>
        <div class="p-6">
            <div>racha</div>
            <div>total ganados / perdidos</div>
            <div>grafico </div>
        </div>

    </div>
</div>

