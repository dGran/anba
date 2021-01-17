<footer class="bg-header-bg dark:bg-gray-925 leading-normal border-t border-gray-200 dark:border-gray-700" {{-- style="background-color: #2d3e50" --}}>
    <div class="w-full bg-header-bg-light dark:bg-gray-900">
        <ul class="max-w-7xl mx-auto flex items-center justify-center flex-wrap leading-6 py-3.5 px-4 list-none font-bold uppercase text-sm tracking-wider text-gray-350">
            <li class="px-2 md:px-3 lg:px-4"><a href="{{ route('home') }}" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Inicio</a></li>
            <li class="px-2 md:px-3 lg:px-4"><a href="{{ route('matches') }}" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Partidos</a></li>
            <li class="px-2 md:px-3 lg:px-4"><a href="{{ route('standings') }}" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Clasificaciones</a></li>
            <li class="px-2 md:px-3 lg:px-4"><a href="#" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Estadisticas</a></li>
            <li class="px-2 md:px-3 lg:px-4"><a href="{{ route('players') }}" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Jugadores</a></li>
            <li class="px-2 md:px-3 lg:px-4"><a href="#" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Equipos</a></li>
            <li class="px-2 md:px-3 lg:px-4"><a href="#" class="outline-none hover:text-white focus:text-white dark:hover:text-dark-link dark:focus:text-dark-link">Managers</a></li>
        </ul>
        <p class="py-3 font-miriam uppercase text-xs tracking-widest text-gray-350 text-center border-t border-header-bg-dark dark:border-gray-750">
            webapp desarrollada por
            <a href="mailto:dgranh@gmail.com" class="block font-bad-script capitalize font-bold text-sm hover:text-pretty-red focus:text-pretty-red focus:outline-none mt-1">David Gran</a>
        </p>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="py-3 font-miriam uppercase text-xs tracking-widest text-gray-350">
            <span>&copy; {{ date('Y') == 2021 ? '' : '2021-' }}</span><span>{{ date('Y') }} Derechos reservados. {{ config('app.name') }}.</span>
        </p>
    </div>
</footer>