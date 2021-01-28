<footer class="bg-header-bg dark:bg-gray-925 leading-normal" {{-- style="background-color: #2d3e50" --}}>

    {{-- block 1 --}}
    <div class="w-full border-b border-header-bg-dark dark:border-gray-750">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-3.5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center leading-6">
                        <i class="{{ $usersOnline == 1 ? 'fas fa-user' : 'fas fa-users' }} w-6 text-sm text-gray-350 text-center"></i>
                        <span class="ml-2 text-base font-bold {{ $usersOnline > 0 ? 'text-green-400' : 'text-gray-350' }}">{{ $usersOnline }}</span>
                        <span class="ml-2 text-xs text-gray-350 uppercase">{{ $usersOnline == 1 ? 'usuario' : 'usuarios' }}</span><span class="hidden xs:inline-block text-xs text-gray-350 uppercase ml-0.5">en línea</span>
                    </div>
                    <div class="flex items-center leading-6">
                        <i class="{{ $visitorsOnline == 1 ? 'fas fa-user-slash' : 'fas fa-users-slash' }} w-6 text-sm text-gray-350 text-center"></i>
                        <span class="ml-2 text-base font-bold {{ $visitorsOnline > 0 ? 'text-yellow-300' : 'text-gray-350' }}">{{ $visitorsOnline }}</span>
                        <span class="ml-2 text-xs text-gray-350 uppercase">{{ $visitorsOnline == 1 ? 'invitado' : 'invitados' }}</span><span class="hidden xs:inline-block text-xs text-gray-350 uppercase ml-0.5">en línea</span>
                    </div>
                </div>
                <a href="https://discord.gg/AcuUbDR" target="_blank" class="flex flex-col focus:outline-none opacity-75 hover:opacity-100 focus:opacity-100">
                    <img src="{{ asset('img/discord.png') }}" alt="" class="w-28">
                </a>
            </div>
        </div>
    </div>

    {{-- block 2 --}}
    <div class="w-full bg-header-bg-light dark:bg-gray-850 border-b border-header-bg-dark dark:border-gray-750">
        <ul class="md:hidden max-w-7xl mx-auto select-none" x-data="{selected:null}">
            <li class="flex align-center flex-col">
                <h4 @click="selected !== 2 ? selected = 2 : selected = null"
                    class="cursor-pointer px-4 md:px-6 lg:px-8 py-3 border-b border-header-bg-dark dark:border-gray-750 text-gray-200 font-bold uppercase text-left inline-block flex justify-between tracking-wide">
                    <span>menu</span>
                    <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 2, 'fas fa-angle-up' : selected == 2 }" class="text-xl"></i></span>
                </h4>
                <div x-show="selected == 2" class="border-b border-header-bg-dark px-8 md:px-10 lg:px-12 py-1.5"
                    x-transition:enter="transition ease-out duration-300 origin-top"
                    x-transition:enter-start="opacity-0 transform scale-y-0"
                    x-transition:enter-end="opacity-100 transform scale-y-100"
                    x-transition:leave="transition ease-in duration-150 origin-top"
                    x-transition:leave-start="opacity-100 transform scale-y-100"
                    x-transition:leave-end="opacity-0 transform scale-y-0">
                    <ul class="flex flex-col leading-6 list-none text-sm tracking-wide text-gray-350">
                        <li class="py-1"><a href="{{ route('home') }}" class="block outline-none hover:text-white focus:text-white">Inicio</a></li>
                        <li class="py-1"><a href="{{ route('matches') }}" class="block outline-none hover:text-white focus:text-white">Partidos</a></li>
                        <li class="py-1"><a href="{{ route('standings') }}" class="block outline-none hover:text-white focus:text-white">Clasificaciones</a></li>
                        <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Estadisticas</a></li>
                        <li class="py-1"><a href="{{ route('players') }}" class="block outline-none hover:text-white focus:text-white">Jugadores</a></li>
                        <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Equipos</a></li>
                        <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Managers</a></li>
                        <li class="py-1"><a href="http://anba2k.es/phpBB3/index.php" target="_blank" class="block outline-none hover:text-white focus:text-white">Foro</a></li>
                    </ul>
                </div>
            </li>
            @hasrole('manager')
            <li class="flex align-center flex-col">
                <h4 @click="selected !== 4 ? selected = 4 : selected = null"
                    class="cursor-pointer px-4 md:px-6 lg:px-8 py-3 border-b border-header-bg-dark dark:border-gray-750 text-gray-200 font-bold uppercase text-left inline-block flex justify-between tracking-wide">
                    <span>manager</span>
                    <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 4, 'fas fa-angle-up' : selected == 4 }" class="text-xl"></i></span>
                </h4>
                <div x-show="selected == 4" class="border-b border-header-bg-dark px-8 md:px-10 lg:px-12 py-1.5"
                    x-transition:enter="transition ease-out duration-300 origin-top"
                    x-transition:enter-start="opacity-0 transform scale-y-0"
                    x-transition:enter-end="opacity-100 transform scale-y-100"
                    x-transition:leave="transition ease-in duration-150 origin-top"
                    x-transition:leave-start="opacity-100 transform scale-y-100"
                    x-transition:leave-end="opacity-0 transform scale-y-0">
                    <ul class="flex flex-col leading-6 list-none text-sm tracking-wide text-gray-350">
                        <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Mi equipo</a></li>
                        <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Partidas pendientes</a></li>
                    </ul>
                </div>
            </li>
            @endhasrole
            <li class="flex align-center flex-col">
                <h4 @click="selected !== 1 ? selected = 1 : selected = null"
                    class="cursor-pointer px-4 md:px-6 lg:px-8 py-3 border-b border-header-bg-dark dark:border-gray-750 text-gray-200 font-bold uppercase text-left inline-block flex justify-between tracking-wide">
                    <span>ANBA</span>
                    <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 1, 'fas fa-angle-up' : selected == 1 }" class="text-xl"></i></span>
                </h4>
                <div x-show="selected == 1" class="border-b border-header-bg-dark px-8 md:px-10 lg:px-12 py-1.5"
                    x-transition:enter="transition ease-out duration-300 origin-top"
                    x-transition:enter-start="opacity-0 transform scale-y-0"
                    x-transition:enter-end="opacity-100 transform scale-y-100"
                    x-transition:leave="transition ease-in duration-150 origin-top"
                    x-transition:leave-start="opacity-100 transform scale-y-100"
                    x-transition:leave-end="opacity-0 transform scale-y-0">
                    <ul class="flex flex-col leading-6 list-none text-sm tracking-wide text-gray-350">
                        <li class="py-1"><a href="http://anba2k.es/phpBB3/viewforum.php?f=13&sid=c259efecf44ecda45c0f3e66871aa7ef" target="_blank" class="block outline-none hover:text-white focus:text-white">Reglamento</a></li>
                        <li class="py-1"><a href="mailto:darth0@gmail.com" class="block outline-none hover:text-white focus:text-white">Contacto</a></li>
                    </ul>
                </div>
            </li>
            <li class="flex align-center flex-col">
                <h4 @click="selected !== 3 ? selected = 3 : selected = null"
                    class="cursor-pointer px-4 md:px-6 lg:px-8 py-3 border-b border-header-bg-dark dark:border-gray-750 text-gray-200 font-bold uppercase text-left inline-block flex justify-between tracking-wide">
                    <span>legal</span>
                    <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 3, 'fas fa-angle-up' : selected == 3 }" class="text-xl"></i></span>
                </h4>
                <div x-show="selected == 3" class="border-b border-header-bg-dark px-8 md:px-10 lg:px-12 py-1.5"
                    x-transition:enter="transition ease-out duration-300 origin-top"
                    x-transition:enter-start="opacity-0 transform scale-y-0"
                    x-transition:enter-end="opacity-100 transform scale-y-100"
                    x-transition:leave="transition ease-in duration-150 origin-top"
                    x-transition:leave-start="opacity-100 transform scale-y-100"
                    x-transition:leave-end="opacity-0 transform scale-y-0">
                    <ul class="flex flex-col leading-6 list-none text-sm tracking-wide text-gray-350">
                        <li class="py-1"><a href="{{ route('cookies') }}" class="block outline-none hover:text-white focus:text-white">Política de cookies</a></li>
                        <li class="py-1"><a href="{{ route('privacity') }}" class="block outline-none hover:text-white focus:text-white">Política de privacidad</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        {{-- md or highter view --}}
        <div class="hidden md:flex items-start max-w-7xl mx-auto select-none pt-5">
            <div class="px-4 md:px-6 lg:px-8">
                <h4 class="text-gray-200 font-bold uppercase">menu</h4>
                <ul class="flex flex-col leading-6 list-none text-sm tracking-wide text-gray-350 mt-1.5">
                    <li class="py-1"><a href="{{ route('home') }}" class="block outline-none hover:text-white focus:text-white">Inicio</a></li>
                    <li class="py-1"><a href="{{ route('matches') }}" class="block outline-none hover:text-white focus:text-white">Partidos</a></li>
                    <li class="py-1"><a href="{{ route('standings') }}" class="block outline-none hover:text-white focus:text-white">Clasificaciones</a></li>
                    <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Estadisticas</a></li>
                    <li class="py-1"><a href="{{ route('players') }}" class="block outline-none hover:text-white focus:text-white">Jugadores</a></li>
                    <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Equipos</a></li>
                    <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Managers</a></li>
                    <li class="py-1"><a href="http://anba2k.es/phpBB3/index.php" target="_blank" class="block outline-none hover:text-white focus:text-white">Foro</a></li>
                </ul>
            </div>

            @hasrole('manager')
            <div class="px-4 md:px-6 lg:px-8 ml-8 lg:ml-12 xl:ml-16">
                <h4 class="text-gray-200 font-bold uppercase">manager</h4>
                <ul class="flex flex-col leading-6 list-none text-sm tracking-wide text-gray-350 mt-1.5">
                    <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Mi equipo</a></li>
                    <li class="py-1"><a href="#" class="block outline-none hover:text-white focus:text-white">Partidas pendientes</a></li>
                </ul>
            </div>
            @endhasrole

            <div class="px-4 md:px-6 lg:px-8 ml-8 lg:ml-12 xl:ml-16">
                <h4 class="text-gray-200 font-bold uppercase">anba</h4>
                <ul class="flex flex-col leading-6 list-none text-sm tracking-wide text-gray-350 mt-1.5">
                    <li class="py-1"><a href="http://anba2k.es/phpBB3/viewforum.php?f=13&sid=c259efecf44ecda45c0f3e66871aa7ef" target="_blank" class="block outline-none hover:text-white focus:text-white">Reglamento</a></li>
                    <li class="py-1"><a href="mailto:darth0@gmail.com" class="block outline-none hover:text-white focus:text-white">Contacto</a></li>
                </ul>
            </div>

            <div class="px-4 md:px-6 lg:px-8 ml-8 lg:ml-12 xl:ml-16">
                <h4 class="text-gray-200 font-bold uppercase">legal</h4>
                <ul class="flex flex-col leading-6 list-none text-sm tracking-wide text-gray-350 mt-1.5">
                    <li class="py-1"><a href="{{ route('cookies') }}" class="block outline-none hover:text-white focus:text-white">Política de cookies</a></li>
                    <li class="py-1"><a href="{{ route('privacity') }}" class="block outline-none hover:text-white focus:text-white">Política de privacidad</a></li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-5 flex flex-col md:flex-row">
            <p class="text-gray-350 text-sm">
                <span class="text-gray-200 font-bold text-base block pb-1.5">Adictos a la NBA</span>
                Adictos a la NBA es una liga de simulación total y realista para <strong>NBA 2k de Xbox.</strong> Mediante esta webapp gestionamos los resultados y estadísticas de los partidos virtuales, además de la gestión manager.
            </p>
            <div class="mt-3.5 md:mt-0 py-1.5 md:ml-8 lg:ml-16 xl:ml-32 opacity-75 flex items-center justify-center">
                <i class="icon-2k inline-block text-gray-350 text-4xl mr-3"></i>
                <i class="icon-xbox inline-block text-gray-350 text-4xl"></i>
            </div>
        </div>
    </div>

    {{-- block 3 --}}
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center">

        <div class="mb-3 mt-2 text-gray-350 text-center">
            <span class="font-miriam uppercase text-xs tracking-widest">webapp desarrollada por</span>
            <a href="mailto:dgranh@gmail.com" class="block font-bad-script capitalize font-bold text-sm hover:text-pretty-red focus:text-pretty-red focus:outline-none mt-1">David Gran</a>
        </div>
        <p class="pb-3 font-miriam uppercase text-xs tracking-widest text-gray-350">
            <span>&copy; {{ date('Y') == 2021 ? '' : '2021-' }}</span><span>{{ date('Y') }} Derechos reservados. {{ config('app.name') }}.</span>
        </p>
    </div>
</footer>