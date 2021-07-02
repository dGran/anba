<h4 class="text-base font-bold uppercase tracking-wide mt-6 pb-2">
	Top Asistencias
</h4>

<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-md md:mx-0 py-2 text-gray-900 dark:text-gray-200">
	@if ($season)
		@if ($tops_AST->count() > 0)
			@foreach ($tops_AST as $top)
			    <div class="flex items-center py-2 px-4 text-sm {{ $loop->iteration < 10 ? 'border-b border-gray-200 dark:border-gray-650' : '' }}">

					<div class="flex-1">
						<div class="flex items-center">
							<img src="{{ $top->player->getImg() }}" alt="" class="hidden xs:block h-14 w-14 rounded-md shadow-md object-cover rounded-full border border-gray-300 dark:border-gray-650" style="background-color: {{ $top->player->team ? $top->player->team->color : '' }}">
							<div class="flex flex-col ml-2">
								<div class="flex items-center">
									<p class="font-bold">
										{{ $loop->iteration }}. {{ $top->player->name }}
									</p>
								</div>
								<div class="flex items-center">
									<img src="{{ $top->player->team->getImg() }}" alt="{{ $top->player->team->medium_name }}" class="w-7 h-7 mr-1">
									<p>{{ $top->player->team ? $top->player->team->short_name : '' }}<span class="mx-1.5">|</span><span class="uppercase">{{ $top->player->position }}</span></p>
								</div>
							</div>
						</div>
					</div>

			        <div class="flex items-center">
			        	<div class="flex flex-col">
			        		<p class="text-right tracking-wide">AST</p>
			        		<p class="text-right">{{ number_format($top->SUM_AST, 0, ',', '.') }}</p>
			        	</div>
			        	<div class="ml-3 flex flex-col">
			        		<p class="text-right tracking-wide">APG</p>
			        		<p class="text-right font-bold">{{ number_format($top->AVG_AST, 1, ',', '.') }}</p>
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