<div class="form-row">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Estado</label>
        <p class="m-0 {{ $injury_id > 0 ? 'text-danger' : 'text-success' }}">
            {{ $injury_id > 0 ? 'Lesionado' : 'Disponible' }}
        </p>
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Lesión</label>
        <select class="form-control custom-select text-sm" wire:model="injury_id">
            <option value="">Sin lesión</option>
            @foreach ($injuries as $injury)
                <option value="{{ $injury->id }}">{{ $injury->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row {{ $injury_id == null ? 'd-none' : '' }}">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Partidos</label>
        <input type="number" class="form-control text-sm" min="1" placeholder="Partidos de duración de la lesión" wire:model="injury_matches">
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Días</label>
        <input type="number" class="form-control text-sm" min="1" placeholder="Días de duración de la lesión" wire:model="injury_days">
    </div>
    <div class="form-row mt-2">
        <div class="form-group col-12">
            <div class="text-xs mr-auto">
                <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
                    <input type="checkbox" wire:model="injury_playable">
                    <div class="state p-primary d-flex align-items-center">
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label class="text-xs text-uppercase tracking-widest ml-1" style="">Lesión jugable</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
