<?php

namespace App\Exports;

use App\Models\AdminLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserIpLogsExport implements FromCollection, WithHeadings
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
            'id', 'user_id', 'ip', 'date_last_login', 'counter', 'user_name'
        ];
    }
}
