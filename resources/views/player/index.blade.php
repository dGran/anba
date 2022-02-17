<div>
    <div class="bg-white dark:bg-gray-750" style="{{ $player->team ? "background-color: rgba(" . $player->team->getRGBColor() . ", 1)" : '' }}">
        <div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 | relative">
        {{-- work in progress mark... --}}
            <h4 class="pt-6 px-3 sm:px-0 pb-3 text-yellow-300 text-2xl | absolute top-0 right-0 mr-4 animate-pulse">Work in progress...</h4>
        {{-- work in progress mark... --}}

            <div class="flex items-center space-x-6 pt-16 mx-8">
                <img src="{{ $player->team->getImg() }}" alt="{{ $player->team->medium_name }}"
                class="h-auto | absolute top-0 left-0 ml-6 mt-4" style="width: 12%;">
                <img src="{{ $player->getImg() }}" alt="{{ $player->name }}" class="h-auto w-2/6">
                <div class="flex flex-col">
                    <span class="text-white text-sm md:text-base lg:text-lg xl:text-xl font-semibold">
                        {{ $player->team->name }} | {{ $player->getPosition() }}
                    </span>
                    <span class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-white -mt-1 md:-mt-2 lg:-mt-3 xl:-mt-4">
                        {{ $player->name }}
                    </span>

                </div>
            </div>
        </div>
    </div>

    <div class="border-t" style="{{ $player->team ? "background-color: " . $player->team->getDarkenColor(-.2) : '' }}; {{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
        <div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 | relative">
            <div class="flex items-center">
                <div class="border-l p-4 text-white | flex flex-col items-center | leading-7 | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <span class="text-base font-semibold">PPG</span>
                    <span class="text-3xl font-bold">
                        {{ number_format($playerInfoStats[0]['AVG_PTS'], 1, ',', '.') }}
                    </span>
                </div>
                <div class="border-l p-4 text-white | flex flex-col items-center | leading-7 | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <span class="text-base font-semibold">RPG</span>
                    <span class="text-3xl font-bold">
                        {{ number_format($playerInfoStats[0]['AVG_REB'], 1, ',', '.') }}
                    </span>
                </div>
                <div class="border-l p-4 text-white | flex flex-col items-center | leading-7 | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <span class="text-base font-semibold">APG</span>
                    <span class="text-3xl font-bold">
                        {{ number_format($playerInfoStats[0]['AVG_AST'], 1, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
