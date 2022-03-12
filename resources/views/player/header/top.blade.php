<div class="bg-white dark:bg-gray-750" style="{{ $player->team ? "background-color: rgba(" . $player->team->getRGBColor() . ", 1)" : '' }}">
    <div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 | relative">
        <div class="brandBG | flex items-center pt-8 md:pt-16">
            <img src="{{ $player->team->getImg() }}" alt="{{ $player->team->medium_name }}"
            class="h-auto | absolute top-0 left-0 ml-6 mt-4" style="width: 11%; z-index: 2;">
            <img src="{{ $player->getImg() }}" alt="{{ $player->name }}" class="ml-6 h-auto" style="z-index: 1; width: 28%">
            <div class="flex flex-col justify-center px-3 | text-white">
                <span class="text-xs sm:text-sm lg:text-base xl:text-lg font-semibold -mb-1 sm:mb-0 lg:mb-2 xl:mb-4">
                    {{ $player->team->name }} | {{ $player->getPosition() }}
                </span>
                <span class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-bold | leading-7">
                    {{ $player->name }}
                </span>
                @if ($player->nickname)
                    <span class="text-center text-sm sm:text-base lg:text-lg xl:text-xl font-semibold | my-1.5 sm:my-3 lg:my-6 xl:my-8 | italic">"{{ $player->nickname }}"</span>
                @endif
            </div>
        </div>
    </div>
</div>
