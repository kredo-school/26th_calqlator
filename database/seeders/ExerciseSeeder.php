<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercise = new Exercise;
        $exercises = [
            ['name'=>'jumproping', 'calories'=>100,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'walking up stairs', 'calories'=>64,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'taking a bath', 'calories'=>19,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'walking (fast)', 'calories'=>50,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'jogging', 'calories'=>90,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'yoga', 'calories'=>32,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'cycling', 'calories'=>75,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'pushups', 'calories'=>49,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'walking', 'calories'=>39,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'running(fast)', 'calories'=>164,'created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'swimming', 'calories'=>75,'created_at'=>now(), 'updated_at'=>now()],
        ];
        $exercise->insert($exercises);
    }
}
