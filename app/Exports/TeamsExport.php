<?php

namespace App\Exports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeamsExport implements FromCollection, WithHeadings
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
        return $this->regs ?: Team::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'division_id', 'manager_id', 'medium_name', 'short_name', 'img', 'stadium', 'color', 'active'
        ];
    }
}