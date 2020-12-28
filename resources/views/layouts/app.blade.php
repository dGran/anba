<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-850">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-gray-100 dark:bg-gray-850 shadow dark:shadow-none">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <footer class="text-sm">
                <div class="bg-white dark:bg-gray-750 mt-8 shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <div>
                                col 1
                            </div>
                            <div>
                                col 2
                            </div>
                            <div>
                                col 3
                            </div>
                        </div>
                    </div>
                </div>
{{--                 <div class="bg-white dark:bg-gray-900 shadow-lg border-t border-black">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-center opacity-25">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="h-12 block w-auto ml-auto mr-auto">
                        <p class="flex flex-col leading-5 mt-2">
                            <span class="text-xl font-bold">ANBA</span>
                            <span class="text-xxs uppercase font-medium">Adictos a la NBA</span>
                        </p>
                    </div>
                </div> --}}
                <div class="bg-gray-900 dark:bg-gray-950 text-white">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
                        &copy; 2020 anba2k.es. Todos los derechos reservados
                    </div>
                </div>
                {{-- {{ $footer }} --}}
            </footer>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
