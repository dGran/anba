<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'text-white rounded bg-orange-500 focus:outline-none hover:bg-orange-600 focus:bg-orange-600 transition duration-150 ease-in-out'])
}}>
    {{ $slot }}
</button>