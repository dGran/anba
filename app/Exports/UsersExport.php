<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $users;

    public function __construct($users = null)
    {
        $this->users = $users;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->users ?: User::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'email', 'email_verified_at', 'profile_photo_path', 'created_at', 'updated_at'
        ];
    }
}