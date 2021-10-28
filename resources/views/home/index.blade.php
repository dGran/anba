<div>

	{{-- banner --}}
    <div class="max-w-7xl mx-auto md:px-6 lg:px-8 md:my-8">
        <div class="bg-none bg-cover bg-no-repeat bg-top h-60 sm:h-72 md:h-80 lg:h-96 xl:h-96 text-white py-12 px-6 object-fill md:rounded-lg" style="background-image: url({{ asset('img/home_banner.jpg') }})">
        </div>
    </div>

    <div class="max-w-7xl mx-auto md:px-6 lg:px-8 md:my-8">
        <div class="flex flex-col md:flex-row">

            <div class="md:mr-3 w-full md:w-1/2 lg:w-7/12 xl:w-8/12">
                <h4 class="flex items-center justify-between text-base uppercase font-bold tracking-wider md:mt-0 bg-header-bg-light dark:bg-gray-750 px-4 py-2.5 md:rounded-t-md text-white">
                    <span>ultimas noticias</span>
                    @if ($posts->lastPage() > 1)
                        <div class="flex items-center">
                            <button type="button" class="focus:outline-none" wire:click="setPreviousPage"><i class="fas fa-chevron-left"></i></button>
                            <span class="text-sm px-3">{{ $page }}</span>
                            <button type="button" class="focus:outline-none" wire:click="setNextPage"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    @endif
                </h4>
                @include('home.last-news.filters')
                @include('home.last-news.content')
            </div>

            <div class="md:ml-3 w-full md:w-1/2 lg:w-5/12 xl:w-4/12">
                <div class="flex flex-col">
                    <div>
                        <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg-light dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            clasificaciones
                        </h4>
                        @include('home.standings')
                    </div>

                    <div class="md:mt-6">
                         <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg-light dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            MVP de la temporada
                        </h4>
                        @include('home.tops.top_season_mvp')
                    </div>

                    <div class="md:mt-6">
                         <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg-light dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            top anotadores
                        </h4>
                        @include('home.tops.top_season_pts')
                    </div>

                    <div class="md:mt-6">
                         <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg-light dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            top rebotes
                        </h4>
                        @include('home.tops.top_season_reb')
                    </div>

                    <div class="md:mt-6">
                         <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg-light dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            top asistencias
                        </h4>
                        @include('home.tops.top_season_ast')
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>