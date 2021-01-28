<x-app-layout blockHeader="0" title="{{ $match->getName() }}">
    <div>
		@livewire('match', ['match' => $match])
    </div>
</x-app-layout>
