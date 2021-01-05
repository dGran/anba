<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'light:text-blue-500 dark:text-dark-link rounded focus:outline-none border border-blue-500 dark:border-dark-link hover:bg-blue-500 focus:bg-blue-500 dark:hover:bg-blue-300 dark:focus:bg-blue-300 hover:text-white focus:text-white dark:hover:text-gray-900 dark:focus:text-gray-900 transition duration-150 ease-in-out'])
}}>
    {{ $slot }}
</button>