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
    <div class="form-group col-md-12 @error('img') error @enderror"
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <label class="d-sm-flex align-items-center">
            <span class="text-sm text-uppercase tracking-wide">Logo</span>
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