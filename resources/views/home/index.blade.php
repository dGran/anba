<div>

	{{-- banner --}}
    <div class="max-w-7xl mx-auto md:px-6 lg:px-8 md:my-8">
        <div class="bg-cover bg-top h-60 max-h-60 sm:h-72 sm:max-h-72 md:h-80 md:max-h-80 lg:h-96 lg:max-h-96 xl:h-96 xl:max-h-96 text-white py-12 px-6 object-fill md:rounded-lg" style="background-image: url(https://i1.wp.com/couchguysports.com/wp-content/uploads/2020/07/Zion-Williamson-reacts-to-NBA-2K21-cover-honor.jpg?fit=1200%2C673&ssl=1)">
        </div>
{{--         <h4 class="text-center py-3 font-bold">
        	La liga interactiva mas real para NBA2K
    	</h4> --}}
    </div>

    <div class="max-w-7xl mx-auto md:px-6 lg:px-8 md:my-8">
        <div class="flex flex-col lg:flex-row">

            <div class="flex-1 lg:mr-3">
                <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 bg-header-bg dark:bg-gray-750 px-4 py-2.5 md:rounded-t-md text-white">
                    ultimas noticias
                </h4>
                @include('home.last-news-filters')
                @include('home.last-news')
            </div>

            <div class="md:mt-6 lg:mt-0 lg:ml-3 lg:max-w-sm">
                <div class="flex flex-col">
                    <div>
                        <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            clasificaciones
                        </h4>
                        @include('home.standings')
                    </div>

                    <div class="md:mt-6">
                         <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            tops
                        </h4>
                        @include('home.tops')
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>