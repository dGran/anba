@props(['id' => null, 'maxWidth' => null])

<x-modals.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }} style="z-index: 0">
    {{-- <div class=""> --}}
    <div class="">
        {{ $title }}
    </div>

    <div class="">
        {{ $content }}
    </div>
    {{-- </div> --}}

    <div class="text-right">
        {{ $footer }}
    </div>
</x-modals.modal>
