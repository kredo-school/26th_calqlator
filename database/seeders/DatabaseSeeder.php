<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // $this->call([
        //     food_list::class,
        // ]);
        $this->call(FoodSeeder::class);
        $this->call(ExerciseSeeder::class);
    }
}
