@php
    $navLinks = [
        ['href' => '/partidos', 'name' => 'matches', 'text' => 'Partidos', 'class' => '', 'icon' => 'icon-ball'],
        ['href' => '/clasificaciones', 'name' => 'standings', 'text' => 'Clasificaciones', 'class' => '', 'icon' => 'icon-league-table'],
        ['href' => '/estadisticas', 'name' => 'stats', 'text' => 'Estadísticas', 'class' => '', 'icon' => 'icon-stats'],
        ['href' => '/jugadores', 'name' => 'players', 'text' => 'Jugadores', 'class' => 'hidden md:inline-flex', 'icon' => 'icon-player'],
        ['href' => '/equipos', 'name' => 'teams', 'text' => 'Equipos', 'class' => 'hidden lg:inline-flex', 'icon' => 'icon-shirt'],
        ['href' => '/managers', 'name' => 'managers', 'text' => 'Managers', 'class' => 'hidden lg:inline-flex', 'icon' => 'icon-coach'],
    ]
@endphp

<nav x-data="{ open: false }" class="bg-header-bg dark:bg-gray-925 border-b border-header-bg-dark dark:border-gray-950 select-none z-50 fixed w-full">
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
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="h-12 block w-auto focus:outline-none border border-transparent transform group-hover:scale-110 group-focus:scale-110 transition duration-150 ease-in-out" />
                        <div class="ml-2.5 w-full flex flex-col justify-center">
                            <div class="flex items-center space-x-2.5">
                                <p class="text-xl font-bold">ANBA</p>
                                <p class="text-xs font-semibold text-yellow-400">{{ $currentSeason->name }}</p>
                            </div>
                            <div class="text-xxs uppercase -mt-1">Adictos a la NBA</div>
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
                    <a href="http://anba2k.es/phpBB3/index.php" target="_blank" class="uppercase inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-300 hover:text-white focus:text-white focus:outline-none transition duration-150 ease-in-out transform hover:translate-y-0.5 hidden lg:inline-flex">
                        Foro
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center ml-6">
{{--                 <button type="button" class="h-8 w-8 text-xl mr-2 focus:outline-none text-gray-300 hover:text-white focus:text-white transition duration-150 ease-in-out" onclick="toggleDarkMode()">
                    <i class="fas fa-moon"></i>
                </button>
                <script>
                    const html = document.getElementsByTagName('html')[0];

                    function toggleDarkMode() {
                        if(html.classList.contains('scheme-dark')) {
                            html.classList.remove('scheme-dark');
                        } else {
                            html.classList.add('scheme-dark');
                        }
                    }
                </script> --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <div class="flex items-center">
                            @auth
                                <div class="relative">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="group flex text-sm rounded-full focus:outline-none border border-transparent">
                                            <img class="h-10 w-10 border border-gray-500 dark:border-gray-700 rounded-full object-cover transform group-hover:scale-110 group-focus:scale-110 transition duration-150 ease-in-out" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
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
                                    @hasrole('manager')
                                        @if (Auth::user()->pendingMatchesReports() > 0)
                                            <span class="flex h-2.5 w-2.5 absolute bottom-0 left-0 my-0.5">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-200 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-yellow-300"></span>
                                            </span>
                                        @endif
                                    @endhasrole
                                </div>
                            @endauth
                            @guest
                                <button class="group flex text-sm rounded-full focus:outline-none border border-transparent">
                                    <img class="h-10 w-10 bg-gray-100 p-0.5 rounded-full object-cover transform group-hover:scale-110 group-focus:scale-110 transition duration-200 ease-in-out" src="{{ asset('img/guest.png') }}" alt="Invitado"/>
                                </button>
                            @endguest
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        @auth
                            @hasrole('manager')
                                <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-300">
                                    {{ __('Manager') }}
                                </div>
                                <x-dropdown-link href="#" class="flex items-center">
                                    <i class="fas fa-shield-alt text-base w-6 mr-1.5 text-center"></i><span>{{ __('Mi equipo') }}</span>
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('manager.pending_matches') }}" class="flex items-center">
                                    <i class="icon-gamepad text-base w-6 mr-1.5 text-center"></i><span>{{ __('Partidos pendientes') }}</span>
                                </x-dropdown-link>
                                @if (Auth::user()->pendingMatchesReports() > 0)
                                    <x-dropdown-link href="{{ route('manager.pending_reports') }}" class="flex items-center animate-pulse">
                                        <i class="fas fa-clipboard-list w-6 mr-1.5 text-center"></i>
                                        <span>{{ Auth::user()->pendingMatchesReports() }}{{ Auth::user()->pendingMatchesReports() == 1 ? ' reporte pendiente' : ' reportes pendientes' }}</span>
                                    </x-dropdown-link>
                                @endif
                            @endhasrole

                            @hasanyrole('super-admin|admin')
                                <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-300">
                                    {{ __('Administración') }}
                                </div>
                                <x-dropdown-link href="{{ route('admin') }}" class="flex items-center">
                                    <i class="icon-admin text-base w-6 mr-1.5 text-center"></i><span>{{ __('AdminANBA') }}</span>
                                </x-dropdown-link>
                                @if (isset($currentSeason))
                                    <x-dropdown-link href="{{ route('admin.matches', $currentSeason->slug) }}" class="flex items-center">
                                        <i class="icon-cog text-sm w-6 mr-1.5 text-right"></i><span>{{ __('Partidos') }}</span>
                                    </x-dropdown-link>
                                @endif
                                <x-dropdown-link href="{{ route('admin.teams') }}" class="flex items-center">
                                    <i class="icon-cog text-sm w-6 mr-1.5 text-right"></i><span>{{ __('Equipos') }}</span>
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('admin.players') }}" class="flex items-center">
                                    <i class="icon-cog text-sm w-6 mr-1.5 text-right"></i><span>{{ __('Jugadores') }}</span>
                                </x-dropdown-link>
                            @endhasanyrole

                            <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-300">
                                {{ __('Mi cuenta') }}
                            </div>
                            <x-dropdown-link href="{{ route('profile.show') }}" class="flex items-center">
                                <i class="fas fa-id-card-alt text-base w-6 mr-1.5 text-center"></i><span>{{ __('Perfil') }}</span>
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" class="flex items-center"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-door-open text-base w-6 mr-1.5 text-center"></i><span>{{ __('Cerrar sesión') }}</span>
                                </x-dropdown-link>
                            </form>


                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif
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

                                <div class="border-t border-gray-150 dark:border-gray-700"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-switchable-team :team="$team" />
                                @endforeach

                                <div class="border-t border-gray-150 dark:border-gray-700"></div>
                            @endif

                        @endauth
                        @guest
{{--                             <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-300">
                                {{ __('Manage Account') }}
                            </div> --}}
                            <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-300">
                                {{ __('Bienvenido, invitado') }}
                            </div>
                            <x-dropdown-link href="{{ route('login') }}" class="flex items-center">
                                <i class="fas fa-fingerprint text-base w-6 mr-1.5 text-center"></i><span>{{ __('Iniciar sesión') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('register') }}" class="flex items-center">
                                <i class="fas fa-user-plus text-base w-6 mr-1.5 text-center"></i><span>{{ __('Crear cuenta') }}</span>
                            </x-dropdown-link>
                        @endguest
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="lg:hidden absolute w-full z-40" id="responsiveNavMenu" x-show="open"
        x-transition:enter="transition ease-out origin-top-left duration-150"
        x-transition:enter-start="opacity-0 transform scale-x-0"
        x-transition:enter-end="opacity-100 transform scale-x-100"
        x-transition:leave="transition origin-top-left ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-x-100"
        x-transition:leave-end="opacity-0 transform scale-x-0">
        <ul class="bg-header-bg-light dark:bg-gray-900 shadow-lg w-full" @click.away="open = false">
            @foreach ($navLinks as $link)
                <x-responsive-nav-link :href="$link['href']" :active="request()->routeIs($link['name'])">
                    <x-slot name="icon">
                        {{ $link['icon'] }}
                    </x-slot>
                    {{ __($link['text']) }}
                </x-responsive-nav-link>
            @endforeach
            <li class="text-sm uppercase border-b border-header-bg-dark dark:border-gray-800">
                <a href="http://anba2k.es/phpBB3/index.php" target="_blank" class="group flex items-center justify-between px-6 py-3 text-sm uppercase text-gray-300 leading-4 focus:outline-none transition duration-150 ease-in-out hover:text-white focus:text-white transform hover:-translate-x-1 focus:-translate-x-1 hover:bg-header-bg-lighter focus:bg-header-bg-lighter active:bg-header-bg-lighter dark:hover:bg-gray-800 dark:focus:bg-gray-800 dark:active:bg-gray-800">
                    <span><i class="icon-forum mr-4 text-xl"></i></span>
                    <span class="flex-1">Foro</span>
                    <i class="fas fa-chevron-right text-gray-400 dark:text-gray-500 group-hover:text-white group-focus:text-white"></i>
                </a>
            </li>
        </ul>
    </div>

</nav>
