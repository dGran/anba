@extends('layouts.errors', ['title' => 'Error 503'])

@section('content')
	<div class="antialiased flex flex-col items-start max-w-xl mx-6 md:mx-auto my-8 md:my-24">
		<div class="text-5xl md:text-6xl font-black animate__animated animate__bounceInUp">
			Oops!
			{{ Spatie\Emoji\Emoji::noEntry() }}
		</div>
		<div class="w-16 h-1 bg-pretty-red my-3 animate__animated animate__bounceInRight"></div>
		<p class="text-gray-700 dark:text-gray-100 text-2xl md:text-3xl font-light mb-4 leading-normal animate__animated animate__bounceInLeft">
			Servicio no disponible.
		</p>
		<p class="block font-bold text-pretty-red text-sm md:text-base animate__animated animate__bounceInRight animate__delay-1s">
			Código de error: 503
		</p>
		<div class="mt-8 flex items-center | animate__animated animate__bounceInLeft animate__delay-1s">
			<span class="text-4xl mr-5">{{ Spatie\Emoji\Emoji::backhandIndexPointingRight() }}</span>
			<a class="bg-blue-500 dark:bg-dark-link font-bold uppercase text-sm text-white dark:text-gray-900 tracking-wide py-2.5 px-5 rounded-md hover:bg-white hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-400 dark:focus:bg-blue-400 focus:outline-none" href="{{ request()->is('admin/*') ? route('admin') : route('home') }}">
				{{ request()->is('admin/*') ? 'Ir al dashboard' : 'Ir al inicio' }}
			</a>
			<span class="text-4xl ml-5">{{ Spatie\Emoji\Emoji::backhandIndexPointingLeft() }}</span>
		</div>
	</div>
@endsection