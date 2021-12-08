<div>
    <h4 class="text-lg font-semibold mb-2.5 | flex items-center justify-between | border-b border-gray-200 dark:border-gray-700 | pb-3">
        <div class="flex items-center">
            <img class="h-10 w-10 rounded-full object-cover transform group-hover:scale-110 group-focus:scale-110 transition duration-150 ease-in-out | mr-1.5" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            <span>{{ auth()->user()->name }} - {{ auth()->user()->team->medium_name }}</span>
        </div>
        <button wire:click="readyToPlaySwitcher({{ auth()->user()->id }})" class="focus:outline-none | hover:underline">
            <i class="fas fa-circle text-sm w-6 text-center {{ auth()->user()->readyToPlay() ? 'text-green-400' : 'text-gray-500' }}"></i><span class="text-xs uppercase">{{ auth()->user()->readyToPlay() ? 'conectado' : 'desconectado' }}</span>
        </button>
    </h4>
</div>
