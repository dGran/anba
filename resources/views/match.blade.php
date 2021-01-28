<x-app-layout blockHeader="0">

	@section('title', $match->getName())

    <div>
		@livewire('match', ['match' => $match])
    </div>
</x-app-layout>
