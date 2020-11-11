<form>
<div class="form-row">
    <div class="form-group col-md-6 @error('name') error @enderror">
        <label class=" text-sm text-uppercase tracking-wide">Nombre</label>
        <input type="text" class="form-control text-sm" placeholder="Nombre..." wire:model="name">
        @error('name')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group col-md-6 @error('email') error @enderror">
        <label class="text-sm text-uppercase tracking-wide">E-Mail</label>
        <input type="email" class="form-control text-sm" placeholder="Dirección e-mail..." wire:model="email">
        @error('email')
            <p class="text-xs pt-1 m-0">{{ $message }}</p>
        @enderror
    </div>
</div>


@if (!$updateMode)
    <div class="form-row">
        <div class="form-group col-md-6 @error('email') error @enderror">
            <label class=" text-sm text-uppercase tracking-wide">Password</label>
            <input type="password" class="form-control text-sm" placeholder="************" wire:model="password" autocomplete="on">
            @error('password')
                <p class="text-xs pt-1 m-0">{{ $message }}</p>
            @enderror
        </div>
    </div>
@endif

</form>