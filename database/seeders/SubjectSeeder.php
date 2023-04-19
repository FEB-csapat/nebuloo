<?php

namespace Database\Seeders;

use App\Models\Subject;

use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::factory()->create([
            'name' => "Történelem",
        ]);
        Subject::factory()->create([
            'name' => "Matematika",
        ]);
        Subject::factory()->create([
            'name' => "Fizika",
        ]);
        Subject::factory()->create([
            'name' => "Kémia",
        ]);
        Subject::factory()->create([
            'name' => "Biológia",
        ]);
        Subject::factory()->create([
            'name' => "Földrajz",
        ]);
        Subject::factory()->create([
            'name' => "Informatika",
        ]);
        Subject::factory()->create([
            'name' => "Angol",
        ]);
        Subject::factory()->create([
            'name' => "Nyelvtan",
        ]);
        Subject::factory()->create([
            'name' => "Irodalom",
        ]);
    }
}
