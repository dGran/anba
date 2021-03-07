{{-- @if ($localTeam_playerTotals && $visitorTeam_playerTotals && $localTeam_teamTotals && $visitorTeam_teamTotals) --}}
	<div class="{{ !$localBoxscoreReport && !$visitorBoxscoreReport ?: 'hidden' }} bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0 my-6">
		<div class="px-3 py-1">

			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<div class="flex-1 flex items-center text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold text-gray-500 dark:text-gray-300 uppercase">
						<img src="{{ $match->localTeam->team->getImg() }}" alt="{{ $match->localTeam->team->medium_name }}" class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10 object-cover mr-2">
						<span>{{ $match->localTeam->team->medium_name }}</span>
					</div>
					<div class="flex-1 flex items-center justify-end text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold text-gray-500 dark:text-gray-300 uppercase">
						<span>{{ $match->visitorTeam->team->medium_name }}</span>
						<img src="{{ $match->visitorTeam->team->getImg() }}" alt="{{ $match->visitorTeam->team->medium_name }}" class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10 object-cover ml-2">
					</div>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localScore() > $match->visitorScore() ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localScore() }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">puntos</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorScore() > $match->localScore() ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorScore() }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-24 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $localTeam_playerTotals->FGAVG > $visitorTeam_playerTotals->FGAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_playerTotals->FGM) ? $localTeam_playerTotals->FGM : '-' }}/{{ isset($localTeam_playerTotals->FGA) ? $localTeam_playerTotals->FGA : '-' }} {{ isset($localTeam_playerTotals->FGAVG) ? '(' . number_format($localTeam_playerTotals->FGAVG, 0) . '%)' : '' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">
						<span class="hidden sm:block">tiros de campo</span>
						<span class="sm:hidden">tiros campo</span>
					</p>
					<p class="w-24 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $visitorTeam_playerTotals->FGAVG > $localTeam_playerTotals->FGAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_playerTotals->FGM) ? $visitorTeam_playerTotals->FGM : '-' }}/{{ isset($visitorTeam_playerTotals->FGA) ? $visitorTeam_playerTotals->FGA : '-' }} {{ isset($visitorTeam_playerTotals->FGAVG) ? '(' . number_format($visitorTeam_playerTotals->FGAVG, 0) . '%)' : '' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-24 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $localTeam_playerTotals->TPAVG > $visitorTeam_playerTotals->TPAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_playerTotals->TPM) ? $localTeam_playerTotals->TPM : '-' }}/{{ isset($localTeam_playerTotals->TPA) ? $localTeam_playerTotals->TPA : '-' }} {{ isset($localTeam_playerTotals->TPAVG) ? '(' . number_format($localTeam_playerTotals->TPAVG, 0) . '%)' : '' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">triples</p>
					<p class="w-24 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $visitorTeam_playerTotals->TPAVG > $localTeam_playerTotals->TPAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_playerTotals->TPM) ? $visitorTeam_playerTotals->TPM : '-' }}/{{ isset($visitorTeam_playerTotals->TPA) ? $visitorTeam_playerTotals->TPA : '-' }} {{ isset($visitorTeam_playerTotals->TPAVG) ? '(' . number_format($visitorTeam_playerTotals->TPAVG, 0) . '%)' : '' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-24 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $localTeam_playerTotals->FTAVG > $visitorTeam_playerTotals->FTAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_playerTotals->FTM) ? $localTeam_playerTotals->FTM : '-' }}/{{ isset($localTeam_playerTotals->FTA) ? $localTeam_playerTotals->FTA : '-' }} {{ isset($localTeam_playerTotals->FTAVG) ? '(' . number_format($localTeam_playerTotals->FTAVG, 0) . '%)' : '' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tiros libres</p>
					<p class="w-24 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $visitorTeam_playerTotals->FTAVG > $localTeam_playerTotals->FTAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_playerTotals->FTM) ? $visitorTeam_playerTotals->FTM : '-' }}/{{ isset($visitorTeam_playerTotals->FTA) ? $visitorTeam_playerTotals->FTA : '-' }} {{ isset($visitorTeam_playerTotals->FTAVG) ? '(' . number_format($visitorTeam_playerTotals->FTAVG, 0) . '%)' : '' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->counterattack) && isset($visitorTeam_teamTotals->counterattack) && $localTeam_teamTotals->counterattack > $visitorTeam_teamTotals->counterattack ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->counterattack) ? $localTeam_teamTotals->counterattack : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. contraataque</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->counterattack) && isset($visitorTeam_teamTotals->counterattack) && $visitorTeam_teamTotals->counterattack > $localTeam_teamTotals->counterattack ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->counterattack) ? $visitorTeam_teamTotals->counterattack : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->zone) && isset($visitorTeam_teamTotals->zone) &&$localTeam_teamTotals->zone > $visitorTeam_teamTotals->zone ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->zone) ? $localTeam_teamTotals->zone : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. desde la zona</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->zone) && isset($visitorTeam_teamTotals->zone) &&$visitorTeam_teamTotals->zone > $localTeam_teamTotals->zone ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->zone) ? $visitorTeam_teamTotals->zone : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->second_oportunity) && isset($visitorTeam_teamTotals->second_oportunity) && $localTeam_teamTotals->second_oportunity > $visitorTeam_teamTotals->second_oportunity ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->second_oportunity) ? $localTeam_teamTotals->second_oportunity : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. 2ª oportunidad</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->second_oportunity) && isset($visitorTeam_teamTotals->second_oportunity) && $visitorTeam_teamTotals->second_oportunity > $localTeam_teamTotals->second_oportunity ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->second_oportunity) ? $visitorTeam_teamTotals->second_oportunity : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->substitute) && isset($visitorTeam_teamTotals->substitute) && $localTeam_teamTotals->substitute > $visitorTeam_teamTotals->substitute ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->substitute) ? $localTeam_teamTotals->substitute : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. de suplentes</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->substitute) && isset($visitorTeam_teamTotals->substitute) && $visitorTeam_teamTotals->substitute > $localTeam_teamTotals->substitute ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->substitute) ? $visitorTeam_teamTotals->substitute : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->AST) && isset($visitorTeam_teamTotals->AST) && $localTeam_teamTotals->AST > $visitorTeam_teamTotals->AST ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->AST) ? $localTeam_teamTotals->AST : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">asistencias</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->AST) && isset($visitorTeam_teamTotals->AST) && $visitorTeam_teamTotals->AST > $localTeam_teamTotals->AST ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->AST) ? $visitorTeam_teamTotals->AST : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->DRB) && isset($visitorTeam_teamTotals->DRB) && isset($localTeam_teamTotals->ORB) && isset($visitorTeam_teamTotals->ORB) && $localTeam_teamTotals->DRB + $localTeam_teamTotals->ORB > $visitorTeam_teamTotals->DRB + $visitorTeam_teamTotals->ORB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->DRB) || isset($localTeam_teamTotals->ORB) ? $localTeam_teamTotals->DRB + $localTeam_teamTotals->ORB : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">rebotes</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->DRB) && isset($visitorTeam_teamTotals->DRB) && isset($localTeam_teamTotals->ORB) && isset($visitorTeam_teamTotals->ORB) && $visitorTeam_teamTotals->DRB + $visitorTeam_teamTotals->ORB > $localTeam_teamTotals->DRB + $visitorTeam_teamTotals->ORB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->DRB) || isset($visitorTeam_teamTotals->ORB) ? $visitorTeam_teamTotals->DRB + $visitorTeam_teamTotals->ORB : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->ORB) && isset($visitorTeam_teamTotals->ORB) && $localTeam_teamTotals->ORB > $visitorTeam_teamTotals->ORB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->ORB) ? $localTeam_teamTotals->ORB : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">rebotes ofensivos</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->ORB) && isset($visitorTeam_teamTotals->ORB) && $visitorTeam_teamTotals->ORB > $localTeam_teamTotals->ORB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->ORB) ? $visitorTeam_teamTotals->ORB : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->STL) && isset($visitorTeam_teamTotals->STL) && $localTeam_teamTotals->STL > $visitorTeam_teamTotals->STL ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->STL) ? $localTeam_teamTotals->STL : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">robos</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->STL) && isset($visitorTeam_teamTotals->STL) && $visitorTeam_teamTotals->STL > $localTeam_teamTotals->STL ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->STL) ? $visitorTeam_teamTotals->STL : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->BLK) && isset($visitorTeam_teamTotals->BLK) && $localTeam_teamTotals->BLK > $visitorTeam_teamTotals->BLK ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->BLK) ? $localTeam_teamTotals->BLK : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tapones</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->BLK) && isset($visitorTeam_teamTotals->BLK) && $visitorTeam_teamTotals->BLK > $localTeam_teamTotals->BLK ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->BLK) ? $visitorTeam_teamTotals->BLK : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->LOS) && isset($visitorTeam_teamTotals->LOS) && $localTeam_teamTotals->LOS < $visitorTeam_teamTotals->LOS ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->LOS) ? $localTeam_teamTotals->LOS : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pérdidas</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->LOS) && isset($visitorTeam_teamTotals->LOS) && $visitorTeam_teamTotals->LOS < $localTeam_teamTotals->LOS ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->LOS) ? $visitorTeam_teamTotals->LOS : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->PF) && isset($visitorTeam_teamTotals->PF) && $localTeam_teamTotals->PF < $visitorTeam_teamTotals->PF ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->PF) ? $localTeam_teamTotals->PF : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">faltas equipo</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->PF) && isset($visitorTeam_teamTotals->PF) && $visitorTeam_teamTotals->PF < $localTeam_teamTotals->PF ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->PF) ? $visitorTeam_teamTotals->PF : '-' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->advantage) && isset($visitorTeam_teamTotals->advantage) && $localTeam_teamTotals->advantage > $visitorTeam_teamTotals->advantage ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($localTeam_teamTotals->advantage) ? $localTeam_teamTotals->advantage : '-' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">mayor ventaja</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ isset($localTeam_teamTotals->advantage) && isset($visitorTeam_teamTotals->advantage) && $visitorTeam_teamTotals->advantage > $localTeam_teamTotals->advantage ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ isset($visitorTeam_teamTotals->advantage) ? $visitorTeam_teamTotals->advantage : '-' }}
					</p>
				</div>
			</div>

		</div>
	</div>
{{-- @endif --}}