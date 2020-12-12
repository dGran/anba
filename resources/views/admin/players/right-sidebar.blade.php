<div class="mb-5 pb-2 non-selectable">
	<div class="px-3 py-4 border-bottom">
		<h4 class="text-uppercase tracking-widest text-sm text-muted pb-2 d-flex align-items-center">
			<i class='bx bx-table mr-2 text-base'></i>opciones de tabla
		</h4>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="striped" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Colores alternos de filas</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="fixedFirstColumn" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Fijar primera columna</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="showTableImages" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Mostrar imágenes</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="showNicknames" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Mostrar apodos</label>
	        </div>
	    </div>
	</div>

	<div class="px-3 py-4 border-bottom">
		<h4 class="text-uppercase tracking-widest text-sm text-muted pb-2 d-flex align-items-center">
			<i class='bx bx-columns mr-2 text-base'></i>columnas
		</h4>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="colTeam" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Equipo</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="colPosition" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Posición</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="colNation" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Nacionalidad</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="colAge" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Edad</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="colHeight" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Altura</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="colWeight" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Peso</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="colDraftYear" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Año Draft</label>
	        </div>
	    </div>
	    <div class="pretty p-svg p-curve m-0 p-smooth p-has-focus text-xs d-block mb-2">
	        <input type="checkbox" class="mousetrap" wire:model="colCollege" wire:change="setSessionPreferences">
	        <div class="state p-primary">
	            <svg class="svg svg-icon" viewBox="0 0 20 20">
	                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
	            </svg>
	            <label class="text-uppercase tracking-widest ml-1">Universidad</label>
	        </div>
	    </div>
	</div>

	@include('admin.partials.right-sidebar')
</div>