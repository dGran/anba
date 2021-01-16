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
                <header class="bg-white dark:bg-gray-750 shadow-md mt-16 z-40 fixed w-full h-12 md:h-16 flex items-center">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex-1">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="mb-auto {{ $blockHeader ? 'mt-28 md:mt-32' : 'mt-16' }}">
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <footer class="bg-header-bg dark:bg-gray-900 leading-normal dark:border-t border-gray-200 dark:border-gray-700" {{-- style="background-color: #2d3e50" --}}>

                <div class="w-full bg-header-bg-light dark:bg-gray-800 mx-auto">
                    <ul class="w-full leading-6 py-3 px-4 list-none flex items-center justify-center flex-wrap md:flex-row font-bold uppercase text-sm tracking-wider text-gray-350">
                        <li class="px-2 md:px-3 lg:px-4"><a href="{{ route('home') }}" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Inicio</a></li>
                        <li class="px-2 md:px-3 lg:px-4"><a href="{{ route('matches') }}" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Partidos</a></li>
                        <li class="px-2 md:px-3 lg:px-4"><a href="{{ route('standings') }}" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Clasificaciones</a></li>
                        <li class="px-2 md:px-3 lg:px-4"><a href="#" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Estadisticas</a></li>
                        <li class="px-2 md:px-3 lg:px-4"><a href="{{ route('players') }}" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Jugadores</a></li>
                        <li class="px-2 md:px-3 lg:px-4"><a href="#" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Equipos</a></li>
                        <li class="px-2 md:px-3 lg:px-4"><a href="#" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Managers</a></li>
                    </ul>
                    <p class="py-3 font-miriam uppercase text-xs tracking-widest text-gray-350 text-center border-t border-header-bg-dark dark:border-gray-700">
                        designed by
                        <a href="mailto:dgranh@gmail.com" class="block font-bad-script capitalize font-bold text-sm hover:text-pretty-red focus:text-pretty-red focus:outline-none mt-1">David Gran</a>
                    </p>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="py-3 font-miriam uppercase text-xs tracking-widest text-gray-350">
                        <span>&copy; {{ date('Y') == 2020 ? '' : '2020-' }}</span><span>{{ date('Y') }} Derechos reservados. {{ config('app.name') }}.</span>
                    </p>
                </div>

                {{-- {{ $footer }} --}}
            </footer>

            @include('cookieConsent::index')
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
