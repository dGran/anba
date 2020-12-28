@props(['active'])

@php
$classes = ($active ?? false)
            ? 'uppercase inline-flex items-center px-1 pt-1 border-b-2 border-indigo-200 text-xs font-medium leading-5 text-indigo-200 focus:outline-none transition duration-150 ease-in-out pointer-events-none'
            : 'uppercase inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-white hover:text-indigo-200 hover:border-indigo-200 focus:outline-none focus:text-dark-link focus:border-dark-link transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
