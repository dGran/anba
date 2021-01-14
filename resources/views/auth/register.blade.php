<x-guest-layout>
    <div class="py-6 md:py-16 bg-gray-100 dark:bg-gray-850 flex flex-col items-center mx-4 lg:mx-0">
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
            <p class="text-xl uppercase tracking-widest border-b border-gray-200 dark:border-gray-650 pb-3 mb-5">
                registro usuario
            </p>

            <form method="POST" action="{{ route('register') }}" class="mx-6">
                @csrf

                <div class="text-gray-700 dark:text-white mt-4">
                    <label for="name" class="text-sm uppercase">
                        {{ __('nombre') }}
                    </label>
                    <input id="name" class="appearance-none rounded-md text-sm | py-2 px-3 mt-1 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none | block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                </div>

                <div class="text-gray-700 dark:text-white mt-4">
                    <label for="email" class="text-sm uppercase">
                        {{ __('correo electrónico') }}
                    </label>
                    <input id="email" class="appearance-none rounded-md text-sm | py-2 px-3 mt-1 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none | block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mt-4 text-gray-700 dark:text-white">
                    <label for="password" class="text-sm uppercase">
                        {{ __('contraseña') }}
                    </label>
                    <input id="password" minlength="8" class="appearance-none rounded-md text-sm | py-2 px-3 mt-1 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none | block mt-1 w-full" type="password" name="password" required autocomplete="new-password">
                    <p class="text-xs text-right pt-1">*Min. 8 caracteres</p>
                </div>

                <div class="mt-4 text-gray-700 dark:text-white">
                    <label for="password_confirmation" class="text-sm uppercase">
                        {{ __('confirma tu contraseña') }}
                    </label>
                    <input id="password_confirmation" minlength="8" class="appearance-none rounded-md text-sm | py-2 px-3 mt-1 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none | block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="flex items-center justify-end mt-5">
                    <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-dark-link rounded-md font-semibold text-xs text-white dark:text-gray-700 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-blue-300 active:bg-gray-600 dark:active:bg-blue-200 focus:outline-none focus:bg-gray-600 dark:focus:bg-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('crear cuenta') }}
                    </button>
                </div>
            </form>
        </div>

        <a class="my-4 underline text-sm text-gray-600 dark:text-gray-100 hover:text-gray-900 dark:hover:text-gray-300 focus:text-gray-900 dark:focus:text-gray-300 focus:outline-none" href="{{ route('login') }}">
            {{ __('¿YA ESTAS REGISTRADO? INICIA SESION') }}
        </a>
    </div>
</x-guest-layout>