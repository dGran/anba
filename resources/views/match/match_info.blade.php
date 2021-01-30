<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-6">
	<div class="px-3 py-1">

		{{-- <p class="uppercase text-sm font-bold tracking-wider pb-3">informe del partido</p> --}}
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
				<p class="w-28 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->FGAVG > $match->visitorTeam_totals()->FGAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->FGA ?: '0' }}/{{ $match->localTeam_totals()->FGM ?: '0' }} ({{ number_format($match->localTeam_totals()->FGAVG, 0) ?: '0' }}%)
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">
					<span class="hidden sm:block">tiros de campo</span>
					<span class="sm:hidden">t. campo</span>
				</p>
				<p class="w-28 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->FGAVG > $match->localTeam_totals()->FGAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->FGA ?: '0' }}/{{ $match->visitorTeam_totals()->FGM ?: '0' }} ({{ number_format($match->visitorTeam_totals()->FGAVG, 0) ?: '0' }}%)
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-28 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->TPAVG > $match->visitorTeam_totals()->TPAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->TPA ?: '0' }}/{{ $match->localTeam_totals()->TPM ?: '0' }} ({{ number_format($match->localTeam_totals()->TPAVG, 0) ?: '0' }}%)
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">triples</p>
				<p class="w-28 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->TPAVG > $match->localTeam_totals()->TPAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->TPA ?: '0' }}/{{ $match->visitorTeam_totals()->TPM ?: '0' }} ({{ number_format($match->visitorTeam_totals()->TPAVG, 0) ?: '0' }}%)
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-28 md:w-36 lg:w-40 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->FTAVG > $match->visitorTeam_totals()->FTAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->FTA ?: '0' }}/{{ $match->localTeam_totals()->FTM ?: '0' }} ({{ number_format($match->localTeam_totals()->FTAVG, 0) ?: '0' }}%)
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">
					<span class="hidden sm:block">tiros libres</span>
					<span class="sm:hidden">t. libres</span>
				</p>
				<p class="w-28 md:w-36 lg:w-40 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->FTAVG > $match->localTeam_totals()->FTAVG ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->FTA ?: '0' }}/{{ $match->visitorTeam_totals()->FTM ?: '0' }} ({{ number_format($match->visitorTeam_totals()->FTAVG, 0) ?: '0' }}%)
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. contraataque</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. desde la zona</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. 2a oportunidad</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. de suplentes</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->AST > $match->visitorTeam_totals()->AST ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->AST ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">asistencias</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->AST > $match->localTeam_totals()->AST ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->AST ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->ORB > $match->visitorTeam_totals()->ORB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->ORB ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">rebotes ofensivos</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->ORB > $match->localTeam_totals()->ORB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->ORB ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->REB > $match->visitorTeam_totals()->REB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->REB ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">rebotes</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->REB > $match->localTeam_totals()->REB ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->REB ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->STL > $match->visitorTeam_totals()->STL ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->STL ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">robos</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->STL > $match->localTeam_totals()->STL ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->STL ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->BLK > $match->visitorTeam_totals()->BLK ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->BLK ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tapones</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->BLK > $match->localTeam_totals()->BLK ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->BLK ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pérdidas (pts. conseguidos)</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->PF < $match->visitorTeam_totals()->PF ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->PF ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">faltas equipo</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->PF < $match->localTeam_totals()->PF ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->PF ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5">
			<div class="flex items-center">
				<p class="w-10 md:w-12 lg:w-16 text-left md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">mayor ventaja</p>
				<p class="w-10 md:w-12 lg:w-16 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>

	</div>
</div>