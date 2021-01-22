@props(['active'])

@php
$classes_li = ($active ?? false)
            ? 'text-sm uppercase border-b border-header-bg-dark dark:border-gray-800 bg-header-bg-dark dark:bg-gray-800'
            : 'text-sm uppercase border-b border-header-bg-dark dark:border-gray-800';
$classes = ($active ?? false)
            ? 'flex items-center justify-between px-6 py-3 border-l-4 border-white dark:border-dark-link text-base leading-4 uppercase text-white dark:text-dark-link focus:outline-none transition duration-150 ease-in-out pointer-events-none'
            : 'group flex items-center justify-between px-6 py-3 text-sm uppercase text-gray-300 leading-4 focus:outline-none transition duration-150 ease-in-out hover:text-white focus:text-white transform hover:-translate-x-1 focus:-translate-x-1 hover:bg-header-bg-lighter focus:bg-header-bg-lighter active:bg-header-bg-lighter dark:hover:bg-gray-800 dark:focus:bg-gray-800 dark:active:bg-gray-800';
@endphp

<li {{ $attributes->merge(['class' => $classes_li]) }}>
	<a {{ $attributes->merge(['class' => $classes]) }} class="">
		<span><i class="{{ $icon }} mr-4 text-xl"></i></span>
	    <span class="flex-1">{{ $slot }}</span>
    	<i class="fas fa-chevron-right {{ $active ? 'text-white dark:text-dark-link' : 'text-gray-400 dark:text-gray-500 group-hover:text-white group-focus:text-white' }}"></i>
	</a>
</li>
