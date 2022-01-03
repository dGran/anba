<div class="px-4 sm:px-0 | flex items-center justify-between">
    <h2 class="flex items-center | font-semibold text-xl md:text-2xl leading-tight">
        <img src="{{ $team->getImg() }}" alt="{{ $team->medium_name }}" class="h-12 md:h-16 w-auto mr-1.5">
        <span class="hidden sm:block">{{ $team->name }}</span>
        <span class="sm:hidden">{{ $team->medium_name }}</span>
    </h2>
    <x-link href="{{ route('teams') }}">Equipos</x-link>
</div>
