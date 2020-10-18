{{-- edit --}}
@if ($regsSelected->count() == 1)
    <div class="flex items-center justify-center p-2 w-12 h-10 rounded border border-indigo-200 bg-white text-xl cursor-pointer text-gray-600 hover:text-indigo-500 focus:text-indigo-500 hover:border-indigo-300 focus:border-indigo-300"
    wire:click="edit({{ $regsSelected->first()->id }})">
        <i class="fas fa-edit"></i>
    </div>
@endif

{{-- destroy --}}
<div class="flex items-center justify-center p-2 w-12 h-10 rounded border border-indigo-200 bg-white text-xl cursor-pointer text-gray-600 hover:text-indigo-500 focus:text-indigo-500 hover:border-indigo-300 focus:border-indigo-300"
wire:click="confirmDestroy">
    <i class="fas fa-trash"></i>
</div>