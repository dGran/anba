<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'super-admin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'guest']);
        $role = Role::create(['name' => 'manager']);

        $user = User::create([
            'name' => 'darthielo',
            'email' => 'darth0@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole('super-admin');

        $user = User::create([
            'name' => 'pAdRoNe',
            'email' => 'dgranh@gmail.com',
            'password' => Hash::make('corleone'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole('admin');

        // for ($i=1; $i < 50; $i++) {
        //     $name = 'user_test_' . $i;
        //     $user = User::create([
        //         'name' => $name,
        //         'email' => $name . '@gmail.com',
        //         'password' => Hash::make('secret'),
        //         'email_verified_at' => now(),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        //     $user->assignRole('guest');
        // }
    }
}
