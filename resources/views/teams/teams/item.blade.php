<div class="flex items-center border-b md:border-none border-gray-200 dark:border-gray-700 | -mx-4 md:mx-0 px-4 md:px-0 py-2">
    <img src="{{ $team->getImg() }}" alt="{{ $team->medium_name }}" class="w-12 h-12 md:w-14 md:h-14 object-cover">
    <div class="flex flex-col ml-3">
        <a href="{{ route('team', [$team->slug]) }}" class="font-semibold text-base md:text-lg hover:underline focus:underline">{{ $team->name }}</a>
        <a href="#" class="text-sm text-gray-500 dark:text-gray-400 hover:underline focus:underline"><strong>Manager: </strong>{{ $team->user->name }}</a>
    </div>
</div>
