<ul class="pb-4">
    <li>PENDIENTE</li>
    <li>fijar primera columna</li>
    <li>ordenar por titulo</li>
    <li>adaptar vista</li>
</ul>

<div class="border border-gray-200 dark:border-gray-700 rounded bg-white dark:bg-gray-750">
    <table class="w-full">
        <thead class="border-b border-gray-200 dark:border-gray-700">
            <tr>
                <th class="px-3 py-1.5 text-left font-normal tracking-wider uppercase text-sm">Jugador</th>
                <th class="px-3 py-1.5 text-left font-normal tracking-wider uppercase text-sm">Pos.</th>
                <th class="px-3 py-1.5 text-center font-normal tracking-wider uppercase text-sm">Altura</th>
                <th class="px-3 py-1.5 text-left font-normal tracking-wider uppercase text-sm">Peso</th>
                <th class="px-3 py-1.5 text-left font-normal tracking-wider uppercase text-sm">Edad</th>
                <th class="px-3 py-1.5 text-left font-normal tracking-wider uppercase text-sm">Universidad</th>
                <th class="px-3 py-1.5 text-left font-normal tracking-wider uppercase text-sm">Pais</th>
                <th class="px-3 py-1.5 text-center font-normal tracking-wider uppercase text-sm">Exp.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
                <tr class="border-b border-gray-200 dark:border-gray-700 text-sm md:text-base hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-3 py-1.5 flex items-center space-x-3">
                        <img src="{{ $player->getImg() }}" alt="{{ $player->name }}" class="w-8 h-8 object-cover">
                        <a class="cursor-pointer hover:underline focus:underline focus:outline-none" wire:click="openPlayerInfo({{ $player->id }})">
                            {{ $player->name }}
                        </a>
                    </td>
                    <td class="px-3 py-1.5">
                        {{ $player->getPosition() }}
                    </td>
                    <td class="px-3 py-1.5 text-center">
                        {{ $player->getHeight() }}
                    </td>
                    <td class="px-3 py-1.5">
                        {{ $player->weight }} lbs
                    </td>
                    <td class="px-3 py-1.5">
                        {{ $player->age() }} años
                    </td>
                    <td class="px-3 py-1.5">
                        {{ $player->college }}
                    </td>
                    <td class="px-3 py-1.5">
                        {{ $player->nation_name }}
                    </td>
                    <td class="px-3 py-1.5 text-center">
                        {{ $player->getYearsPro() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div
