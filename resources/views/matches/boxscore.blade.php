@if ($regEdit)
	<x-modals.dialog maxWidth="xl" wire:model="boxscoreModal" >
	    <x-slot name="title">
			<div class="p-4">
				<p class="uppercase text-sm font-bold tracking-wider">BOXSCORE</p>
			</div>
	    </x-slot>

	    <x-slot name="content">
			<div class="px-4 pb-2">
				content here...
			</div>

	    </x-slot>
	</x-jet-confirmation-modal>
@endif