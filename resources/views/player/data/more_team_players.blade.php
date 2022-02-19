<div class="px-3 sm:px-0">
    <h4 class="font-bold text-xl | border-b border-gray-200 dark:border-gray-700 | pb-1.5">
        Explora más jugadores de los {{ $player->team->medium_name }}
    </h4>

    <div class="pt-4 | flex items-center space-x-4 | overflow-x-auto">
        @foreach ($moreTeamPlayers as $mtPlayer)
            <a href="{{ route('player', $mtPlayer->slug) }}" class="bg-white dark:bg-gray-750 | border border-b border-gray-200 dark:border-gray-700 | rounded-t-md | mb-1.5">
                <div class="border-b-4 | flex items-center | relative" style="{{ $player->team ? "border-color: " . $player->team->getDarkenColor(.1) : '' }}">
                    {{-- <img src="{{ $mtPlayer->team->getImg() }}" alt="{{ $mtPlayer->team->medium_name }}" class="" style="height: 160%; width: auto; opacity: .05; position: absolute; min-width: 100%;"> --}}
                    <img src="{{ $mtPlayer->getImg() }}" alt="{{ $mtPlayer->name }}" class="mt-2.5 h-auto w-32 lg:w-40 object-cover">
                    <div class="flex flex-col px-2 | w-72 lg:w-96">
                        <span class="text-xs uppercase">{{ $mtPlayer->getPosition() }}</span>
                        <span class="text-lg font-bold leading-5">{{ $mtPlayer->name }}</span>
                    </div>
                    <div class="absolute top-0 right-0 p-1.5">
                        <img src="{{ $mtPlayer->team->getImg() }}" alt="{{ $mtPlayer->team->medium_name }}" class="w-9 lg:w-12 h-auto">
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
