@props(['active'])

@php
$classes = ($active ?? false)
            ? 'uppercase inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-dark-link dark:text-pink-400 focus:outline-none transition duration-150 ease-in-out pointer-events-none'
            : 'uppercase inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-white hover:text-dark-link dark:hover:text-pink-400 focus:text-dark-link dark:focus:text-pink-400 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
