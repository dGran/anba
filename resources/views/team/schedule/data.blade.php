@if ($results->count() > 0)
    <p class="pb-3 mx-4 sm:mx-1 | text-xs md:text-sm uppercase tracking-wider">
        {{ $results->count() }} partidos
    </p>

    <ul class="flex flex-col space-y-2 mx-3 sm:mx-0">
        @foreach ($results as $result)
            <li class="relative h-20 rounded-md border border-gray-200 dark:border-transparent hover:border-blue-500 dark:hover:border-dark-link focus:border-blue-500 dark:focus:border-dark-link | flex justify-end {{ $result->localTeam->id == $season_team->id ? 'bg-white dark:bg-gray-700' : 'bg-gray-150 dark:bg-gray-750' }}">
                <div class="flex-inital rounded-l-md w-8 text-white {{ $result->localTeam->id == $season_team->id ? 'bg-blue-500' : 'bg-gray-500' }}">
                    <p class="my-7 origin-left-top transform -rotate-90 uppercase">{{ $result->localTeam->id == $season_team->id ? 'Home' : 'Away' }}</p>
                </div>
                <div class="flex-inital mx-2 md:mx-4 my-auto">
                    <img src="{{ $result->localTeam->id == $season_team->id ? $result->visitorTeam->team->getImg() : $result->localTeam->team->getImg() }}" alt="" class="h-16 md:h-20 w-auto object-cover">
                </div>
                @if ($result->played)
                    <div class="flex-1 pr-2 md:pr-0 my-auto flex flex-col">
                        <div class="md:px-4 | font-roboto text-xs md:text-sm | text-gray-500 dark:text-gray-400">
                            {{ $result->clash_id ? $result->clash->round->playoff->name. ': ' . $result->clash->round->name .' (P. ' . $result->order . ')' : 'Liga regular' }}
                        </div>

                        <div class="md:hidden flex items-center">
                            <p class="text-lg font-bold mr-4 {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                                {{ $result->winner()->id == $season_team->id ? 'W' : 'L' }}
                            </p>
                            @if ($result->localTeam->id == $season_team->id)
                                <p class="text-lg font-normal {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $result->localScore() }}
                                </p>
                            @else
                                <p class="text-lg font-normal">
                                    {{ $result->localScore() }}
                                </p>
                            @endif
                            <p class="text-lg">-</p>
                            @if ($result->visitorTeam->id == $season_team->id)
                                <p class="text-lg font-normal {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $result->visitorScore() }}
                                </p>
                            @else
                                <p class="text-lg font-normal">
                                    {{ $result->visitorScore() }}
                                </p>
                            @endif
                        </div>

                        <span class="md:hidden font-roboto font-bold text-lg md:text-2xl uppercase">
                            {{ $result->scores->first()->getCreatedAtDateShort() }}
                        </span>

                        <div class="hidden md:flex flex-inital px-4 my-auto | flex items-center justify-center md:justify-start">
                            <p class="w-6 mr-4 | text-2xl font-bold {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                                {{ $result->winner()->id == $season_team->id ? 'W' : 'L' }}
                            </p>
                            @if ($result->localTeam->id == $season_team->id)
                                <p class="text-2xl font-normal {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $result->localScore() }}
                                </p>
                            @else
                                <p class="text-2xl font-normal">
                                    {{ $result->localScore() }}
                                </p>
                            @endif
                            <p class="mx-1 text-2xl">-</p>
                            @if ($result->visitorTeam->id == $season_team->id)
                                <p class="text-2xl font-normal {{ $result->winner()->id == $season_team->id ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $result->visitorScore() }}
                                </p>
                            @else
                                <p class="text-2xl font-normal">
                                    {{ $result->visitorScore() }}
                                </p>
                            @endif
                        </div>
                    </div>


                    <p class="hidden md:flex | my-auto | font-roboto font-bold | text-lg md:text-2xl uppercase | mr-4">
                        {{ $result->scores->first()->getCreatedAtDateShort() }}
                    </p>

                    <div class="hidden sm:block flex-initial mx-2 my-auto flex justify-end">
                        <a href="{{ route('match', $result->id) }}" class="block | w-40 | text-white dark:text-gray-900 rounded bg-blue-500 dark:bg-dark-link focus:outline-none hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-300 dark:focus:bg-blue-300 transition duration-150 ease-in-out | uppercase text-xs py-1 px-4 text-center">
                            ficha del partido
                        </a>
                    </div>

                    <x-link href="{{ route('match', $result->id) }}" class="sm:hidden | absolute top-0 right-0 mr-2 mt-2 | text-lg">
                        <i class="fas fa-eye"></i>
                    </x-link>
                @else
                    <div class="flex-1 md:px-4 my-auto flex flex-col">
                        <span class="font-roboto text-xs md:text-sm | text-gray-500 dark:text-gray-400">
                            {{ $result->playoffs ? $result->clash->playoff->round->name : 'Liga regular' }}
                        </span>
                        <span class="font-roboto text-sm md:text-base">
                            {{ $result->stadium }}
                        </span>
                    </div>
                    <div class="hidden sm:block flex-initial mx-2 my-auto flex justify-end">
                        <a href="{{ route('match', $result->id) }}" class="block | w-40 | text-blue-500 dark:text-dark-link rounded focus:outline-none border border-blue-500 dark:border-dark-link hover:bg-blue-500 focus:bg-blue-500 dark:hover:bg-blue-300 dark:focus:bg-blue-300 hover:text-white focus:text-white dark:hover:text-gray-900 dark:focus:text-gray-900 transition duration-150 ease-in-out | uppercase text-xs py-1 px-4 text-center">
                            informe pre-partido
                        </a>
                    </div>

                    <x-link href="{{ route('match', $result->id) }}" class="sm:hidden | absolute top-0 right-0 mr-2 mt-2 | text-lg">
                        <i class="fas fa-eye"></i>
                    </x-link>
                @endif
            </li>
        @endforeach
    </ul>
@else
    <div class="mx-3 sm:mx-0 | h-20 | rounded-md border border-gray-200 dark:border-transparent flex justify-center | bg-white dark:bg-gray-700">
        <p class="my-auto text-center px-4 text-base md:text-lg">
            No se han encontrado partidos con los filtros seleccionados
        </p>
    </div>
@endif
