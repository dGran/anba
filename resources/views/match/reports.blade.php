@if ($match->userIsParticipant())
	<div class="flex items-center justify-center my-6">
		@if (!$match->played())
		    <x-buttons.primary class="mr-3 uppercase text-xs py-2 leading-4 w-36 md:w-40 lg:w-48" wire:click.prevent="openScoreReportModal">
				reportar resultado
		    </x-buttons.primary>
		@endif

		@if ($match->played() && (!$match->playerStat && !$match->teamStat))
		    <x-buttons.primary class="ml-3 uppercase text-xs py-2 leading-4 w-36 md:w-40 lg:w-48">
				reportar estadisticas
		    </x-buttons.primary>
		@endif
	</div>
@endif