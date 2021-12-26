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
            <span class="d-block d-sm-inline-flex ml-auto font-normal text-xs text-muted text-right">.jpeg, .png, .jpg, .gif, .svg / Max: 2048 bytes</span>
        </label>
        <input type="file" class="form-control-file inputFile d-none" id="inputFile" accept=".jpeg, .png, .jpg, .gif, .svg" wire:model="img">
        <div class="preview w-100 rounded position-relative" style="border: 1px solid #ced4da; position: relative">
            <button type="button" class="close" aria-label="Close" wire:click="resetImg" onclick="$('.inputFile').val(null)" style="position: absolute; top:0; right: 6px">
                <span aria-hidden="true">&times;</span>
            </button>
            <label for="inputFile" class="text-xs text-uppercase tracking-widest"
                style="font-weight: 400; position: absolute; top: 3px; left: 6px; cursor: pointer">
                Cargar imagen
            </label>
            <figure class="pt-4 pb-3 m-0">
                @if ($reg_img)
                    <img src="{{ $img ? $img->temporaryUrl() : $reg_img_formated }}" class="object-cover rounded d-block m-auto" alt="Imagen de equipo" style="width: auto; height: 120px; cursor: pointer" onclick="$('#inputFile').trigger('click');">
                @else
                    <img src="{{ $img ? $img->temporaryUrl() : 'http://placehold.it/120x120' }}" class="object-cover rounded d-block m-auto" alt="Imagen de equipo" style="width: auto; height: 120px; cursor: pointer" onclick="$('#inputFile').trigger('click');">
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
</div> {{-- form-row --}}

<div class="form-row">
    <div class="form-group col-md-6 @error('name') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Nombre</label>
        <input type="text" class="form-control text-sm" placeholder="Nombre..." wire:model="name" autofocus="true">
        @error('name')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Apodo</label>
        <input type="text" class="form-control text-sm" placeholder="Apodo..." wire:model="nickname">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Equipo</label>
        <select class="form-control custom-select text-sm" wire:model="team_id">
            <option value="">Agente Libre</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Posición</label>
        <select class="form-control custom-select text-sm" wire:model="position">
            <option value="">N/A</option>
            <option value="pg">Point guard</option>
            <option value="sg">Shooting guard</option>
            <option value="sf">Small forward</option>
            <option value="pf">Power forward</option>
            <option value="c">Center</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Altura</label>
        <input type="number" class="form-control text-sm" min="5" max="8" step="0.1" placeholder="Altura (ft)" wire:model="height">
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Peso</label>
        <input type="number" class="form-control text-sm" min="125" max="500" placeholder="Peso (lbs)" wire:model="weight">
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
        <input type="number" class="form-control text-sm" min="1995" max="{{ $currentYear }}" placeholder="Año draft" wire:model="draft_year">
    </div>
</div>

<div class="form-row mt-2">
    <div class="form-group col-12">
        <div class="text-xs mr-auto">
            <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
                <input type="checkbox" wire:model="retired">
                <div class="state p-primary d-flex align-items-center">
                    <svg class="svg svg-icon" viewBox="0 0 20 20">
                        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                    </svg>
                    <label class="text-xs text-uppercase tracking-widest ml-1" style="">jugador retirado</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-12">
        <div class="text-xs mr-auto">
            <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
                <input type="checkbox" wire:model="outnba" {{ $retired ? 'disabled' : '' }}>
                <div class="state p-primary d-flex align-items-center">
                    <svg class="svg svg-icon" viewBox="0 0 20 20">
                        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                    </svg>
                    <label class="text-xs text-uppercase tracking-widest ml-1" style="">fuera de la NBA</label>
                </div>
            </div>
        </div>
    </div>
</div>
