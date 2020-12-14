@if ($regView)
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="boxscoreModal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="background: #F9FAFB; position: relative; overflow: hidden;">
                    <h5 class="modal-title text-base text-uppercase font-medium tracking-wide my-2 pb-3">
                        <span>{{ $regView->getName() }}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAnyModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="local">
                            {{-- <div class="text-right d-inline-block">{{ $regView->localTeam->team->short_name }}</div> --}}
                            <img src="{{ $regView->localTeam->team->getImg() }}" alt="{{ $regView->localTeam->team->short_name }}" style="width: 72px; height: 72px" class="ml-1">
                        </div>
                        <div class="result mx-2 text-center font-weight-bold text-xl">
                            <div class="d-inline-block text-right" style="min-width: 32px">
                                {{ $scores->sum('local_score') }}
                            </div>
                            <div class="d-inline-block">-</div>
                            <div class="d-inline-block text-left" style="min-width: 32px">
                                {{ $scores->sum('visitor_score') }}
                            </div>
                        </div>
                        <div class="visitor">
                            {{-- <div class="text-right d-inline-block">{{ $regView->visitorTeam->team->short_name }}</div> --}}
                            <img src="{{ $regView->visitorTeam->team->getImg() }}" alt="{{ $regView->visitorTeam->team->short_name }}" style="width: 72px; height: 72px" class="mr-1">
                        </div>
                    </div>

                    <form wire:submit.prevent="storeResult" enctype="multipart/form-data">
                        <div class="form-row d-flex align-items-end justify-content-center py-3">
                            @foreach ($scores as $key => $score)
                                <div class="form-group col-2">
                                    <label>{{ $score['seasons_scores_headers_name'] }}</label>
                                    <input type="number" min="0" class="form-control numericInput px-2" placeholder="0" wire:model="scores.{{ $key }}.local_score">
                                    <input type="number" min="0" class="mt-2 form-control numericInput px-2" placeholder="0" wire:model="scores.{{ $key }}.visitor_score">
                                </div>
                            @endforeach
                        </div>

                        <h5>
                            Estadísticas de jugadores
                        </h5>
                        <span>
                            {{ $regView->localTeam->team->name }}
                        </span>
                        <ul>
                            @foreach ($regView->localTeam->team->players as $player)
                                <li>{{ $player->name }}</li>
                            @endforeach
                        </ul>
                        <span>
                            {{ $regView->visitorTeam->team->name }}
                        </span>
                        <ul>
                            @foreach ($regView->visitorTeam->team->players as $player)
                                <li>{{ $player->name }}</li>
                            @endforeach
                        </ul>

                        <button type="submit" {{-- data-dismiss="modal" --}}>Save</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endif