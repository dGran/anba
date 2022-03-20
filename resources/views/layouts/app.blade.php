<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Title --}}
        <title>
            @isset($title) {{ $title }} | @endisset
            {{ config('app.name', 'Laravel') }}
        </title>

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#00236a">
        <meta name="apple-mobile-web-app-title" content="ANBA">
        <meta name="application-name" content="ANBA">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">


        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        {{-- box-icons --}}
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        {{-- animate.css --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        {{-- Toastr --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
        {{-- alpinejs --}}
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/iconmoon.css') }}"/>

        @livewireStyles

        <!-- Scripts -->
        {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script> --}}
        {{-- JQuery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        {{-- Mouse Trap --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.3/mousetrap.min.js"></script>
        {{-- Toastr --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
        {{-- Tail Select ???usage??? --}}
        <script src="https://cdn.jsdelivr.net/npm/tail.select@latest/"></script>

        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="dark:text-white | font-sans antialiased bg-gray-100 dark:bg-gray-850 | scrollbar-thin thinest scrollbar-track-transparent scrollbar-thumb-gray-400 hover:scrollbar-thumb-gray-300 | dark:scrollbar-thumb-gray-500 dark:hover:scrollbar-thumb-gray-600">
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

        @include('layouts.partials.session_messages')

        @stack('modals')

        @livewireScripts

        @yield('js')
    </body>
</html>
