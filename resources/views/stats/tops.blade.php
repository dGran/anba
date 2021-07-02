<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-md md:mx-0 py-2 text-gray-900 dark:text-gray-200 mt-4">
	<div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 py-2 gap-4">
    	<div class="text-center">
    		<h4 class="text-xl uppercase mb-1.5">Puntos</h4>
	    	<img src="{{ $tops_PTS->first()->player->getImg() }}" alt="" class="hidden xs:block h-36 w-36 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650 mx-auto" style="background-color: {{ $tops_PTS->first()->player->team ? $tops_PTS->first()->player->team->color : '' }}">
	    	<p class="pt-1.5 text-xl">
	    		{{ $tops_PTS->first()->player->name }}
	    	</p>
	    	<p class="pt-1 text-sm">
	    		Total: {{ number_format($tops_PTS->first()->SUM_PTS, 0, ',', '.') }} / Partido: {{ number_format($tops_PTS->first()->AVG_PTS, 1, ',', '.') }}
	    	</p>
    	</div>

    	<div class="text-center">
    		<h4 class="text-xl uppercase mb-1.5">Asistencias</h4>
	    	<img src="{{ $tops_AST->first()->player->getImg() }}" alt="" class="hidden xs:block h-36 w-36 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650 mx-auto" style="background-color: {{ $tops_AST->first()->player->team ? $tops_AST->first()->player->team->color : '' }}">
	    	<p class="pt-1.5 text-xl">
	    		{{ $tops_AST->first()->player->name }}
	    	</p>
	    	<p class="pt-1 text-sm">
	    		Total: {{ number_format($tops_AST->first()->SUM_AST, 0, ',', '.') }} / Partido: {{ number_format($tops_AST->first()->AVG_AST, 1, ',', '.') }}
	    	</p>
    	</div>

    	<div class="text-center">
    		<h4 class="text-xl uppercase mb-1.5">Rebotes</h4>
	    	<img src="{{ $tops_REB->first()->player->getImg() }}" alt="" class="hidden xs:block h-36 w-36 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650 mx-auto" style="background-color: {{ $tops_REB->first()->player->team ? $tops_REB->first()->player->team->color : '' }}">
	    	<p class="pt-1.5 text-xl">
	    		{{ $tops_REB->first()->player->name }}
	    	</p>
	    	<p class="pt-1 text-sm">
	    		Total: {{ number_format($tops_REB->first()->SUM_REB, 0, ',', '.') }} / Partido: {{ number_format($tops_REB->first()->AVG_REB, 1, ',', '.') }}
	    	</p>
    	</div>

    	<div class="text-center">
    		<h4 class="text-xl uppercase mb-1.5">Tapones</h4>
	    	<img src="{{ $tops_BLK->first()->player->getImg() }}" alt="" class="hidden xs:block h-36 w-36 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650 mx-auto" style="background-color: {{ $tops_BLK->first()->player->team ? $tops_BLK->first()->player->team->color : '' }}">
	    	<p class="pt-1.5 text-xl">
	    		{{ $tops_BLK->first()->player->name }}
	    	</p>
	    	<p class="pt-1 text-sm">
	    		Total: {{ number_format($tops_BLK->first()->SUM_BLK, 0, ',', '.') }} / Partido: {{ number_format($tops_BLK->first()->AVG_BLK, 1, ',', '.') }}
	    	</p>
    	</div>

	</div>
</div>