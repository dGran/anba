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
            @livewire('top-header')

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

            @include('layouts.partials.footer')

            @include('cookieConsent::index')
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
