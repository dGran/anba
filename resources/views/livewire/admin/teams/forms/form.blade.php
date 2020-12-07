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
</div>

<div class="form-row">
    <div class="form-group col-md-6 @error('medium_name') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Nombre medio</label>
        <input type="text" class="form-control text-sm" placeholder="Nombre medio...(Bulls)" wire:model="medium_name">
        @error('medium_name')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group col-md-6 @error('short_name') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Nombre corto</label>
        <input type="text" class="form-control text-sm" maxlength="3" placeholder="Nombre corto...(CHI)" wire:model="short_name">
        @error('short_name')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Manager</label>
        <select class="form-control custom-select text-sm" wire:model="manager_id">
            <option value="">N/D</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">División</label>
        <select class="form-control custom-select text-sm" wire:model="division_id">
            <option value="">N/D</option>
            @foreach ($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Estadio</label>
        <input type="text" class="form-control text-sm" placeholder="Estadio..." wire:model="stadium">
    </div>
    <div class="form-group col-md-6">
        <label class="text-sm text-uppercase tracking-wide">Color</label>
        <input type="color" class="form-control text-sm" min="125" max="500" placeholder="Color" wire:model="color">
    </div>
</div>

<div class="form-row mt-2">
    <div class="form-group col-12">
        <div class="text-xs mr-auto">
            <div class="pretty p-svg p-curve m-0 p-jelly p-has-focus">
                <input type="checkbox" wire:model="active">
                <div class="state p-primary d-flex align-items-center">
                    <svg class="svg svg-icon" viewBox="0 0 20 20">
                        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                    </svg>
                    <label class="text-xs text-uppercase tracking-widest ml-1" style="">Activo</label>
                </div>
            </div>
        </div>
    </div>
</div>