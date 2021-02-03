<x-app-layout blockHeader="0" title="{{ $match->getshortName() }} | {{ $match->round_id ? 'Playoffs' : 'Liga regular' }} | {{ $match->season->name }}">
    <div>
		@livewire('match', ['match' => $match])
    </div>
</x-app-layout>
