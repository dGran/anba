<div class="px-3 sm:px-0 | flex items-center justify-between">
    <h2 class="flex items-center justify-start | font-semibold text-xl md:text-2xl">
        @if ($prior_team)
            <x-link href="{{ route($route, $prior_team) }}">
                <i class="fas fa-chevron-left"></i>
            </x-link>
        @else
            <span>
                <i class="fas fa-chevron-left"></i>
            </span>
        @endif
        <figure class="mx-2">
            <img src="{{ $team->getImg() }}" alt="{{ $team->medium_name }}" class="h-12 md:h-16 w-auto object-cover mx-auto">
        </figure>
        @if ($next_team)
            <x-link href="{{ route($route, $next_team) }}">
                <i class="fas fa-chevron-right"></i>
            </x-link>
        @else
            <span>
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
        <span class="hidden sm:block ml-4">{{ $team->name }}</span>
        <span class="sm:hidden ml-4">{{ $team->medium_name }}</span>
    </h2>
</div>
