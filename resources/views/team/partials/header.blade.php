<div class="px-3 sm:px-0 | flex items-center justify-between">
    <h2 class="flex items-center justify-start | font-semibold text-xl md:text-2xl">
        <x-link>
            <i class="fas fa-chevron-left"></i>
        </x-link>
        <figure class="mx-2">
            <img src="{{ $team->getImg() }}" alt="{{ $team->medium_name }}" class="h-12 md:h-16 w-auto object-cover mx-auto">
        </figure>
        <x-link>
            <i class="fas fa-chevron-right"></i>
        </x-link>
        <span class="ml-4">{{ $team->name }}</span>
    </h2>
</div>
