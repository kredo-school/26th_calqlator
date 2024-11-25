<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class food_list extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()

    {
        DB::table('foods')->insert([
            [
                'name' => 'Banana',
                'calories' => 90;
                'amount' => 100,
                'unit' => 'g',
                'updated_at' => now(),
    ],
    [
        'name' => 'Apple',
        'calories' => 52,
        'amount' => 150,
        'unit' => 'g',
        'updated_at' => now(),
    ],
    [
        'name' => 'Rice',
        'calories' => 130,
        'amount' => 200,
        'unit' => 'g',
        'updated_at' => now(),
    ],
    ]);
    }
}
