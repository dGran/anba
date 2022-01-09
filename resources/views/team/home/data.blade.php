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
            @include('team.home.card')
        </div>

        <div class="bg-gray-100 dark:bg-gray-700 | border-t border-b border-gray-200 dark:border-gray-700 | px-4 py-3 | uppercase text-sm md:text-base tracking-wider">
            roster
        </div>
        <div class="p-6">
            @include('team.home.roster')
        </div>

        <div class="bg-gray-100 dark:bg-gray-700 | border-t border-b border-gray-200 dark:border-gray-700 | px-4 py-3 | uppercase text-sm md:text-base tracking-wider">
            últimos partidos
        </div>
        <div class="p-6">
            <div>racha</div>
            <div>total ganados / perdidos</div>
            <div>grafico </div>
        </div>

        <div class="bg-gray-100 dark:bg-gray-700 | border-t border-b border-gray-200 dark:border-gray-700 | px-4 py-3 | uppercase text-sm md:text-base tracking-wider">
            histórico
        </div>
        <div class="p-6">
            @include('team.home.history')
        </div>

    </div>
</div>

