<x-guest-layout title="Solicitud nueva contraseña">

    <div class="pt-6 pb-10 md:py-16 bg-gray-100 dark:bg-gray-850 flex flex-col items-center mx-4 lg:mx-0">
        <x-jet-authentication-card-logo />

        <div class="w-full sm:max-w-lg mt-6 px-6 py-6 bg-white dark:bg-gray-750 shadow-md overflow-hidden rounded-lg">
            @if ($errors->any())
                <div class="mb-4">
                    <div class="text-sm bg-yellow-100 text-gray-700 p-3 text-center rounded">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li class="appearance-none">{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if (session('status'))
                <div class="mb-4">
                    <div class="text-sm border bg-green-100 border-green-300 text-green-500 dark:bg-green-500 dark:border-green-400 dark:text-white p-3 text-center rounded">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <div class="border-b border-gray-200 dark:border-gray-650 pb-3 mb-5 text-center">
                <h4 class="text-xl uppercase tracking-wider md:tracking-widest">
                    solicitar nueva contraseña
                </h4>
                <p class="my-4 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Indícanos la dirección de correo electrónico con la que estas registrado y te enviaremos un correo electrónico con instrucciones.') }}
                </p>
            </div>


            <form method="POST" action="{{ route('password.email') }}" class="mx-6">
                @csrf

                <div class="text-gray-700 dark:text-white mt-4">
                    <label for="email" class="text-sm uppercase">
                        {{ __('correo electrónico') }}
                    </label>
                    <input id="email" class="appearance-none rounded-md text-sm | py-2 px-3 mt-1 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none | block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus />
                </div>


                <div class="my-6 mb-3">
                    <button type="submit" class="w-full text-center px-4 py-3 bg-gray-800 dark:bg-dark-link rounded-md font-semibold text-xs text-white dark:text-gray-700 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-blue-300 active:bg-gray-600 dark:active:bg-blue-200 focus:outline-none focus:bg-gray-600 dark:focus:bg-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('solicitar nueva contraseña') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
