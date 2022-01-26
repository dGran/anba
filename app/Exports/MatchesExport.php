<?php

namespace App\Exports;

use App\Models\MatchModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatchesExport implements FromCollection, WithHeadings
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
        return $this->regs ?: MatchModel::all();
    }

    public function headings(): array
    {
        return [
            'id', 'season_id', 'clash_id', 'local_team_id', 'local_manager_id', 'visitor_team_id', 'visitor_manager_id', 'stadium', 'extra_times', 'played', 'teamStats_state', 'playerStats_state'
        ];
    }
}
