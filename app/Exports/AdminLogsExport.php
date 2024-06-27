<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminLogsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected \Illuminate\Database\Eloquent\Collection $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function collection(): Collection
    {
        return $this->data;
    }

    public function headings(): array
    {
        return ['id', 'user_id', 'type', 'table', 'reg_id', 'reg_name', 'detail', 'detail_before', 'created_at', 'updated_at'];
    }
}
