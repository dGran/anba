<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-md md:mx-0 py-2 text-gray-900 dark:text-gray-200">
	@if ($season)
		@if ($season->top_season_AST()->count() > 0)
			@foreach ($season->top_season_AST() as $top)
			    <div class="flex items-center py-2 px-4 text-sm {{ $loop->iteration < 3 ? 'border-b border-gray-200 dark:border-gray-650' : '' }}">

					@include('home.tops.player_info')

			        <div class="ml-4 grid grid-cols-3 gap-3">
			        	<div class="flex flex-col">
			        		<p class="text-center tracking-wide">APG</p>
			        		<p class="text-center">{{ number_format($top->AVG_AST, 1) }}</p>
			        	</div>
			        	<div class="flex flex-col">
			        		<p class="text-center tracking-wide">AST</p>
			        		<p class="text-center">{{ number_format($top->SUM_AST, 0) }}</p>
			        	</div>
			        	<div class="flex flex-col">
			        		<p class="text-center tracking-wide">PJ</p>
			        		<p class="text-center">{{ number_format($top->PJ, 0) }}</p>
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