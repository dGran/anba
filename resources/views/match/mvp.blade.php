<div class="px-4 py-3">

	<p class="uppercase text-2xl font-bold tracking-wider text-center md:text-left border-b border-gray-150 dark:border-gray-650 pb-2">MVP</p>

	<div class="flex flex-col lg:flex-row items-center mb-3 lg:my-6 items-center">
		@if ($match->mvp())
			<img src="{{ $match->mvp()->player->getImg() }}" alt="{{ $match->mvp()->player->name }}" class="rounded-full border border-gray-200 dark:border-gray-650 object-cover w-20 h-20 md:w-28 md:h-28 lg:w-36 lg:h-36 mt-3 lg:mt-0">
		@endif
		<div class="flex flex-col lg:ml-3 my-2 lg:my-0 text-center lg:text-left">
			<div class="flex flex-col lg:flex-row items-center">
				<div class="flex flex-col lg:mr-3">
					<span class="text-xl font-bold lg:pl-2.5">{{ $match->mvp() ? $match->mvp()->player->name : '-' }}</span>
					<span class="text-sm uppercase lg:pl-2.5">{{ $match->mvp() ? $match->mvp()->player->getPosition() : '' }}</span>
				</div>
				@if ($match->mvp())
					<img src="{{ $match->mvp()->seasonTeam->team->getImg() }}" class="w-12 h-12 mx-auto">
				@endif
			</div>
			<div class="hidden lg:grid grid-cols-3 gap-4 mt-3">
				<div class="flex flex-col items-center">
					<span class="uppercase text-xs pb-1">puntos</span>
					<span class="rounded-full w-12 h-12 border dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
						{{ $match->mvp() ? number_format($match->mvp()->PTS, 0) : '-' }}
					</span>
				</div>
				<div class="flex flex-col items-center">
					<span class="uppercase text-xs pb-1">rebotes</span>
					<span class="rounded-full w-12 h-12 border dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
						{{ $match->mvp() ? number_format($match->mvp()->REB, 0) : '-' }}
					</span>
				</div>
				<div class="flex flex-col items-center">
					<span class="uppercase text-xs pb-1">asistencias</span>
					<span class="rounded-full w-12 h-12 border dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
						{{ $match->mvp() ? number_format($match->mvp()->AST, 0) : '-' }}
					</span>
				</div>
			</div>
		</div>
		<div class="lg:hidden grid grid-cols-3 gap-3">
			<div class="flex flex-col items-center">
				<span class="uppercase text-xs pb-1">puntos</span>
				<span class="rounded-full w-12 h-12 border dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
					{{ $match->mvp() ? number_format($match->mvp()->PTS, 0) : '-' }}
				</span>
			</div>
			<div class="flex flex-col items-center">
				<span class="uppercase text-xs pb-1">rebotes</span>
				<span class="rounded-full w-12 h-12 border dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
					{{ $match->mvp() ? number_format($match->mvp()->REB, 0) : '-' }}
				</span>
			</div>
			<div class="flex flex-col items-center">
				<span class="uppercase text-xs pb-1">asistencias</span>
				<span class="rounded-full w-12 h-12 border dark:border-gray-750 text-sm flex flex-wrap justify-center content-center bg-gray-150 dark:bg-gray-650">
					{{ $match->mvp() ? number_format($match->mvp()->AST, 0) : '-' }}
				</span>
			</div>
		</div>
	</div>

</div>