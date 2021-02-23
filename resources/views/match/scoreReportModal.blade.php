@if ($scoreReportModal)
	<x-modals.dialog maxWidth="" wire:model="scoreReportModal" >
	    <x-slot name="title">
			<div class="p-4 border-b border-gray-200 dark:border-gray-650 bg-gray-50 dark:bg-gray-700">
				<p class="uppercase text-sm font-bold tracking-wider">REPORTAR RESULTADO</p>
			</div>
	    </x-slot>

	    <x-slot name="content">
			<div class="px-4">

                <p class="text-center my-3">{{ $match->stadium }}</p>
                <div class="flex items-center justify-center mb-3">
                    <div class="local">
                        <img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->short_name }}" style="width: 72px; height: 72px; {{ $total_scores['visitor'] > $total_scores['local'] ? 'filter: grayscale(1)' : '' }}" class="ml-1 {{ $total_scores['visitor'] > $total_scores['local'] ? 'opacity-50' : 'opacity-100' }}">
                        <p class="block m-0 pt-2 text-center text-sm">{{ $match->localTeam->team->medium_name }}</p>
                        <p class="block m-0 text-center text-xs text-gray-500 dark:text-gray-300">{{ $match->localManager ? $match->localManager->name : 'Sin manager' }}</p>
                        <div class="mt-2">
							@if ($total_scores['local'] > $total_scores['visitor'])
								<span class="bg-green-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">V</span>
							@elseif ($total_scores['visitor'] > $total_scores['local'])
								<span class="bg-red-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">D</span>
							@else
								<span class="bg-gray-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">-</span>
							@endif
						</div>
                    </div>
                    <div class="result mx-3 text-center text-2xl font-bold border border-gray-200 dark:border-gray-650 rounded px-2 py-1 bg-gray-50 dark:bg-gray-700" style="min-width: 120px">
                        <div class="inline-block">
                            {{ $total_scores ? $total_scores['local'] : '' }}
                        </div>
                        <div class="inline-block">-</div>
                        <div class="inline-block">
                            {{ $total_scores ? $total_scores['visitor'] : '' }}
                        </div>
                    </div>
                    <div class="visitor">
                        <img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->short_name }}" style="width: 72px; height: 72px; {{ $total_scores['local'] > $total_scores['visitor'] ? 'filter: grayscale(1)' : '' }}" class="mr-1 {{ $total_scores['local'] > $total_scores['visitor'] ? 'opacity-50' : 'opacity-100' }}">
                        <p class="block m-0 pt-2 text-center text-sm">{{ $match->visitorTeam->team->medium_name }}</p>
                        <p class="block m-0 text-center text-xs text-gray-500 dark:text-gray-300">{{ $match->visitorManager ? $match->visitorManager->name : 'Sin manager' }}</p>
                        <div class="mt-2">
							@if ($total_scores['visitor'] > $total_scores['local'])
								<span class="bg-green-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">V</span>
							@elseif ($total_scores['local'] > $total_scores['visitor'])
								<span class="bg-red-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">D</span>
							@else
								<span class="bg-gray-500 rounded-full w-6 h-6 text-xs text-white uppercase flex items-center justify-center mx-auto">-</span>
							@endif
						</div>
                    </div>
                </div>

 				@foreach ($scores as $key => $score)
	                <div class="flex items-center justify-center my-3 border-t border-gray-200 dark:border-gray-650 -mx-4 px-3 pt-5">
	                    <div class="local">
							<input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" wire:model="scores.{{ $key }}.local_score" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none">
	                    </div>
	                    <div class="result mx-3 text-center text-sm font-bold px-2 py-1" style="min-width: 120px">
							{{ $score['seasons_scores_headers_name'] }}
	                    </div>
	                    <div class="visitor">
							<input type="number" min="0" max="999" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" wire:model="scores.{{ $key }}.visitor_score" class="appearance-none rounded text-sm | py-1.5 px-3 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none">
	                    </div>
	                </div>
	            @endforeach

                <div class="flex flex-col items-center justify-center pt-0">
                    <div class="result mx-3 text-center text-sm font-bold px-2" style="min-width: 120px">
						Prórrogas
                    </div>
                    <div class="">
						<input type="number" min="0" max="99" maxlength = "2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="-" wire:model="extra_times" class="appearance-none rounded text-sm | py-1.5 px-3 mt-1 | bg-white dark:bg-gray-700 | border border-gray-300 dark:border-gray-850 focus:border-gray-400 hover:border-gray-400 dark:focus:border-gray-550 dark:hover:border-gray-550 | focus:outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-center mt-5 border-t border-gray-200 dark:border-gray-650 bg-gray-50 dark:bg-gray-700 -mx-4 px-3 py-5">
	                @if ($total_scores['local'] == $total_scores['visitor'])
	                	<p class="text-pretty-red font-bold text-center">No se permite reportar sin especificar el vencedor</p>
	                @else
					    <button type="button" class="text-white dark:text-gray-900 rounded bg-blue-500 dark:bg-dark-link focus:outline-none hover:bg-blue-600 focus:bg-blue-600 dark:hover:bg-blue-300 dark:focus:bg-blue-300 transition duration-150 ease-in-out uppercase text-xs py-2 leading-4 w-36 md:w-40 lg:w-48" wire:click.prevent="reportResult">
							reportar resultado
					    </button>
	                @endif
                </div>

			</div>
	    </x-slot>
	</x-modals.dialog>
@endif