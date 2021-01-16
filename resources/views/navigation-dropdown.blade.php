@php
    $navLinks = [
        ['href' => '/partidos', 'name' => 'matches', 'text' => 'Partidos', 'class' => '', 'class_hamburger' => ''],
        ['href' => '/clasificaciones', 'name' => 'standings', 'text' => 'Clasificaciones', 'class' => '', 'class_hamburger' => ''],
        ['href' => '/estadisticas', 'name' => 'stats', 'text' => 'Estadísticas', 'class' => '', 'class_hamburger' => ''],
        ['href' => '/jugadores', 'name' => 'players', 'text' => 'Jugadores', 'class' => 'hidden md:inline-flex', 'class_hamburger' => ''],
        ['href' => '/equipos', 'name' => 'teams', 'text' => 'Equipos', 'class' => 'hidden lg:inline-flex', 'class_hamburger' => ''],
        ['href' => '/managers', 'name' => 'teams', 'text' => 'Managers', 'class' => 'hidden lg:inline-flex', 'class_hamburger' => ''],
    ]
@endphp

<nav x-data="{ open: false }" class="bg-header-bg dark:bg-gray-900 border-b border-header-bg-dark dark:border-gray-950 select-none z-50 fixed w-full">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Hamburger -->
                <div class="flex items-center lg:hidden">
                    <i class="bx bx-menu text-3xl -mx-1 text-gray-300 hover:text-white focus:text-white cursor-pointer" :class="{ 'bx-x': open }" @click.prevent="open = ! open"></i>
                </div>
                <!-- Logo -->
                <div class="flex-1 ml-5 lg:ml-0 text-white flex items-center w-full">
                    <a href="{{ route('home') }}" class="group flex items-center h-full focus:outline-none">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="h-12 rounded-full block w-auto focus:outline-none border border-transparent group-hover:border-dark-link group-focus:border-dark-link transition duration-150 ease-in-out" />
                        <div class="text-xl ml-3 leading-5  w-full">
                            <p class="font-bold">ANBA</p>
                            <div class="block text-xxs uppercase w-24">Adictos a la NBA</div>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                    @foreach ($navLinks as $link)
                        <x-nav-link :href="$link['href']" :active="request()->routeIs($link['name'])" :class="$link['class']">
                            {{ __($link['text']) }}
                        </x-nav-link>
                    @endforeach
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @auth
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm rounded-full focus:outline-none border border-transparent hover:border-dark-link focus:border-dark-link transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            @endif
                        @endauth
                        @guest
                            <button class="flex text-sm rounded-full focus:outline-none border border-transparent hover:border-dark-link focus:border-dark-link transition duration-150 ease-in-out">
                                <img class="h-8 w-8 bg-gray-100 p-0.5 rounded-full object-cover" src="{{ asset('img/guest.png') }}" alt="Invitado"/>
                            </button>
                        @endguest
                    </x-slot>

                    <x-slot name="content">
                        @auth
                            <!-- Account Management -->
{{--                             <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div> --}}

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100 dark:border-gray-350"></div>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('Create New Team') }}
                                    </x-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100 dark:border-gray-350"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-switchable-team :team="$team" />
                                @endforeach

                                <div class="border-t border-gray-100 dark:border-gray-350"></div>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        @endauth
                        @guest
{{--                             <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div> --}}
                            <x-dropdown-link href="{{ route('login') }}">
                                {{ __('Iniciar sesión') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('register') }}">
                                {{ __('Crear cuenta') }}
                            </x-dropdown-link>
                        @endguest
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="lg:hidden absolute w-full z-40" id="responsiveNavMenu" x-show="open"
        x-transition:enter="transition ease-out origin-top-left duration-200"
        x-transition:enter-start="opacity-0 transform scale-x-0 scale-y-0"
        x-transition:enter-end="opacity-100 transform scale-x-100 scale-y-100"
        x-transition:leave="transition origin-top-left ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-x-100 scale-y-100"
        x-transition:leave-end="opacity-0 transform scale-x-0 scale-y-0">
        <ul class="bg-header-bg-light dark:bg-gray-850 shadow-lg w-full" @click.away="open = false">
            @foreach ($navLinks as $link)
                <x-responsive-nav-link :href="$link['href']" :active="request()->routeIs($link['name'])" :class="$link['class_hamburger']">
                    {{ __($link['text']) }}
                </x-responsive-nav-link>
            @endforeach
        </ul>
    </div>

</nav>
