<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-b-md md:mx-0 text-gray-900 dark:text-gray-200">
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="flex justify-between p-4 border-b border-gray-200 dark:border-gray-650" wire:loading.class="opacity-50">

                @if ($post->type == "resultados" && $post->match)
                    <figure class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md p-1 dark:bg-gray-750 border border-gray-200 dark:border-gray-650 relative" {{-- style="border-color: {{ $post->match->winner()->team->color }};" --}}>
                        <img src="{{ $post->match->visitorTeam->team->getImg() }}" alt="{{ $post->getName() }}" class="absolute bottom-0 right-0 m-0.5 w-14 h-14 md:w-16 md:h-16 object-cover">
                        <img src="{{ $post->match->localTeam->team->getImg() }}" alt="{{ $post->getName() }}" class="absolute top-0 left-0 m-0.5 w-14 h-14 md:w-16 md:h-16 object-cover">
                    </figure>
                @elseif ($post->type == "lesiones" && $post->team)
                    <figure class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md p-0.5 border border-gray-200 dark:border-gray-650 relative" style="{{ $post->team ? 'background-color: ' . $post->team->color : '' }}">
                        <img src="{{ $post->getImg() }}" alt="{{ $post->getName() }}" class="h-full w-auto rounded-md object-cover mx-auto">
                        <img src="{{ $post->team->getImg() }}" alt="{{ $post->team->getName() }}" class="absolute top-0 left-0 -m-0.5 w-7 h-7 md:w-8 md:h-8 object-cover">
                    </figure>
                @else
                    <figure class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md p-0.5 dark:bg-gray-750 border border-gray-200 dark:border-gray-650 relative">
                        <img src="{{ $post->getImg() }}" alt="{{ $post->getName() }}" class="h-full w-auto rounded-md object-cover mx-auto">
                    </figure>
                @endif

                <div class="flex-1 flex flex-col ml-5 truncate">
                    <div class="flex items-center justify-between leading-3 pb-1 md:pb-2">
                        <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">{{ $post->category }}</p>
                        <span class="text-xxs md:text-xs text-gray-700 dark:text-white">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    @if ($post->match_id)
                        <a href="{{ route('match', $post->match_id) }}" class="text-base md:text-xl font-bold leading-4 my-1 md:pb-1 whitespace-pre-line underline focus:outline-none">{{ $post->title }}</a>
                    @else
                        <h4 class="text-base md:text-xl font-bold leading-4 my-1 md:pb-1 whitespace-pre-line">{{ $post->title }}</h4>
                    @endif
                    <p class="text-sm md:text-base leading-4 whitespace-pre-line">{{ $post->description }}</p>
                </div>
            </div>
        @endforeach
    @else
        <div class="flex flex-col px-4 py-6 border-b border-gray-200 dark:border-gray-650">
            <span class="text-2xl font-bold">Ops!</span>
            No se han encontrado noticias
        </div>
    @endif
</div>