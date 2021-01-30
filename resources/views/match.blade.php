<x-app-layout blockHeader="0" title="{{ $match->getshortName() }}">
    <div>
		@livewire('match', ['match' => $match])
    </div>
</x-app-layout>
