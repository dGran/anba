<div class="bg-white dark:bg-gray-700 overflow-hidden md:shadow-md md:rounded-b-md md:mx-0 text-gray-900 dark:text-gray-200">
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="flex justify-between p-4 border-b border-gray-200 dark:border-gray-650" wire:loading.class="opacity-50">
                <img src="{{ $post->getImg() }}" alt="{{ $post->getName() }}" class="h-20 w-20 md:h-24 md:w-24 rounded-md shadow-md object-cover">
                <div class="flex-1 flex flex-col ml-5 truncate">
                    <div class="flex items-center justify-between leading-3 md:pb-2">
                        <p class="text-pretty-red uppercase text-xxs md:text-xs font-bold">{{ $post->category }}</p>
                        <span class="text-xxs md:text-xs text-gray-700 dark:text-white">{{ $post->created_at->diffForHumans() }}</span>

                    </div>
                    <h4 class="text-base md:text-xl font-bold leading-4 tracking-tight my-1 md:pb-1 whitespace-pre-line">{{ $post->title }}</h4>
                    <p class="text-sm md:text-base leading-4 tracking-tight whitespace-pre-line">{{ $post->description }}</p>
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