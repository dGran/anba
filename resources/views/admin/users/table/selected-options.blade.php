<div class="{{ $regsSelected->count() == 0 ? 'hidden' : 'block' }} fixed bottom-0 left-0 right-0 text-xs bg-gray-50 overflow-x-auto" style="-webkit-box-shadow: 1px -4px 4px -2px rgba(212,212,212,1);
-moz-box-shadow: 1px -4px 4px -2px rgba(212,212,212,1);
box-shadow: 1px -4px 4px -2px rgba(212,212,212,1);">

    {{-- info-selected --}}
    @include('livewire.partials.admin.selected-options.info')
    {{-- END::info-selected --}}

    {{-- options --}}
    <div class="flex items-center justify-center gap-1 pb-4">
        @include('livewire.partials.admin.selected-options.options')

    </div>
    {{-- END::options --}}

</div>