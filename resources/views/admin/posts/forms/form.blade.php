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
                    <img src="{{ $img ? $img->temporaryUrl() : $reg_img_formated }}" class="object-cover rounded d-block m-auto" alt="Imagen de la noticia" style="width: auto; height: 120px; cursor: pointer" onclick="$('#inputFile').trigger('click');">
                @else
                    <img src="{{ $img ? $img->temporaryUrl() : 'http://placehold.it/120x120' }}" class="object-cover rounded d-block m-auto" alt="Imagen de la noticia" style="width: auto; height: 120px; cursor: pointer" onclick="$('#inputFile').trigger('click');">
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
    <div class="form-group col-md-6 @error('type') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Tipo</label>
        <select class="form-control custom-select text-sm" wire:model="type">
            <option value="">N/D</option>
            <option value="general">General</option>
            <option value="resultados">Resultados</option>
            <option value="records">Records</option>
            <option value="rachas">Rachas</option>
            <option value="lesiones">Lesiones</option>
            <option value="movimientos">Movimientos</option>
            <option value="destacados">Destacados</option>
            <option value="declaraciones">Declaraciones</option>
        </select>
        @error('type')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group col-md-6 @error('category') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Categoría</label>
        <input type="text" class="form-control text-sm" placeholder="Categoría..." wire:model="category" autofocus="true">
        @error('category')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12 @error('title') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Título</label>
        <input type="text" class="form-control text-sm" placeholder="Título..." wire:model="title">
        @error('title')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12 @error('description') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">Descripción</label>
        <input type="text" class="form-control text-sm" placeholder="Descripción..." wire:model="description">
        @error('description')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
</div>