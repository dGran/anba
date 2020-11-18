<?php

namespace App\Exports;

use App\Models\Teams;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeamsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $teams;

    public function __construct($teams = null)
    {
        $this->teams = $teams;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->teams ?: User::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'img', 'stadium', 'created_at', 'updated_at'
        ];
    }
}