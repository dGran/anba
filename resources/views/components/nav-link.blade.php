@props(['active'])

@php
$classes = ($active ?? false)
            ? 'uppercase inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-blue-200 focus:outline-none transition duration-150 ease-in-out pointer-events-none'
            : 'uppercase inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-white hover:text-dark-link focus:text-dark-link focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
