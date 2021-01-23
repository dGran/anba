<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScoreHeader;

class ScoreHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scoreHeader = ScoreHeader::create([
            'name' => 'Total',
            'active' => 1,
            'order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
