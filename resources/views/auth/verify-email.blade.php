<x-guest-layout title="Verificación de cuenta">

    <div class="py-6 md:py-16 bg-gray-100 dark:bg-gray-850 flex flex-col items-center mx-4 lg:mx-0">
        <x-jet-authentication-card-logo />

        <div class="w-full sm:max-w-lg mt-6 px-6 py-6 bg-white dark:bg-gray-750 shadow-md overflow-hidden rounded-lg">

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4">
                    <div class="text-sm border bg-green-100 border-green-300 text-green-500 dark:bg-green-500 dark:border-green-400 dark:text-white p-3 text-center rounded">
                        {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.') }}
                    </div>
                </div>
            @endif

            <p class="text-xl uppercase tracking-widest border-b border-gray-200 dark:border-gray-650 pb-3 mb-5">
                verifica tu cuenta
            </p>

            <div class="mx-0">
                <p class="my-4 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Gracias por registrarte! Antes de comenzar, ¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar? Si no recibió el correo electrónico, con gusto le enviaremos otro.') }}
                </p>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div class="mt-6">
                        <button type="submit" class="w-full text-center px-4 py-2 bg-gray-800 dark:bg-dark-link rounded-md font-semibold text-xs text-white dark:text-gray-700 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-blue-300 active:bg-gray-600 dark:active:bg-blue-200 focus:outline-none focus:bg-gray-600 dark:focus:bg-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Reenviar correo electrónico de verificación') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="my-4 underline text-sm text-gray-600 dark:text-gray-100 hover:text-gray-900 dark:hover:text-gray-300 focus:text-gray-900 dark:focus:text-gray-300 focus:outline-none">
                {{ __('Cerrar sesión') }}
            </button>
        </form>
    </div>
</x-guest-layout>