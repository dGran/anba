<div class="border-t" style="{{ $player->team ? "background-color: " . $player->team->getDarkenColor(-.2) : '' }}; {{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
    <div class="max-w-7xl mx-auto xl:px-8 | relative">
        <div class="flex flex-col lg:flex-row justify-between">
            <div class="flex items-center justify-center lg:justify-start">
                <div class="xl:border-l w-20 lg:w-28 my-3 lg:my-0 lg:py-6 text-white | flex flex-col items-center | font-roboto | leading-5 md:leading-7 lg:leading-10" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <span class="text-xs md:text-sm lg:text-base">PJ</span>
                    <span class="text-xl md:text-2xl lg:text-3xl font-bold | md:-mt-1 lg:-mt-2.5">
                        {{ number_format($playerInfoStats[0]['PJ'], 0, ',', '.') }}
                    </span>
                </div>
                <div class="border-l w-20 lg:w-28 my-3 lg:my-0 lg:py-6 text-white | flex flex-col items-center | font-roboto | leading-5 md:leading-7 lg:leading-10" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <span class="text-xs md:text-sm lg:text-base">PPG</span>
                    <span class="text-xl md:text-2xl lg:text-3xl font-bold | md:-mt-1 lg:-mt-2.5">
                        {{ number_format($playerInfoStats[0]['AVG_PTS'], 1, ',', '.') }}
                    </span>
                </div>
                <div class="border-l w-20 lg:w-28 my-3 lg:my-0 lg:py-6 text-white | flex flex-col items-center | font-roboto | leading-5 md:leading-7 lg:leading-10" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <span class="text-xs md:text-sm lg:text-base">RPG</span>
                    <span class="text-xl md:text-2xl lg:text-3xl font-bold | md:-mt-1 lg:-mt-2.5">
                        {{ number_format($playerInfoStats[0]['AVG_REB'], 1, ',', '.') }}
                    </span>
                </div>
                <div class="border-l w-20 lg:w-28 my-3 lg:my-0 lg:py-6 text-white | flex flex-col items-center | font-roboto | leading-5 md:leading-7 lg:leading-10" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <span class="text-xs md:text-sm lg:text-base">APG</span>
                    <span class="text-xl md:text-2xl lg:text-3xl font-bold | md:-mt-1 lg:-mt-2.5">
                        {{ number_format($playerInfoStats[0]['AVG_AST'], 1, ',', '.') }}
                    </span>
                </div>
            </div>

            <div class="flex-1 lg:border-l xl:border-r" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                <div class="border-t lg:border-t-0" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <div class="max-w-7xl mx-auto | relative">
                        <div class="grid grid-cols-2 sm:grid-cols-4">
                            <div class=" | p-3 | text-white | flex flex-col items-center justify-center | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                                <span class="text-xxs uppercase">posición</span>
                                <span class="text-sm">{{ $player->getPosition() }}</span>
                            </div>
                            <div class="sm:border-l | p-3 | text-white | flex flex-col items-center justify-center | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                                <span class="text-xxs uppercase">edad</span>
                                <span class="text-sm">{{ $player->age() }} años</span>
                            </div>
                            <div class="sm:border-l border-t sm:border-t-0 | p-3 | text-white | flex flex-col items-center justify-center | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                                <span class="text-xxs uppercase">altura</span>
                                <span class="text-sm">{{ $player->height }}</span>
                            </div>
                            <div class="sm:border-l border-t sm:border-t-0 | p-3 | text-white | flex flex-col items-center justify-center | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                                <span class="text-xxs uppercase">peso</span>
                                <span class="text-sm">{{ $player->weight }} lbs</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    <div class="max-w-7xl mx-auto | relative">
                        <div class="grid grid-cols-2 sm:grid-cols-4">
                            <div class=" | p-3 | text-white | flex flex-col items-center justify-center | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                                <span class="text-xxs uppercase">fecha nacimiento</span>
                                <span class="text-sm">{{ $player->getBirthdate() }}</span>
                            </div>
                            <div class="sm:border-l | p-3 | text-white | flex flex-col items-center justify-center | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                                <span class="text-xxs uppercase">pais</span>
                                <p class="text-sm text-center">{{ $player->nation_name }}</p>
                            </div>
                            <div class="sm:border-l border-t sm:border-t-0 | p-3 | text-white | flex flex-col items-center justify-center | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                                <span class="text-xxs uppercase">universidad</span>
                                <p class="text-sm text-center">{{ $player->college }}</p>
                            </div>
                            <div class="sm:border-l border-t sm:border-t-0 | p-3 | text-white | flex flex-col items-center justify-center | font-roboto" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                                <span class="text-xxs uppercase">experiencia</span>
                                <span class="text-sm">{{ $player->getYearsPro() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
