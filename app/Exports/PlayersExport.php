<?php

namespace App\Exports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlayersExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $regs;

    public function __construct($regs = null)
    {
        $this->regs = $regs;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->regs ?: Player::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'nickname', 'team_id', 'img', 'position', 'height', 'weight', 'college', 'birthdate', 'nation_name', 'draft_year', 'average', 'retired'
        ];
    }
}
