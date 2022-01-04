<ul class="flex flex-col space-y-2 mx-3 sm:mx-0">
    <h4 class="">REGULAR SEASON</h4>
    @foreach ($results as $result)
        <li class="relative h-20 rounded-md border border-gray-200 dark:border-transparent flex justify-end {{ $result->localTeam->id == $season_team->id ? 'bg-white dark:bg-gray-700' : 'bg-gray-150 dark:bg-gray-750' }}">
            <div class="flex-inital rounded-l-md w-8 text-white {{ $result->localTeam->id == $season_team->id ? 'bg-blue-500' : 'bg-gray-500' }}">
                <p class="my-7 origin-left-top transform -rotate-90 uppercase">{{ $result->localTeam->id == $season_team->id ? 'Home' : 'Away' }}</p>
            </div>
            <div class="flex-inital mx-2 sm:mx-4 my-auto">
                <img src="{{ $result->localTeam->id == $season_team->id ? $result->visitorTeam->team->getImg() : $result->localTeam->team->getImg() }}" alt="" class="h-16 sm:h-20 w-auto object-cover">
            </div>
            <div class="flex-1 pr-2 sm:pr-0 my-auto flex flex-col">
                <span class="font-roboto font-bold text-lg sm:text-2xl uppercase">
                    {{ $result->scores->first()->getCreatedAtDateShort() }}
                </span>
                <div class="sm:hidden flex items-center">
                    <p class="text-base font-bold mr-2 {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                        {{ $result->winner()->id == $season_team->id ? 'W' : 'L' }}
                    </p>
                    @if ($result->localTeam->id == $season_team->id)
                        <p class="text-base font-normal {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                            {{ $result->localScore() }}
                        </p>
                    @else
                        <p class="text-base font-normal">
                            {{ $result->localScore() }}
                        </p>
                    @endif
                    <p class="text-base">-</p>
                    @if ($result->visitorTeam->id == $season_team->id)
                        <p class="text-base font-normal {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                            {{ $result->visitorScore() }}
                        </p>
                    @else
                        <p class="text-base font-normal">
                            {{ $result->visitorScore() }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="hidden sm:block flex-initial mx-2 my-auto flex justify-end">
                <a href="{{ route('match', $result->id) }}" class="hidden sm:block text-blue-500 dark:text-dark-link rounded focus:outline-none border border-blue-500 dark:border-dark-link hover:bg-blue-500 focus:bg-blue-500 dark:hover:bg-blue-300 dark:focus:bg-blue-300 hover:text-white focus:text-white dark:hover:text-gray-900 dark:focus:text-gray-900 transition duration-150 ease-in-out | uppercase text-xs py-1 px-4 text-center">
                    ficha del partido
                </a>
            </div>
            <div class="hidden sm:flex flex-inital px-2 my-auto flex justify-end">
                <p class="w-6 text-center text-xl font-bold {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                    {{ $result->winner()->id == $season_team->id ? 'W' : 'L' }}
                </p>
            </div>
            <div class="hidden sm:flex flex-inital px-4 my-auto w-24 flex items-center justify-center">
                @if ($result->localTeam->id == $season_team->id)
                    <p class="text-xl font-normal {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                        {{ $result->localScore() }}
                    </p>
                @else
                    <p class="text-xl font-normal">
                        {{ $result->localScore() }}
                    </p>
                @endif
                <p class="mx-1 text-xl">-</p>
                @if ($result->visitorTeam->id == $season_team->id)
                    <p class="text-xl font-normal {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                        {{ $result->visitorScore() }}
                    </p>
                @else
                    <p class="text-xl font-normal">
                        {{ $result->visitorScore() }}
                    </p>
                @endif
            </div>

            <x-link href="{{ route('match', $result->id) }}" class="sm:hidden | absolute top-0 right-0 mr-2 mt-2 | text-lg">
                <i class="fas fa-eye"></i>
            </x-link>
        </li>
    @endforeach
</ul>
