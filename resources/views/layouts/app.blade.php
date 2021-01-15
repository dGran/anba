<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        {{-- box-icons --}}
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        {{-- animate.css --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
        {{-- JQuery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        {{-- Mouse Trap --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.3/mousetrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tail.select@latest/"></script>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-850">

        <div class="flex flex-col h-screen justify-between">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            @if ($blockHeader)
                <header class="bg-gray-50 dark:bg-gray-800 shadow dark:shadow-none mt-16">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="mb-auto {{ $blockHeader ?: 'mt-16' }}">
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <footer class="bg-header-bg dark:bg-gray-800 leading-normal dark:border-t border-gray-200 dark:border-gray-700" {{-- style="background-color: #2d3e50" --}}>

                <ul class="w-full py-6 bg-header-bg-light list-none flex justify-center flex-col md:flex-row md:gap-4 md:gap-8 font-miriam font-bold uppercase text-sm tracking-wider" style="color: #aeaeae">
                    <li><a href="{{ route('home') }}" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Inicio</a></li>
                    <li class="pt-2 md:pt-0"><a href="{{ route('matches') }}" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Partidos</a></li>
                    <li class="pt-2 md:pt-0"><a href="{{ route('standings') }}" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Clasificaciones</a></li>
                    <li class="pt-2 md:pt-0"><a href="#" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Estadisticas</a></li>
                    <li class="pt-2 md:pt-0"><a href="{{ route('players') }}" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Jugadores</a></li>
                    <li class="pt-2 md:pt-0"><a href="#" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Equipos</a></li>
                    <li class="pt-2 md:pt-0"><a href="#" class="outline-none hover:text-blue-500 focus:text-blue-500 dark:hover:text-dark-link dark:focus:text-dark-link">Managers</a></li>
                </ul>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="py-4" style="color: #aeaeae; font-family: Miriam Libre,Source Sans Pro,sans-serif; text-transform: uppercase; letter-spacing: 2px; font-size: 12px;">
                        &copy; {{ date('Y') }} Derechos reservados. {{ config('app.name') }}.
                    </p>
{{--                     <p class="mt-2" style="color: #aeaeae; padding-bottom: 10px; font-family: Miriam Libre,Source Sans Pro,sans-serif; text-transform: uppercase; letter-spacing: 2px; font-size: 10px;">
                        designed by
                        <a href="mailto:dgranh@gmail.com" class="block font-bad-script capitalize font-bold text-sm hover:text-pretty-red focus:text-pretty-red focus:outline-none mt-1">David Gran</a>
                    </p> --}}
                </div>

                {{-- {{ $footer }} --}}
            </footer>

            @include('cookieConsent::index')
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
