@props(['active'])

@php
$classes = ($active ?? false)
            ? 'uppercase inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-white font-bold dark:text-dark-link focus:outline-none transition duration-150 ease-in-out pointer-events-none'
            : 'uppercase inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-300 hover:text-white focus:text-white focus:outline-none transition duration-150 ease-in-out
            transform hover:translate-y-0.5';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
