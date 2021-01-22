<x-guest-layout>
    <div class="py-6 md:py-16 flex flex-col items-center mx-4 lg:mx-0">
        <x-jet-authentication-card-logo />

        <div class="w-full sm:max-w-lg mt-6 px-6 py-6 bg-white dark:bg-gray-750 shadow-md overflow-hidden rounded-lg">
            @if ($errors->any())
                <div class="mb-4">
                    <div class="text-sm bg-yellow-100 text-gray-700 p-3 text-center rounded">
                        Contraseña incorrecta
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

            <p class="text-xl uppercase tracking-widest border-b border-gray-200 dark:border-gray-650 pb-3 mb-5">
                control de acceso
            </p>


            <form method="POST" action="{{ route('password.confirm') }}" class="mx-6">
            	<p class="text-sm sm:text-base">
            		Por favor, confirme su contraseña para acceder al <strong>Panel de Administración.</strong>
            	</p>
                @csrf

                <div class="mt-4 text-gray-700 dark:text-white">
                    <label for="password" class="text-sm uppercase">
                        {{ __('contraseña') }}
                    </label>
                    <input id="password" class="appearance-none rounded-md text-sm | py-2 px-3 mt-1 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-dark-link dark:hover:border-dark-link | focus:outline-none | block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus>
                </div>

                <div class="flex items-center justify-end mt-5">
{{--                     @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-100 hover:text-gray-900 dark:hover:text-gray-300 focus:text-gray-900 dark:focus:text-gray-300 focus:outline-none" href="{{ route('password.request') }}">
                            {{ __('Olvidé mi contraseña') }}
                        </a>
                    @endif --}}

                    <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-dark-link rounded-md font-semibold text-xs text-white dark:text-gray-700 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-blue-300 active:bg-gray-600 dark:active:bg-blue-200 focus:outline-none focus:bg-gray-600 dark:focus:bg-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Confirmar contraseña') }}
                    </button>
                </div>
            </form>
        </div>

        <a class="my-4 underline text-sm text-gray-600 dark:text-gray-100 hover:text-gray-900 dark:hover:text-gray-300 focus:text-gray-900 dark:focus:text-gray-300 focus:outline-none" href="{{ route('home') }}">
            {{ __('VOLVER AL INICIO') }}
        </a>
    </div>
</x-guest-layout>