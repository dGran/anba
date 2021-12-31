<ul class="px-3 sm:px-0 flex items-center space-x-4 md:space-x-6 | select-none | mb-6 md:mb-8 | md:text-lg | overflow-x-auto">
    <li class="border-b transition duration-150 ease-in-out {{ $op == 'roster' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link' }}" wire:click="changeOp('roster')">
        <span>Roster</span>
    </li>
    <li class="border-b transition duration-150 ease-in-out {{ $op == 'leaders' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link' }}" wire:click="changeOp('leaders')">
        Leaders
    </li>
    <li class="border-b transition duration-150 ease-in-out {{ $op == 'team_stats' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link' }}" wire:click="changeOp('team_stats')">
        Team Stats
    </li>
    <li class="border-b transition duration-150 ease-in-out {{ $op == 'player_stats' ? 'border-blue-500 dark:border-dark-link | pointer-events-none' : 'border-transparent cursor-pointer hover:border-blue-500 dark:hover:border-dark-link' }}" wire:click="changeOp('player_stats')">
        Player Stats
    </li>
</ul>
