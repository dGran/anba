<div class="shadow-md rounded-lg mx-3 md:mx-0">
	<div class="overflow-x-auto bg-white dark:bg-gray-750 rounded-lg p-4">
		<table class="w-full mb-2">
			<tr>
				<td colspan="5">
					<div class="flex items-center mb-6">
						<p class="font-bold uppercase text-xl">{{ $playoff->name }}</p>
					</div>
				</td>
			</tr>
			@foreach ($playoff->rounds as $round)
				<h4>
					{{ $round->name }}
				</h4>
				@foreach ($round->clashes as $clash)
					<tr>
						<td class="border w-48 h-14" style="min-width: 12em; max-width: 12em">
							<div class="flex items-center">
								<img src="{{ $clash->localTeam ? $clash->localTeam->team->getImg() : '' }}" alt="{{ $clash->localTeam ? $clash->localTeam->team->short_name : '' }}" class="w-12 h-12 object-cover m-1">
								<div class="ml-1.5 flex flex-col text-left w-32">
									<p class="text-sm uppercase leading-4">
										{{ $clash->localTeam ? $clash->localTeam->team->medium_name : '' }}
									</p>
									<p class="text-xs">
										{{ $clash->localTeam ? $clash->localTeam->team->user->name : '' }}
									</p>
								</div>
								@if ($clash->localTeam && $clash->visitorTeam)
									<div class="w-8 font-bold text-xl">
										@if ($clash->localResult() == 0 && $clash->visitorResult() == 0)
											-
										@else
											{{ $clash->localResult() }}
										@endif
									</div>
									@foreach ($clash->matches as $match)
										<div class="w-8 text-xs">
											@foreach ($match->scores as $score)
												@if ($clash->local_team_id == $match->local_team_id)
													{{ $score->local_score }}
												@else
													{{ $score->visitor_score }}
												@endif
											@endforeach
										</div>
									@endforeach
								@endif
							</div>

							<div class="flex items-center">
								<img src="{{ $clash->visitorTeam ? $clash->visitorTeam->team->getImg() : '' }}" alt="{{ $clash->visitorTeam ? $clash->visitorTeam->team->short_name : '' }}" class="w-12 h-12 object-cover m-1">
								<div class="ml-1.5 flex flex-col text-left w-32">
									<p class="text-sm uppercase leading-4">
										{{ $clash->visitorTeam ? $clash->visitorTeam->team->medium_name : '' }}
									</p>
									<p class="text-xs">
										{{ $clash->visitorTeam ? $clash->visitorTeam->team->user->name : '' }}
									</p>
								</div>
								@if ($clash->localTeam && $clash->visitorTeam)
									<div class="w-8 font-bold text-xl">
										@if ($clash->localResult() == 0 && $clash->visitorResult() == 0)
											-
										@else
											{{ $clash->visitorResult() }}
										@endif
									</div>
									@foreach ($clash->matches as $match)
										<div class="w-8 text-xs">
											@foreach ($match->scores as $score)
												@if ($clash->visitor_team_id == $match->visitor_team_id)
													{{ $score->visitor_score }}
												@else
													{{ $score->local_score }}
												@endif
											@endforeach
										</div>
									@endforeach
								@endif
							</div>
						</td>
					</tr>
				@endforeach
			@endforeach
		</table>
	</div>
</div>