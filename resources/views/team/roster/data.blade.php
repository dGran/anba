<div class="px-3 py-1.5 mb-3 flex items-center justify-between bg-white dark:bg-gray-750 border-t border-b sm:border sm:rounded border-gray-200 dark:border-gray-700">
    <div class="flex items-center space-x-2">
        <h4 class="tracking-wider font-medium uppercase text-gray-400">Manager: </h4>
        <a href="#" class="hover:underline focus:underline focus:outline-none transition duration-150 ease-in-out">
            {{ $team->user->name }}
        </a>
    </div>
    <div class="flex items-center space-x-2.5">
        <button class="text-2xl | text-blue-500 dark:text-dark-link cursor-pointer | {{ $view == 'table' ? 'opacity-100 pointer-events-none cursor-not-allowed' : 'opacity-50 hover:opacity-75' }} focus:outline-none" wire:click="$set('view', 'table')" title="Tabla">
            <i class="fas fa-table"></i>
        </button>
        <button class="text-2xl | text-blue-500 dark:text-dark-link cursor-pointer | {{ $view == 'card' ? 'opacity-100 pointer-events-none cursor-not-allowed' : 'opacity-50 hover:opacity-75' }} focus:outline-none" wire:click="$set('view', 'card')" title="Card">
            <i class="fas fa-address-card"></i>
        </button>
    </div>
</div>

@if ($view == 'card')
    @include('team.roster.card')
@else
    @include('team.roster.table')
@endif
