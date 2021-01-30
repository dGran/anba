<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 my-6">
	<div class="px-4 py-3">

		{{-- <p class="uppercase text-sm font-bold tracking-wider pb-3">informe del partido</p> --}}
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localScore() > $match->visitorScore() ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localScore() }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">puntos</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorScore() > $match->localScore() ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorScore() }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tiros de campo</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">triples</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tiros libres</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. contraataque</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. desde la zona</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. 2a oportunidad</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pts. de suplentes</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->AST > $match->visitorTeam_totals()->AST ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->AST ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">asistencias</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->AST > $match->localTeam_totals()->AST ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->AST ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">rebotes ofensivos</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">rebotes defensivos</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->STL > $match->visitorTeam_totals()->STL ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->STL ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">robos</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->STL > $match->localTeam_totals()->STL ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->STL ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold {{ $match->localTeam_totals()->BLK > $match->visitorTeam_totals()->BLK ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->localTeam_totals()->BLK ?: '0' }}
				</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tapones</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold {{ $match->visitorTeam_totals()->BLK > $match->localTeam_totals()->BLK ? 'text-black dark:text-yellow-400' : 'text-gray-500 dark:text-gray-300' }}">
					{{ $match->visitorTeam_totals()->BLK ?: '0' }}
				</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">pérdidas (pts. conseguidos)</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">faltas equipo</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">mates</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5 border-b border-gray-150 dark:border-gray-650">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">mayor ventaja</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>
		<div class="flex flex-col py-0.5 md:py-1.5">
			<div class="flex items-center">
				<p class="flex-1 md:pl-3 text-sm md:text-base lg:text-xl font-bold">-</p>
				<p class="flex-1 text-center px-3 uppercase font-bold text-sm md:text-base lg:text-xl text-gray-500 dark:text-gray-300">tiempo posesión</p>
				<p class="flex-1 text-right md:pr-3 text-sm md:text-base lg:text-xl font-bold">-</p>
			</div>
		</div>

	</div>
</div>