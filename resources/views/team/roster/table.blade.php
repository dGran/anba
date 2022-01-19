<table class="w-full">
    @foreach ($players as $player)
        <tr>
            <td>{{ $player->name }}</td>
        </tr>
    @endforeach
</table>
