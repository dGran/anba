<div class="px-3 py-4 border-bottom">
	<h4 class="text-uppercase tracking-widest text-sm text-muted pb-2">
		opciones de tabla
	</h4>
    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs">
        <input type="checkbox" class="mousetrap"
        wire:model="showTableImages">
        <div class="state p-primary">
            <svg class="svg svg-icon" viewBox="0 0 20 20">
                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
            </svg>
            <label class="text-uppercase tracking-widest ml-1">Mostrar imágenes</label>
        </div>
    </div>
    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs">
        <input type="checkbox" class="mousetrap" wire:model="fixedFirstColumn">
        <div class="state p-primary">
            <svg class="svg svg-icon" viewBox="0 0 20 20">
                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
            </svg>
            <label class="text-uppercase tracking-widest ml-1">Fijar primera columna</label>
        </div>
    </div>
</div>


<div class="px-3 py-4 border-bottom">
	<h4 class="text-uppercase tracking-widest text-sm text-muted pb-2">
		columnas
	</h4>
    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs">
        <input type="checkbox" class="mousetrap"
        wire:model="showTableImages">
        <div class="state p-primary">
            <svg class="svg svg-icon" viewBox="0 0 20 20">
                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
            </svg>
            <label class="text-uppercase tracking-widest ml-1">Equipo</label>
        </div>
    </div>
    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs">
        <input type="checkbox" class="mousetrap" wire:model="fixedFirstColumn">
        <div class="state p-primary">
            <svg class="svg svg-icon" viewBox="0 0 20 20">
                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
            </svg>
            <label class="text-uppercase tracking-widest ml-1">Fijar primera columna</label>
        </div>
    </div>
</div>

<div class="px-3 py-4 border-bottom text-xs">
	<h4 class="text-uppercase tracking-widest text-sm text-muted pb-2 d-flex align-items-center">
	    <i class='bx bx-command mr-2'></i>Shortcuts
	</h4>

	<div>
		<span class="d-block text-xs mb-1">Buscar</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em">/</div>
	</div>

	<div class="mt-3">
		<span class="d-block text-xs mb-1">Página anterior</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em"><i class='bx bx-chevron-left'></i></div>
	</div>

	<div class="mt-3">
		<span class="d-block text-xs mb-1">Página siguiente</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em"><i class='bx bx-chevron-right'></i></div>
	</div>

	<div class="mt-3">
		<span class="d-block text-xs mb-1">Nuevo registro</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em">ctrl</div>
		<span class="px-1">+</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em">shift</div>
		<span class="px-1">+</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em">a</div>
	</div>

	<div class="mt-3">
		<span class="d-block text-xs mb-1">Eliminar registros seleccionados</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em">ctrl</div>
		<span class="px-1">+</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em">shift</div>
		<span class="px-1">+</span>
		<div class="d-inline-block border rounded shadow-sm bg-light text-gray-600 text-center text-xxs" style="min-width: 30px; min-height: 22px; line-height: 2.5em">d</div>
	</div>
</div>
