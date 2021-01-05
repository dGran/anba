<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'light:text-red-600 dark:text-red-400 rounded focus:outline-none border border-red-600 dark:border-red-400 hover:bg-red-600 focus:bg-red-600 dark:hover:bg-red-400 dark:focus:bg-red-400 hover:text-white focus:text-white dark:hover:text-gray-900 dark:focus:text-gray-900 transition duration-150 ease-in-out'])
}}>
    {{ $slot }}
</button>