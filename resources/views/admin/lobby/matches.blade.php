<div>
    <h4 class="text-lg font-semibold mb-1.5 | pb-1.5">Partidos disponibles ({{ $matches->count() }})</h4>
    <ul class="text-sm | space-y-2.5">
        @foreach ($matches as $match)
            <li class="bg-white dark:bg-gray-750 | border border-gray-200 dark:border-gray-700 rounded | py-1.5 | hover:border-blue-400 dark:hover:border-dark-link | select-none">
                <a href="{{ route('match', $match->id) }}">
                    <div class="flex flex-col items-center">
                        <p class="text-xs">
                            ID: {{ $match->id }}
                        </p>
                        <div class="flex items-center">
                            <div class="flex-1 flex items-center justify-end">
                                <div class="flex flex-col items-end">
                                    <span>{{ $match->localTeam->team->medium_name }}</span>
                                    <span class="text-xs text-gray-400">{{ $match->localTeam->team->user->name }}</span>
                                </div>
                                <img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->medium_name }}" class="w-12 h-12 object-cover | ml-1.5">
                            </div>
                            <div class="flex-0 w-12 text-center | text-2xl font-bold">Vs</div>
                            <div class="flex-1 flex items-center justify-start">
                                <img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->medium_name }}" class="w-12 h-12 object-cover | mr-1.5">
                                <div class="flex flex-col items-start">
                                    <span>{{ $match->visitorTeam->team->medium_name }}</span>
                                    <span class="text-xs text-gray-400">{{ $match->visitorTeam->team->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>
