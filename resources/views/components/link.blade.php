<a {{ $attributes->merge(['class' => 'text-blue-500 dark:text-dark-link hover:text-blue-600 dark:hover:text-blue-300 focus:text-blue-600 dark:focus:text-blue-300 focus:outline-none inline-flex items-center transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>