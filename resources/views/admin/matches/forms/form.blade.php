<div class="form-row d-flex align-items-end">
    <div class="form-group col-md-5 @error('local_team_id') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Equipo Local</label>
        <select class="form-control custom-select text-sm" wire:model="local_team_id">
            @foreach ($season_teams as $season_team)
                <option value="{{ $season_team->id }}">{{ $season_team->team->medium_name }}</option>
            @endforeach
        </select>
        @error('local_team_id')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group col-md-2 text-center">
        <button type="button" class="btn btn-primary" wire:click="exchangeTeams">
            <i class="fas fa-exchange-alt"></i>
        </button>
    </div>

    <div class="form-group col-md-5 @error('visitor_team_id') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Equipo Visitante</label>
        <select class="form-control custom-select text-sm" wire:model="visitor_team_id">
            @foreach ($season_teams as $season_team)
                <option value="{{ $season_team->id }}">{{ $season_team->team->medium_name }}</option>
            @endforeach
        </select>
        @error('visitor_team_id')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
</div>