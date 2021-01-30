@if ($match->userIsParticipant())
	<div class="flex items-center justify-center">
	    <x-buttons.primary class="mr-3 uppercase text-xs py-2 leading-4 w-36 md:w-40 lg:w-48">
			reportar resultado
	    </x-buttons.primary>
	    <x-buttons.primary class="ml-3 uppercase text-xs py-2 leading-4 w-36 md:w-40 lg:w-48">
			reportar estadisticas
	    </x-buttons.primary>
	</div>
@endif