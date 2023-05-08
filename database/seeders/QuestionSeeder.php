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
            'subject_id' => Subject::where('name', 'Irodalom')->first()->id,
            'title' => "Melyik irodalmi műfajra jellemző a szatíra?",
            'body' => ""
        ]);
        
        Question::factory()->create([
            'creator_user_id' => 2,
            'subject_id' => Subject::where('name', 'Informatika')->first()->id,
            'topic_id' => Topic::where('name', 'Programozás')->first()->id,
            'title' => "Mi a különbség az objektumorientált és a procedurális programozás között?",
            'body' => ""
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

    $question5 = Question::factory()->create([
            'creator_user_id' => 3,
            'title' => "Frontend vs Backend",
            'subject_id' => Subject::where('name', 'Fizika')->first()->id,
            'topic_id' => Topic::where('name', 'Mechanika')->first()->id,
            'body' => "Mi a különbség a frontend és a backend fejlesztés között?",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 1,
            'commentable_id' => $question5->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "A frontend fejlesztés az olyan részét jelenti a weblap fejlesztésnek, amely a felhasználó számára látható és interaktív részekkel foglalkozik. Ez magában foglalja az UI/UX tervezést, HTML-t, CSS-t és JavaScriptet. A backend fejlesztés pedig az olyan részét jelenti, amely a háttérben működik és a weblap működését biztosítja. Ez magában foglalja az adatbázis-kezelést, a szerveroldali programozást és az API integrációkat.",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 3,
            'commentable_id' => $question5->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "Köszi szépen, így már tiszta minden.",
        ]);

    $question6 = Question::factory()->create([
            'creator_user_id' => 3,
            'title' => "SEO, webkódolás",
            'subject_id' => Subject::where('name', 'Informatika')->first()->id,
            'topic_id' => Topic::where('name', 'Programozás')->first()->id,
            'body' => "Milyen szerepet játszik az SEO a weblap fejlesztésében?",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 1,
            'commentable_id' => $question6->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "Az SEO (Search Engine Optimization) kulcsfontosságú a weblap fejlesztésében, mivel segít a weboldal magasabb rangsorolásában a keresőmotorokban. Néhány fontos elem:

            Megfelelő kulcsszókutatás és használat a tartalomban
            Jól strukturált és olvasható URL-ek
            Meta címkék és leírások optimalizálása
            Használható linkek és szociális megosztási lehetőségek",
        ]);

    $question7 = Question::factory()->create([
            'creator_user_id' => 3,
            'title' => "Derivált",
            'subject_id' => Subject::where('name', 'Matematika')->first()->id,
            'body' => "Mi a derivált és hogyan számolható ki?",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 4,
            'commentable_id' => $question7->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "A derivált a függvény változásának mértékét mutatja a bemeneti változóhoz képest. A derivált kiszámítása az alábbi lépésekből áll: válasszunk ki egy pontot a függvényen, közelítsük a pontot egy másik ponthoz, majd számítsuk ki a két pont közötti meredekséget. Ez a közelítő meredekség az adott pontban a derivált.",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 2,
            'commentable_id' => $question7->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "Áhhh, gyorsabbak voltak nálam! :D",
        ]);
    $question8 = Question::factory()->create([
            'creator_user_id' => 3,
            'title' => "Matek, valószínűség",
            'subject_id' => Subject::where('name', 'Matematika')->first()->id,
            'body' => "Mi a valószínűség fogalma és hogyan számítható ki?",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 1,
            'commentable_id' => $question8->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "A valószínűség a valamilyen esemény bekövetkezésének mértéke. Matematikailag a valószínűség az esemény kedvező kimenetelének a lehetőséges kimenetek számához viszonyított aránya. A valószínűség kiszámítása a kedvező kimenetek számát és a lehetséges kimenetek számát osztva egymással.",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 3,
            'commentable_id' => $question8->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "Köszi, szerintem sikerült megérteni",
        ]);
    $question9 = Question::factory()->create([
            'creator_user_id' => 3,
            'title' => "Lineáris egyenletek",
            'subject_id' => Subject::where('name', 'Matematika')->first()->id,
            'body' => "Mi a lineáris egyenlet és hogyan oldható meg?",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 2,
            'commentable_id' => $question9->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "A lineáris egyenlet egy olyan matematikai egyenlet, amelyben a ismeretlenek lineárisan vannak összekapcsolva. Az egyenlet általában a következő formában írható: ax + b = 0, ahol az 'a' és 'b' konstansok, 'x' pedig az ismeretlen. A lineáris egyenletet meg lehet oldani a következő lépésekkel: isoláljuk az 'x'-et az egyenlet bal oldalára, majd osszuk el az együtthatóval 'a', hogy megtaláljuk az ismeretlen értékét.",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 3,
            'commentable_id' => $question9->id,
            'commentable_type' => 'App\Models\Question',
            'message' => "Köszi",
        ]);
    }
}
