<div class="form-row">
    <div class="form-group col-md-6 @error('local_team_id') error @enderror"">
        <label class="text-sm text-uppercase tracking-wide">Equipo Local</label>
        <select class="form-control custom-select text-sm" wire:model="local_team_id">
            <option value="">Ninguno</option>
            @foreach ($season_teams as $season_team)
                <option value="{{ $season_team->id }}">{{ $season_team->team->name }}</option>
            @endforeach
        </select>
        @error('local_team_id')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group col-md-6 @error('visitor_team_id') error @enderror"">
        <label class="text-sm text-uppercase tracking-wide">Equipo Visitante</label>
        <select class="form-control custom-select text-sm" wire:model="visitor_team_id">
            <option value="">Ninguno</option>
            @foreach ($season_teams as $season_team)
                <option value="{{ $season_team->id }}">{{ $season_team->team->name }}</option>
            @endforeach
        </select>
        @error('visitor_team_id')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
</div>