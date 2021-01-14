<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
        <body class="font-sans antialiased bg-gray-100 dark:bg-gray-850">
            <div class="flex flex-col h-screen justify-between">
                <!-- Page Content -->
                <main class="mb-auto text-gray-700 dark:text-white">
                    {{ $slot }}
                </main>

                <!-- Page Footer -->
                <footer class="bg-gray-50 dark:bg-gray-800 leading-normal border-t border-gray-200 dark:border-gray-700" {{-- style="background-color: #2d3e50" --}}>

                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
                        <ul class="list-none flex justify-center flex-col md:flex-row md:gap-4 md:gap-8 font-miriam font-bold uppercase text-sm tracking-wider my-2" style="color: #aeaeae">
                            <li><a href="{{ route('home') }}" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Inicio</a></li>
                            <li class="pt-2 md:pt-0"><a href="{{ route('matches') }}" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Partidos</a></li>
                            <li class="pt-2 md:pt-0"><a href="{{ route('standings') }}" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Clasificaciones</a></li>
                            <li class="pt-2 md:pt-0"><a href="#" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Estadisticas</a></li>
                            <li class="pt-2 md:pt-0"><a href="{{ route('players') }}" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Jugadores</a></li>
                            <li class="pt-2 md:pt-0"><a href="#" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Equipos</a></li>
                            <li class="pt-2 md:pt-0"><a href="#" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Managers</a></li>
                        </ul>
                        <p class="mt-6" style="color: #aeaeae; padding-bottom: 10px; font-family: Miriam Libre,Source Sans Pro,sans-serif; text-transform: uppercase; letter-spacing: 2px; font-size: 12px;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
                        </p>
                        <p class="mt-2" style="color: #aeaeae; padding-bottom: 10px; font-family: Miriam Libre,Source Sans Pro,sans-serif; text-transform: uppercase; letter-spacing: 2px; font-size: 10px;">
                            designed by
                            <a href="mailto:dgranh@gmail.com" class="block font-bad-script capitalize font-bold text-sm hover:text-pretty-red focus:text-pretty-red focus:outline-none mt-1">David Gran</a>
                        </p>
                    </div>

                    {{-- {{ $footer }} --}}
                </footer>
            </div>
    </body>
</html>
