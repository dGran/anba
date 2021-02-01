@if ($match->localTeam_playerTotals() && $match->visitorTeam_playerTotals() && $match->localTeam_teamTotals() && $match->visitorTeam_teamTotals())
	<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0 my-6">
		<div class="px-3 py-1">

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
					<p class="w-24 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_playerTotals()->FGAVG > $match->visitorTeam_playerTotals()->FGAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_playerTotals()->FGA ?: '0' }}/{{ $match->localTeam_playerTotals()->FGM ?: '0' }} ({{ number_format($match->localTeam_playerTotals()->FGAVG, 0) ?: '0' }}%)
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">
						<span class="hidden sm:block">tiros de campo</span>
						<span class="sm:hidden">tiros campo</span>
					</p>
					<p class="w-24 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_playerTotals()->FGAVG > $match->localTeam_playerTotals()->FGAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_playerTotals()->FGA ?: '0' }}/{{ $match->visitorTeam_playerTotals()->FGM ?: '0' }} ({{ number_format($match->visitorTeam_playerTotals()->FGAVG, 0) ?: '0' }}%)
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-24 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_playerTotals()->TPAVG > $match->visitorTeam_playerTotals()->TPAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_playerTotals()->TPA ?: '0' }}/{{ $match->localTeam_playerTotals()->TPM ?: '0' }} ({{ number_format($match->localTeam_playerTotals()->TPAVG, 0) ?: '0' }}%)
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">triples</p>
					<p class="w-24 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_playerTotals()->TPAVG > $match->localTeam_playerTotals()->TPAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_playerTotals()->TPA ?: '0' }}/{{ $match->visitorTeam_playerTotals()->TPM ?: '0' }} ({{ number_format($match->visitorTeam_playerTotals()->TPAVG, 0) ?: '0' }}%)
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-24 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_playerTotals()->FTAVG > $match->visitorTeam_playerTotals()->FTAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_playerTotals()->FTA ?: '0' }}/{{ $match->localTeam_playerTotals()->FTM ?: '0' }} ({{ number_format($match->localTeam_playerTotals()->FTAVG, 0) ?: '0' }}%)
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tiros libres</p>
					<p class="w-24 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_playerTotals()->FTAVG > $match->localTeam_playerTotals()->FTAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_playerTotals()->FTA ?: '0' }}/{{ $match->visitorTeam_playerTotals()->FTM ?: '0' }} ({{ number_format($match->visitorTeam_playerTotals()->FTAVG, 0) ?: '0' }}%)
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->counterattack > $match->visitorTeam_teamTotals()->counterattack ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->counterattack ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. contraataque</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->counterattack > $match->localTeam_teamTotals()->counterattack ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->counterattack ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->zone > $match->visitorTeam_teamTotals()->zone ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->zone ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. desde la zona</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->zone > $match->localTeam_teamTotals()->zone ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->zone ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->second_oportunity > $match->visitorTeam_teamTotals()->second_oportunity ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->second_oportunity ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. 2ª oportunidad</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->second_oportunity > $match->localTeam_teamTotals()->second_oportunity ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->second_oportunity ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->substitute > $match->visitorTeam_teamTotals()->substitute ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->substitute ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. de suplentes</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->substitute > $match->localTeam_teamTotals()->substitute ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->substitute ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->AST > $match->visitorTeam_teamTotals()->AST ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->AST ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">asistencias</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->AST > $match->localTeam_teamTotals()->AST ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->AST ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->ORB > $match->visitorTeam_teamTotals()->ORB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->ORB ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">rebotes ofensivos</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->ORB > $match->localTeam_teamTotals()->ORB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->ORB ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->DRB > $match->visitorTeam_teamTotals()->DRB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->DRB ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">rebotes defensivos</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->DRB > $match->localTeam_teamTotals()->DRB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->DRB ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->STL > $match->visitorTeam_teamTotals()->STL ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->STL ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">robos</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->STL > $match->localTeam_teamTotals()->STL ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->STL ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->BLK > $match->visitorTeam_teamTotals()->BLK ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->BLK ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tapones</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->BLK > $match->localTeam_teamTotals()->BLK ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->BLK ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->LOS < $match->visitorTeam_teamTotals()->LOS ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->LOS ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pérdidas</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->LOS > $match->localTeam_teamTotals()->LOS ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->LOS ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->PF < $match->visitorTeam_teamTotals()->PF ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->PF ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">faltas equipo</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->PF > $match->localTeam_teamTotals()->PF ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->PF ?: '0' }}
					</p>
				</div>
			</div>
			<div class="flex flex-col py-0.5 md:py-1.5">
				<div class="flex items-center">
					<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_teamTotals()->advantage > $match->visitorTeam_teamTotals()->advantage ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->localTeam_teamTotals()->advantage ?: '0' }}
					</p>
					<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">mayor ventaja</p>
					<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_teamTotals()->advantage > $match->localTeam_teamTotals()->advantage ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
						{{ $match->visitorTeam_teamTotals()->advantage ?: '0' }}
					</p>
				</div>
			</div>

	</div>
</div>

@endif