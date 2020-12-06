<?php

namespace App\Exports;

use App\Models\AdminLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminLogsExport implements FromCollection, WithHeadings
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
        return $this->regs ?: AdminLog::all();
    }

    public function headings(): array
    {
        return [
            'id', 'user_id', 'type', 'table', 'reg_id', 'reg_name', 'detail', 'detail_before'
        ];
    }
}