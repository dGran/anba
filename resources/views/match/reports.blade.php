@if ($match->userIsParticipant() || (auth()->user() && auth()->user()->hasRole(['admin', 'super-admin'])))
	<div class="flex items-center justify-center my-6">
		@if (!$match->played())
		    <x-buttons.primary class="mr-3 uppercase text-xs py-2 leading-4 w-36 md:w-40 lg:w-48" wire:click.prevent="openScoreReportModal">
				reportar resultado
		    </x-buttons.primary>
		@endif

		@if ($match->played() && ( (!$match->hasLocalTeamStats() && !$match->hasLocalPlayerStats()) || (!$match->hasvisitorTeamStats() && !$match->hasvisitorPlayerStats()) ))
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <div class="flex items-center">
					    <x-buttons.primary class="ml-3 uppercase text-xs py-2 leading-4 px-3 inline-flex items-center transition-colors duration-150">
						    <span>reportar estadisticas</span>
						    <svg class="w-4 h-4 ml-3 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
					    </x-buttons.primary>
                    </div>
                </x-slot>

                <x-slot name="content">
                	@if (!$match->hasLocalTeamStats() && !$match->hasLocalPlayerStats())
	                    <x-dropdown-link class="flex items-center cursor-pointer" wire:click.prevent="openLocalBoxscoreReport">
	                        <img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->medium_name }}" class="w-7 h-7 object-cover mr-2">
	                        <span>{{ $match->localTeam->team->name }}</span>
	                    </x-dropdown-link>
                	@endif
                	@if (!$match->hasvisitorTeamStats() && !$match->hasvisitorPlayerStats())
	                    <x-dropdown-link class="flex items-center cursor-pointer" wire:click.prevent="openVisitorBoxscoreReport">
	                        <img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->medium_name }}" class="w-7 h-7 object-cover mr-2">
	                        <span>{{ $match->visitorTeam->team->name }}</span>
	                    </x-dropdown-link>
                	@endif
                </x-slot>
            </x-dropdown>
		@endif
	</div>
@endif