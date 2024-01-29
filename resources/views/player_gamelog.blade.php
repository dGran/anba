<x-app-layout blockHeader="0" title="{{ $player->name }}">
    <div>
        @livewire('player_gamelog_manage', ['player' => $player])
    </div>
</x-app-layout>
