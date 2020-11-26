<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!User::where('email', $row['email'])->where('name', $row['name'])->exists()) {
            $user = User::create([
               'name'               => $row['name'],
               'email'              => $row['email'],
               'email_verified_at'  => $row['email_verified_at'],
               'created_at'         => $row['created_at'],
               'updated_at'         => $row['updated_at'],
               'password'           => Hash::make('secret'),
            ]);
            return $user;
        }
    }
}
