<?php

namespace App\Exports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlayersExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $players;

    public function __construct($players = null)
    {
        $this->players = $players;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->players ?: Player::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'team_id', 'img', 'position', 'height', 'weight', 'college', 'birthdate', 'nation_name', 'draft_year', 'average', 'retired'
        ];
    }
}