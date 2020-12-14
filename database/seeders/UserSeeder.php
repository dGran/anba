<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'pAdRoNe',
            'email' => 'dgranh@gmail.com',
            'password' => Hash::make('corleone'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Carlos',
            'email' => 'carlos@gmail.com',
            'password' => Hash::make('secret'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i=1; $i < 50; $i++) {
            $name = 'user_test_' . $i;
            DB::table('users')->insert([
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
