@props(['id' => null, 'maxWidth' => null, 'closeOnOutsideClick' => "1", 'closeOnEscKey' => "1"])

<x-modals.modal :id="$id" :maxWidth="$maxWidth" :closeOnOutsideClick="$closeOnOutsideClick" :closeOnEscKey="$closeOnEscKey" {{ $attributes }}>
    <div class="">
        {{ $title }}
    </div>
    <div class="">
        {{ $content }}
    </div>

{{--     <div class="text-right">
        {{ $footer }}
    </div> --}}
</x-modals.modal>
