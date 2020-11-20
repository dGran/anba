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

<div class="form-row">
    <div class="form-group col-md-12 @error('img') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Logo</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input text-sm" id="img" wire:model="img" accept=".jpeg, .png, .jpg, .gif, .svg">
            <label class="custom-file-label" for="img">Seleccionar archivo...</label>
            @error('img')
                <p class="text-xs pt-1 m-0">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>