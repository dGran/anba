<form>
    <div class="form-row">
        <div class="form-group col-md-6 @error('name') error @enderror">
            <label class="text-sm text-uppercase tracking-wide">Nombre</label>
            <input type="text" class="form-control text-sm" placeholder="Nombre..." wire:model="name">
            @error('name')
                <p class="text-xs pt-1 m-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="text-sm text-uppercase tracking-wide">Estadio</label>
            <input type="text" class="form-control text-sm" placeholder="Estadio" wire:model="stadium">
        </div>
    </div>
</form>