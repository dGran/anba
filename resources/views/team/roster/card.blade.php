<ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 sm:gap-6 | border-l border-r border-b sm:border-none border-gray-200 dark:border-gray-700">
    @foreach ($players as $player)
        <li class="group | relative | bg-gray-100 dark:bg-gray-700 | sm:rounded sm:shadow-md | flex flex-col | border-t sm:border border-gray-200 dark:border-gray-700">

            <div class="bg-white dark:bg-gray-750 | sm:rounded-t | flex items-center | group-hover:bg-gray-100 dark:group-hover:bg-gray-700">
                <figure class="w-2/6 sm:w-full max-w-xs | mt-6">
                    <img src="{{ $player->getImg() }}" alt="" class="h-fit sm:h-32 w-full sm:w-auto sm:mx-auto object-cover | transform origin-bottom group-hover:scale-105 group-focus:scale-105 transition duration-300 ease-in-out">
                </figure>
                <div class="flex flex-col leading-5 sm:hidden ml-4">
                    <span class="font-semibold text-base">{{ $player->name }}</span>
                    <span class="text-sm">{{ $player->getPosition() }}</span>
                </div>
            </div>

            <div class="hidden sm:flex flex-col leading-5 | sm:rounded-b | p-3">
                <span class="font-semibold text-base">{{ $player->name }}</span>
                <span class="text-sm">{{ $player->getPosition() }}</span>
            </div>

            <div class="absolute bottom-0 right-0 | mr-1.5 mb-0.5">
                @if ($player->injury_id)
                    <span class="sm:hidden | text-xl sm:text-2xl | mr-1.5 | {{ $player->injury_playable ? 'text-yellow-300' : 'text-pretty-red' }}">
                        <i class="fas fa-briefcase-medical"></i>
                    </span>
                @endif
                <button class="text-lg | text-gray-800 dark:text-dark-link | focus:outline-none" wire:click="openPlayerInfo({{ $player->id }})">
                    <i class="fas fa-info-circle"></i>
                </button>
            </div>

            <div class="absolute top-0 left-0">
                <span class="text-lg sm:text-xl | uppercase | font-bold | ml-1.5">
                    {{ $player->position }}
                </span>
            </div>

            @if ($player->injury_id)
                <div class="hidden sm:block absolute top-0 right-0">
                    <span class="text-xl sm:text-2xl | mr-1.5 | {{ $player->injury_playable ? 'text-yellow-300' : 'text-pretty-red' }}">
                        <i class="fas fa-briefcase-medical"></i>
                    </span>
                </div>
            @endif

        </li>
    @endforeach
</ul>
