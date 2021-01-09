@props(['active'])

@php
$classes_li = ($active ?? false)
            ? 'text-sm uppercase border-b border-gray-700 bg-gray-800'
            : 'text-sm uppercase border-b border-gray-700';
$classes = ($active ?? false)
            ? 'flex items-center justify-between px-6 py-3 border-l-4 border-dark-link text-base leading-5 uppercase text-dark-link focus:outline-none transition duration-150 ease-in-out pointer-events-none'
            : 'group flex items-center justify-between px-6 py-3 text-sm uppercase text-gray-300 leading-5 focus:outline-none transition duration-150 ease-in-out hover:text-white focus:text-white transform hover:-translate-x-1 focus:-translate-x-1 hover:bg-gray-800 focus:bg-gray-800 active:bg-gray-800';
@endphp

<li {{ $attributes->merge(['class' => $classes_li]) }}>
	<a {{ $attributes->merge(['class' => $classes]) }}>
	    <span class="{{ $active ? 'animate-pulse' : '' }}">{{ $slot }}</span>
    	<i class="fas fa-chevron-right {{ $active ? 'text-dark-link' : 'text-gray-600 group-hover:text-white group-focus:text-white' }}"></i>
	</a>
</li>
