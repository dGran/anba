<x-app-layout blockHeader="0">

{{--     <div class="h-48 md:h-96 bg-no-repeat bg-left-top bg-cover bg-opacity-30" style="background-color: #000; background-image: url(https://www.desktopbackground.org/p/2010/04/11/149_nba-wallpapers-power-shot_3508x2480_h.jpg);">
        <div class="max-w-7xl mx-auto md:px-1 sm:px-3 md:px-6 lg:px-8">

        </div>
    </div> --}}
    <div class="max-w-7xl mx-auto md:px-6 lg:px-8 md:my-8">
            <div class="bg-cover bg-top h-60 max-h-60 sm:h-72 sm:max-h-72 md:h-80 md:max-h-80 lg:h-96 lg:max-h-96 xl:h-96 xl:max-h-96 text-white py-12 px-6 object-fill md:rounded-lg" style="background-image: url(https://i1.wp.com/couchguysports.com/wp-content/uploads/2020/07/Zion-Williamson-reacts-to-NBA-2K21-cover-honor.jpg?fit=1200%2C673&ssl=1)">
{{--                 <div class="bg-black p-4">
                    <p class="font-bold text-sm uppercase">Record Racha</p>
                    <p class="text-2xl font-bold leading-8">Lakers aumentan su racha</p>
                    <p class="text-base mb-10 leading-5 bg-black w-full">Tras imponerse a los Celtics, consiguen un 7-0 en los ultimos partidos</p>
                    <a href="#" class="bg-pink-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a>
                </div> --}}
            </div> <!-- container -->
{{--             <h4 class="text-center py-3 font-bold">
                La liga interactiva mas real para NBA2K
            </h4> --}}
    </div>

    <div class="sliderAx hidden h-60 max-h-60 max-w-7xl mx-auto md:px-6 lg:px-8 md:mt-12">
        <div id="slider-1" class="container mx-auto">
            <div class="bg-cover bg-center h-60 max-h-60 text-white py-12 px-6 object-fill sm:rounded-lg" style="background-image: url(https://wallpapercave.com/wp/wp3224845.jpg)">
                <div class="bg-black p-4">
                    <p class="font-bold text-sm uppercase">Record Racha</p>
                    <p class="text-2xl font-bold leading-8">Lakers aumentan su racha</p>
                    <p class="text-base leading-5 bg-black w-full">Tras imponerse a los Celtics, consiguen un 7-0 en los ultimos partidos</p>
                    {{-- <a href="#" class="bg-pink-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a> --}}
                </div>
            </div> <!-- container -->
            <br>
        </div>

        <div id="slider-2" class="container mx-auto">
            <div class="bg-cover bg-center h-60 max-h-60 text-white py-12 px-6 object-fill sm:rounded-lg" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbVYNaLwvzzy7n6pb7f3ohlGBoEEI4iq9ong&usqp=CAU)">
                <div class="bg-black p-4">
                    <p class="font-bold text-sm uppercase">Record Racha</p>
                    <p class="text-2xl font-bold leading-8">Lakers aumentan su racha</p>
                    <p class="text-base leading-5 bg-black w-full">Tras imponerse a los Celtics, consiguen un 7-0 en los ultimos partidos</p>
                    {{-- <a href="#" class="bg-pink-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a> --}}
                </div>
            </div> <!-- container -->
            <br>
        </div>
    </div>

    <div  class="flex hidden justify-between w-12 mx-auto mt-4">
        <button id="sButton1" onclick="sliderButton1()" class="bg-pink-400 rounded-full w-4 pb-2 focus:outline-none" ></button>
        <button id="sButton2" onclick="sliderButton2() " class="bg-pink-400 rounded-full w-4 p-2 focus:outline-none"></button>
    </div>


    <div class="max-w-7xl mx-auto md:px-6 lg:px-8 md:my-8">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1 lg:mr-3">
                <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 bg-header-bg dark:bg-gray-750 px-4 py-2.5 md:rounded-t-md text-white">
                    ultimas noticias
                </h4>
                <ul class="text-xs md:text-sm tracking-wide flex bg-header-bg dark:bg-gray-750 text-gray-150 px-4 overflow-x-auto border-b border-header-bg-light dark:border-gray-650 select-none">
                    <li class="">
                        <p class="leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none bg-header-bg-lighter dark:bg-gray-650 border border-header-bg-lighter dark:border-gray-650 border-b-0 rounded-t-md">
                            todas
                        </p>
                    </li>
                    <li class="ml-2.5">
                        <button type="button" class="leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none hover:bg-header-bg-lighter focus:bg-header-bg-lighter dark:hover:bg-gray-650 dark:focus:bg-gray-650 border border-header-bg-lighter dark:border-gray-650 border-b-0 rounded-t-md">
                            resultados
                        </button>
                    </li>
                    <li class="ml-2.5">
                        <button type="button" class="leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none hover:bg-header-bg-lighter focus:bg-header-bg-lighter dark:hover:bg-gray-650 dark:focus:bg-gray-650 border border-header-bg-lighter dark:border-gray-650 border-b-0 rounded-t-md">
                            records
                        </button>
                    </li>
                    <li class="ml-2.5">
                        <button type="button" class="leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none hover:bg-header-bg-lighter focus:bg-header-bg-lighter dark:hover:bg-gray-650 dark:focus:bg-gray-650 border border-header-bg-lighter dark:border-gray-650 border-b-0 rounded-t-md">
                            fichajes
                        </button>
                    </li>
                    <li class="ml-2.5 pr-4">
                        <button type="button" class="leading-4 uppercase px-2.5 py-1.5 rounded-t-md focus:outline-none hover:bg-header-bg-lighter focus:bg-header-bg-lighter dark:hover:bg-gray-650 dark:focus:bg-gray-650 border border-header-bg-lighter dark:border-gray-650 border-b-0 rounded-t-md">
                            prensa
                        </button>
                    </li>
                </ul>
                <div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-b-md md:mx-0 text-gray-900 dark:text-gray-200">
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    <div class="flex p-4 border-b border-gray-200 dark:border-gray-650">
                        <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                        <div class="flex flex-col ml-5">
                            <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                            <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                            <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:mt-6 lg:mt-0 lg:ml-3 lg:max-w-sm">
                <div class="flex flex-col">
                    <div>
                        <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            clasificaciones
                        </h4>
                        <div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-md md:mx-0 p-4 text-gray-900 dark:text-gray-200">
                            <div class="flex">
                                <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover rounded-full border">
                                <div class="flex flex-col ml-5">
                                    <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                                    <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                                    <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                                </div>
                            </div>
                            <div class="flex mt-6">
                                <img src="https://anba.test/storage/players/yogi_ferrell.png" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover rounded-full border">
                                <div class="flex flex-col ml-5">
                                    <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                                    <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                                    <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                                </div>
                            </div>

                            <div class="flex mt-6">
                                <img src="https://anba.test/storage/players/yogi_ferrell.png" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover rounded-full border">
                                <div class="flex flex-col ml-5">
                                    <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                                    <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                                    <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:mt-6">
                         <h4 class="text-base uppercase font-bold tracking-wider md:mt-0 md:mb-3 bg-header-bg dark:bg-gray-750 px-4 py-2.5 md:rounded-md text-white">
                            tops
                        </h4>
                        <div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-md md:mx-0 p-4 text-gray-900 dark:text-gray-200">
                            <div class="flex">
                                <img src="https://hdwallsource.com/img/2014/6/nba-wallpapers-10874-11246-hd-wallpapers.jpg" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover rounded-full border">
                                <div class="flex flex-col ml-5">
                                    <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                                    <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                                    <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                                </div>
                            </div>
                            <div class="flex mt-6">
                                <img src="https://anba.test/storage/players/yogi_ferrell.png" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover rounded-full border">
                                <div class="flex flex-col ml-5">
                                    <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                                    <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                                    <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                                </div>
                            </div>

                            <div class="flex mt-6">
                                <img src="https://anba.test/storage/players/yogi_ferrell.png" alt="" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover rounded-full border">
                                <div class="flex flex-col ml-5">
                                    <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">record</p>
                                    <h4 class="text-base md:text-xl font-bold leading-5">Yogi Ferrell logra el record de puntuación de la temporada</h4>
                                    <p class="text-sm md:text-base">Lorem ipsum, dolor sit amet consectetur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


  <script>
    var cont=0;
function loopSlider(){
  var xx= setInterval(function(){
        switch(cont)
        {
        case 0:{
            $("#slider-1").fadeOut(400);
            $("#slider-2").delay(400).fadeIn(400);
            $("#sButton1").removeClass("bg-pink-800");
            $("#sButton2").addClass("bg-pink-800");
        cont=1;

        break;
        }
        case 1:
        {

            $("#slider-2").fadeOut(400);
            $("#slider-1").delay(400).fadeIn(400);
            $("#sButton2").removeClass("bg-pink-800");
            $("#sButton1").addClass("bg-pink-800");

        cont=0;

        break;
        }


        }},8000);

}

function reinitLoop(time){
clearInterval(xx);
setTimeout(loopSlider(),time);
}



function sliderButton1(){

    $("#slider-2").fadeOut(400);
    $("#slider-1").delay(400).fadeIn(400);
    $("#sButton2").removeClass("bg-pink-800");
    $("#sButton1").addClass("bg-pink-800");
    reinitLoop(4000);
    cont=0

    }

    function sliderButton2(){
    $("#slider-1").fadeOut(400);
    $("#slider-2").delay(400).fadeIn(400);
    $("#sButton1").removeClass("bg-pink-800");
    $("#sButton2").addClass("bg-pink-800");
    reinitLoop(4000);
    cont=1

    }

    $(window).ready(function(){
        $("#slider-2").hide();
        $("#sButton1").addClass("bg-pink-800");


        loopSlider();






    });


  </script>

</x-app-layout>