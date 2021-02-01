<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'text-white dark:text-gray-900 rounded bg-blue-500 dark:bg-dark-link focus:outline-none hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-300 dark:focus:bg-blue-300 transition duration-150 ease-in-out'])
}}>
    {{ $slot }}
</button>