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

<nav x-data="{ open: false }" class="bg-gray-900 select-none z-50 fixed w-full">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Hamburger -->
                <div class="flex items-center lg:hidden">
                    <div id="nav-icon3" @click="open = ! open" class="group">
                        <span class="bg-gray-300 group-hover:bg-white focus-hover:bg-white"></span>
                        <span class="bg-gray-300 group-hover:bg-white focus-hover:bg-white"></span>
                        <span class="bg-gray-300 group-hover:bg-white focus-hover:bg-white"></span>
                        <span class="bg-gray-300 group-hover:bg-white focus-hover:bg-white"></span>
                    </div>
{{--                     <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md text-gray-300 hover:text-white focus:text-white focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button> --}}
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
                <x-jet-dropdown align="right" width="48">
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
                            <button class="flex text-sm rounded-full focus:outline-none border border-transparent hover:border-dark-link dark:hover:border-pink-500 focus:border-dark-link dark:focus:border-pink-500 transition duration-150 ease-in-out">
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

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('Create New Team') }}
                                    </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team" />
                                @endforeach

                                <div class="border-t border-gray-100"></div>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-jet-dropdown-link>
                            </form>
                        @endauth
                        @guest
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>
                            <x-jet-dropdown-link href="{{ route('login') }}">
                                {{ __('Iniciar sesión') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('register') }}">
                                {{ __('Crear cuenta') }}
                            </x-jet-dropdown-link>
                        @endguest
                    </x-slot>
                </x-jet-dropdown>
            </div>

        </div>
    </div>

<style>
/* Icon 3 */

#nav-icon3 span:nth-child(1) {
  top: 0px;
}

#nav-icon3 span:nth-child(2),#nav-icon3 span:nth-child(3) {
  top: 6px;
}

#nav-icon3 span:nth-child(4) {
  top: 12px;
}

#nav-icon3.open span:nth-child(1) {
  top: 6px;
  width: 0%;
  left: 50%;
}

#nav-icon3.open span:nth-child(2) {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}

#nav-icon3.open span:nth-child(3) {
  -webkit-transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg);
}

#nav-icon3.open span:nth-child(4) {
  top: 6px;
  width: 0%;
  left: 50%;
}


#nav-icon3 {
  width: 18px;
  height: 14px;
  position: relative;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .5s ease-in-out;
  -moz-transition: .5s ease-in-out;
  -o-transition: .5s ease-in-out;
  transition: .5s ease-in-out;
  cursor: pointer;
}

#nav-icon3 span {
  display: block;
  position: absolute;
  height: 2px;
  width: 100%;
  border-radius: 9px;
  opacity: 1;
  left: 0;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .15s ease-in-out;
  -moz-transition: .15s ease-in-out;
  -o-transition: .15s ease-in-out;
  transition: .15s ease-in-out;
}
</style>

<script>
$(document).ready(function(){
    $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
        $(this).toggleClass('open');
    });
});
</script>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden absolute w-full z-40 transition-all duration-500 ease-in-out">
        <ul class="bg-gray-850 shadow-lg w-full">
            @foreach ($navLinks as $link)
                <x-responsive-nav-link :href="$link['href']" :active="request()->routeIs($link['name'])" :class="$link['class_hamburger']">
                    {{ __($link['text']) }}
                </x-responsive-nav-link>
            @endforeach
        </ul>
    </div>
</nav>
