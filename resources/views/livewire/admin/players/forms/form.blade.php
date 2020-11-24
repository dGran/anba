<div class="form-row">
    <div class="form-group col-md-6 @error('name') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Nombre</label>
        <input type="text" class="form-control text-sm" placeholder="Nombre..." wire:model="name">
        @error('name')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Posición</label>
        <select class="form-control custom-select text-sm" wire:model="position">
            <option value="base">Base</option>
            <option value="escolta">Escolta</option>
            <option value="alero">Alero</option>
            <option value="ala-pivot">Ala-Pivot</option>
            <option value="pivot">Pivot</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Altura</label>
        <input type="number" class="form-control text-sm" min="150" max="250" placeholder="Altura (cm)" wire:model="height">
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Peso</label>
        <input type="number" class="form-control text-sm" min="50" max="150" placeholder="Peso (kg)" wire:model="weight">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Nacionalidad</label>
        <input type="text" class="form-control text-sm" placeholder="Nacionalidad" wire:model="nation_name">
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Universidad</label>
        <input type="text" class="form-control text-sm" placeholder="Universidad" wire:model="college">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Fecha de nacimiento</label>
        <input type="date" class="form-control text-sm" placeholder="Fecha de nacimiento" wire:model="birthdate">
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Año draft</label>
        <input type="number" class="form-control text-sm" min="1995" max="2020" placeholder="Año draft" wire:model="draft_year">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12 @error('img') error @enderror"
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <label class="d-sm-flex align-items-center">
            <span class="text-sm text-uppercase tracking-wide">Imagen</span>
            <span class="d-block d-sm-inline-flex ml-auto font-normal text-xs text-muted text-right">.jpeg, .png, .jpg, .gif, .svg / Max: 2048 bytes / Ratio: 1/1</span>
        </label>
        <input type="file" class="form-control-file d-none" id="inputFile" accept=".jpeg, .png, .jpg, .gif, .svg" wire:model="img">
        <div class="preview w-100 rounded" style="border: 1px solid #ced4da; position: relative">
            <button type="button" class="close mr-2 mt-1" aria-label="Close" wire:click="resetImg">
                <span aria-hidden="true">&times;</span>
            </button>
            <figure class="py-3 m-0">
                @if ($reg_img)
                    <img src="{{ $img ? $img->temporaryUrl() : $reg_img_formated }}" class="object-cover rounded d-block m-auto" alt="Imagen de equipo" style="width: auto; height: 120px;">
                @else
                    <img src="{{ $img ? $img->temporaryUrl() : 'http://placehold.it/120x120' }}" class="object-cover rounded d-block m-auto" alt="Imagen de equipo" style="width: auto; height: 120px;">
                @endif
            </figure>
            <div x-show="isUploading" style="position: absolute; bottom: -6px; left: 2px;">
                <progress max="100" x-bind:value="progress" style="height: .9em"></progress>
            </div>
        </div>
        @error('img')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-100 text-center">
        <label for="inputFile" class="btn btn-borderless text-xs text-uppercase tracking-widest" style="font-weight: 400">Cargar imagen</label>
    </div>
</div> {{-- form-row --}}