@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    {{-- <div class=""> --}}
    <div class="text-lg px-6 py-4 border-b">
        {{ $title }}
    </div>

    <div class="px-6 py-4 mt-4">
        {{ $content }}
    </div>
    {{-- </div> --}}

    <div class="px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-modal>
