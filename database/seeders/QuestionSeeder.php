<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::factory()->create([
            'creator_user_id' => 1,
            'title' => "Melyik irodalmi műfajra jellemző a szatíra?",
            'body' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        ]);
        
        Question::factory()->create([
            'creator_user_id' => 2,
            'title' => "Mi a különbség az objektumorientált és a procedurális programozás között?",
            'body' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        ]);


        $question3 = Question::factory()->create([
            'subject_id' => Subject::where('name', 'Fizika')->first()->id,
            'topic_id' => Topic::where('name', 'Elektromosság')->first()->id,
            'creator_user_id' => 3,
            'title' => "Sürgős!!! Milyen hatással van a vezeték átmérőjének változása az áramkörben folyó áram erősségére?",
            'body' => "Éppen dolgozatot írok, szóval gyorsan kéne a válasz",
        ]);

        Comment::factory()->create([
            'creator_user_id' => 2,
            'commentable_id' => $question3->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "A vezeték átmérőjének növekedése növeli az áramkörben folyó áram erősségét. Ennek oka az, hogy a vastagabb vezeték alacsonyabb ellenállással rendelkezik, így a kisebb ellenállás miatt az áram könnyebben áramlik át rajta, és az erőssége is növekszik.",
        ]);

        Comment::factory()->create([
            'creator_user_id' => 3,
            'commentable_id' => $question3->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "Köszi szépen!",
        ]);


        $question4 = Question::factory()->create([
            'subject_id' => Subject::where('name', 'Fizika')->first()->id,
            'topic_id' => Topic::where('name', 'Mechanika')->first()->id,
            'creator_user_id' => 4,
            'title' => "Milyen erőhatások hatnak egy testre, amikor az álló helyzetből elkezd mozogni, és hogyan lehet ezeket a hatásokat számításba venni a test mozgásának leírásához a mechanika szempontjából?",
            'body' => "",
        ]);

        Comment::factory()->create([
            'creator_user_id' => 1,
            'commentable_id' => $question4->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "Ha egy test álló helyzetből elkezd mozogni, akkor rá hat a kinetikus súrlódási erő, ami a mozgási sebességtől és a felületi anyagok közötti súrlódási tényezőtől függ. Emellett hat rá a gravitációs erő is, amely az objektum tömegének és a gravitációs mezőnek a szorzata. Ha a test vízszintes síkon mozog, akkor a vízszintes irányban ható erők egyensúlyban vannak, így a test sebessége állandó lesz. Ha dőlésszögű felületen mozog, akkor a súrlódási erő és a gravitációs erő összetevői hatnak rá, és a test mozgásának leírásához az erők összetevőit kell figyelembe venni a mechanikai számítások során.
 A test mozgásának leírásához a mechanikában a mozgásegyenletet használjuk, amely összekapcsolja a test tömegét, sebességét és a rá ható erőket. A mozgásegyenlet segítségével meghatározható a test mozgásának sebessége és helyzete a mozgás során. A mechanikai számítások során fontos figyelembe venni az erők irányát és nagyságát, valamint az esetleges súrlódási tényezőket is, hogy pontosan leírhassuk a test mozgását.",
        ]);

        Comment::factory()->create([
            'creator_user_id' => 5,
            'commentable_id' => $question4->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "Áh. Azt hiszem értem. Köszi a választ!",
        ]);
    }
}
