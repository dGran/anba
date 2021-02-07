<?php

namespace App\Exports;

use App\Models\Season;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeasonsExport implements FromCollection, WithHeadings
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
        return $this->regs ?: Season::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'direct_playoffs_start', 'direct_playoffs_end', 'play_in_start', 'play_in_end', 'current'
        ];
    }
}