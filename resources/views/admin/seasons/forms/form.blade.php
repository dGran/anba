<div class="form-row">
    <div class="form-group col-md-6 @error('name') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Nombre</label>
        <input type="text" class="form-control text-sm" placeholder="Nombre..." wire:model="name" autofocus="true">
        @error('name')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6 mb-1">
        <label class="text-sm text-uppercase tracking-wide">Direct PlayOffs Start</label>
        <input type="number" class="form-control text-sm" wire:model="direct_playoffs_start">
    </div>
    <div class="form-group col-md-6 mb-1">
        <label class="text-sm text-uppercase tracking-wide">Direct PlayOffs End</label>
        <input type="number" class="form-control text-sm" wire:model="direct_playoffs_end">
    </div>
    <p class="col-md-12 text-sm text-info">Posiciones (desde/hasta) de clasificación directa a Playoffs</p>
</div>

<div class="form-row">
    <div class="form-group col-md-6 mb-1">
        <label class="text-sm text-uppercase tracking-wide">Play-in Start</label>
        <input type="number" class="form-control text-sm" wire:model="play_in_start">
    </div>
    <div class="form-group col-md-6 mb-1">
        <label class="text-sm text-uppercase tracking-wide">Play-in End</label>
        <input type="number" class="form-control text-sm" wire:model="play_in_end">
    </div>
    <p class="col-md-12 text-sm text-info">Posiciones (desde/hasta) de clasificación a Play-in</p>
</div>

<div class="form-row mt-2">
    <div class="form-group col-12">
        <div class="text-xs mr-auto">
            <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
                <input type="checkbox" wire:model="current">
                <div class="state p-primary d-flex align-items-center">
                    <svg class="svg svg-icon" viewBox="0 0 20 20">
                        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                    </svg>
                    <label class="text-xs text-uppercase tracking-widest ml-1" style="">Temporada Activa</label>
                </div>
            </div>
        </div>
    </div>
</div>