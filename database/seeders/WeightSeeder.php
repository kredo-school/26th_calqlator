<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Weight;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Weight::factory()->count(90)->create();
    }
}
