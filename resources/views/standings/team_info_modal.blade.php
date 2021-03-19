@if ($teamInfoModal)
    <x-modals.dialog maxWidth="" wire:model="teamInfoModal" >
        <x-slot name="title">
            <div class="p-4 border-b border-gray-200 dark:border-gray-650 bg-gray-50 dark:bg-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ $fieldTeamInfoTeam['team_img'] }}" alt="{{ $fieldTeamInfoTeam['team_name'] }}" class="w-16 h-16 object-cover">
                        <div class="flex flex-col ml-3 text-sm">
                            <p>
                               <span class="uppercase mr-1.5">{{ $fieldTeamInfoTeam['team_name'] }}</span><span>- {{ $fieldTeamInfoTeam['team_manager'] }} -</span>
                            </p>
                            <p class="uppercase text-base font-bold tracking-wider">
                                {{ $fieldTeamInfoTitle }}
                            </p>
                        </div>
                    </div>
                    <img src="{{ $fieldTeamInfoTeam['team_manager_img'] }}" alt="{{ $fieldTeamInfoTeam['team_manager'] }}" class="w-12 h-12 object-cover rounded-full">
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="text-sm overflow-y-auto h-96">
                @foreach ($fieldTeamInfoMatches as $match)
                    <div class="py-1.5 {{ $loop->last ? '' : 'border-b' }} border-gray-300 dark:border-gray-650">
                        <div class="flex items-center justify-between text-xs px-4">
                            <span>{{ $match['date'] }}</span>
                            <span>{{ $match["stadium"] }}</span>
                        </div>
                        <div class="flex items-center justify-center text-center py-2">
                             <span class="flex-1 text-right md:hidden mr-3">{{ $match['localTeam_short_name'] }}</span>
                             <span class="flex-1 text-right hidden md:block mr-3">{{ $match['localTeam_medium_name'] }}</span>
                             <img src="{{ $match['localTeam_img'] }}" alt="{{ $match['localTeam_short_name'] }}" class="w-8 h-8 object-cover">
                             <a href="{{ route('match', $match['id']) }}" class="flex-0 flex flex-col mx-3 rounded px-2 py-0.5 w-20 text-center bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-transparent | hover:bg-white focus:bg-white focus:outline-none dark:hover:bg-dark-link dark:hover:text-gray-900 dark:focus:bg-dark-link dark:focus:text-gray-900">
                                 {{ $match['score'] }}
                             </a>
                             <img src="{{ $match['visitorTeam_img'] }}" alt="{{ $match['visitorTeam_short_name'] }}" class="w-8 h-8 object-cover">
                             <span class="flex-1 text-left md:hidden ml-3">{{ $match['visitorTeam_short_name'] }}</span>
                             <span class="flex-1 text-left hidden md:block ml-3">{{ $match['visitorTeam_medium_name'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-slot>
    </x-modals.dialog>
@endif