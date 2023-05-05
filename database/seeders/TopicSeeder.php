<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Történelem
        Topic::factory()->create([
            'subject_id' => 1,
            'name' => "1. világháború",
        ]);
        Topic::factory()->create([
            'subject_id' => 1,
            'name' => "2. világháború",
        ]);
        Topic::factory()->create([
            'subject_id' => 1,
            'name' => "Középkor",
        ]);
        Topic::factory()->create([
            'subject_id' => 1,
            'name' => "Római Birodalom",
        ]);
        Topic::factory()->create([
            'subject_id' => 1,
            'name' => "Ókor",
        ]);
        Topic::factory()->create([
            'subject_id' => 1,
            'name' => "Újkor",
        ]);

        // Matematika
        Topic::factory()->create([
            'subject_id' => 2,
            'name' => "Geometria",
        ]);
        Topic::factory()->create([
            'subject_id' => 2,
            'name' => "Analízis",
        ]);
        Topic::factory()->create([
            'subject_id' => 2,
            'name' => "Kombinatorika",
        ]);
        Topic::factory()->create([
            'subject_id' => 2,
            'name' => "Algebra",
        ]);
        Topic::factory()->create([
            'subject_id' => 2,
            'name' => "Számítástechnika",
        ]);

        // Fizika
        Topic::factory()->create([
            'subject_id' => 3,
            'name' => "Mechanika",
        ]);
        Topic::factory()->create([
            'subject_id' => 3,
            'name' => "Elektromosság",
        ]);
        Topic::factory()->create([
            'subject_id' => 3,
            'name' => "Hőtan",
        ]);
        Topic::factory()->create([
            'subject_id' => 3,
            'name' => "Optika",
        ]);
        Topic::factory()->create([
            'subject_id' => 3,
            'name' => "Atomfizika",
        ]);

        
        // Biológia
        Topic::factory()->create([
            'subject_id' => 4,
            'name' => "Sejtek",
        ]);
        Topic::factory()->create([
            'subject_id' => 4,
            'name' => "Állatok",
        ]);
        Topic::factory()->create([
            'subject_id' => 4,
            'name' => "Növények",
        ]);

        // Informatika
        Topic::factory()->create([
            'subject_id' => 5,
            'name' => "Programozás",
        ]);
        Topic::factory()->create([
            'subject_id' => 5,
            'name' => "Algoritmusok",
        ]);
        Topic::factory()->create([
            'subject_id' => 5,
            'name' => "Adatbázisok",
        ]);
        Topic::factory()->create([
            'subject_id' => 5,
            'name' => "Hálózatok",
        ]);

        // Angol
        Topic::factory()->create([
            'subject_id' => 6,
            'name' => "Grammar",
        ]);
        Topic::factory()->create([
            'subject_id' => 6,
            'name' => "Vocabulary",
        ]);
        Topic::factory()->create([
            'subject_id' => 6,
            'name' => "Reading",
        ]);

        // Nyelvtan
        Topic::factory()->create([
            'subject_id' => 7,
            'name' => "Szóalakok",
        ]);
        Topic::factory()->create([
            'subject_id' => 7,
            'name' => "Szófajok",
        ]);
        Topic::factory()->create([
            'subject_id' => 7,
            'name' => "Szótagok",
        ]);
        Topic::factory()->create([
            'subject_id' => 7,
            'name' => "Szótagrendszerek",
        ]);

        // Irodalom
        Topic::factory()->create([
            'subject_id' => 8,
            'name' => "Költészet",
        ]);
        Topic::factory()->create([
            'subject_id' => 8,
            'name' => "Próza",
        ]);
        Topic::factory()->create([
            'subject_id' => 8,
            'name' => "Színház",
        ]);
        Topic::factory()->create([
            'subject_id' => 8,
            'name' => "Realizmus",
        ]);
        Topic::factory()->create([
            'subject_id' => 8,
            'name' => "Kortárs",
        ]);
    }
}
