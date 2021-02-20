<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-md md:mx-0 py-2 text-gray-900 dark:text-gray-200">
	@if ($season)
		@if ($season->top_season_mvp()->count() > 0)
			@foreach ($season->top_season_reb() as $top)
			    <div class="flex items-center py-2 px-4 text-sm {{ $loop->iteration < 3 ? 'border-b border-gray-200 dark:border-gray-650' : '' }}">

					@include('home.tops.player_info')

			        <div class="flex items-center">
			        	<div class="flex flex-col">
			        		<p class="text-right tracking-wide">REB</p>
			        		<p class="text-right">{{ number_format($top->SUM_REB, 0, ',', '.') }}</p>
			        	</div>
			        	<div class="ml-3 flex flex-col">
			        		<p class="text-right tracking-wide">RPG</p>
			        		<p class="text-right font-bold">{{ number_format($top->AVG_REB, 1, ',', '.') }}</p>
			        	</div>
			        	<div class="ml-3 flex flex-col">
			        		<p class="text-right tracking-wide">PJ</p>
			        		<p class="text-right">{{ number_format($top->PJ, 0, ',', '.') }}</p>
			        	</div>
			        </div>
			    </div>
			@endforeach
		@else
			<p class="px-4 py-2">
				No se han encontrado datos
			</p>
		@endif
	@else
		<p class="px-4 py-2">
			Temporada actual no encontrada
		</p>
	@endif
</div>