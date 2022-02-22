<div>
    <style>
        .brandBG::before {
          content: "";
          background-image: url({{ $player->getTeamImg() }});
          background-repeat: no-repeat;
          background-size: 75% 150%;
          position: absolute;
          top: -50%;
          right: 0px;
          bottom: 0px;
          left: 0px;
          opacity: 0.10;
        }
    </style>

    @include('player.header.top')
    @include('player.header.bottom')

    <div class="max-w-7xl mx-auto px-1 sm:px-3 md:px-6 lg:px-8 my-6">
        @include('player.stats.per_game')
        @include('player.stats.totals')
        @include('player.data.more_team_players')
    </div>
</div>
