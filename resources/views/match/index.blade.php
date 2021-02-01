<div>
	<!-- Page Content -->
	<div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8">
		@include('match.header')

<!-- Button trigger modal -->
<button type="button" class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-blue-600" data-toggle="modal" data-target="#exampleModalTwo">
  Launch modal two
</button>

<!-- Modal -->
<div class="modal hidden fixed top-0 left-0 w-full h-full outline-none fade" id="exampleModalTwo" tabindex="-1" role="dialog">
  <div class="modal-dialog relative w-auto pointer-events-none max-w-lg my-8 mx-auto px-4 sm:px-0" role="document">
    <div class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg">
      <div class="flex items-start justify-between p-4 border-b border-gray-300 rounded-t">
        <h5 class="mb-0 text-lg leading-normal">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="relative flex p-4">
        ...
      </div>
      <div class="flex items-center justify-end p-4 border-t border-gray-300">
        <button type="button" class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-gray-600 mr-2" data-dismiss="modal">Close</button>
        <button type="button" class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-blue-600">Save changes</button>
      </div>
    </div>
  </div>
</div>

		<div class="mb-8">
			@if (!$match->played())
				@include('match.reports')
				@include('match.players_info')
				@include('match.last_matches')
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0">
						@include('match.last_clashes')
					</div>
					<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0">
						@include('match.forecasts')
					</div>
				</div>
			@endif

			@if ($match->played())
				@include('match.match_info')
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
					<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0">
						@include('match.mvp')
					</div>
					<div class="bg-white dark:bg-gray-750 border border-gray-150 dark:border-transparent shadow-md rounded mx-3 md:mx-0">
						@include('match.game_tops')
					</div>
				</div>
				@include('match.boxscore')
			@endif
		</div>
	</div>
</div>