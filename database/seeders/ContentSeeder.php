<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Comment;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Content::factory()->create([
            'creator_user_id' => 1,
            'subject_id' => Subject::where('name', 'Biológia')->first()->id,
            'topic_id' => Topic::where('name', 'Sejtek')->first()->id,
            'body' => "# A Vérsejtek

![sejtek](https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/SEM_blood_cells.jpg/230px-SEM_blood_cells.jpg)

A vérsejtek a vérben található sejtek, amelyek fontos szerepet játszanak a testünkben, többek között az oxigén és a tápanyagok szállításában, valamint az immunrendszer működésében. A vérsejteknek három fő típusa van: vörösvérsejtek, fehérvérsejtek és vérlemezkék.

-----

### Vörösvérsejtek (eritrociták)

A vörösvérsejtek, más néven eritrociták, a leggyakoribb vérsejtek a vérben. Fő feladatuk az **oxigén szállítása a test szöveteihez**. A vörösvérsejtek a hemoglobin nevű fehérjét tartalmazzák, amelyhez az oxigén kötődik és a tüdőből a test többi részébe szállítják. Az eritrociták kialakulása a csontvelőben történik.

-----

### Fehérvérsejtek (leukociták)

A fehérvérsejtek, más néven leukociták, az immunrendszer részét képezik. Fő feladatuk a **fertőzések és betegségek elleni védelem**, az idegen anyagok (például baktériumok és vírusok) felismerése és eltávolítása a szervezetből. A fehérvérsejtek száma és típusa változó, és számos különböző típusuk van, amelyek különböző funkciókat látnak el.

-----

### Vérlemezkék (trombociták)

A vérlemezkék, más néven trombociták, fontos szerepet játszanak a véralvadásban. A vérlemezkék száma növekszik, amikor a test sérült, és azok felismerik a sérülést, majd összetapadnak és képeznek egy vérrögöt, amely segít megállítani a vérzést. A vérlemezkék a csontvelőben képződnek.

-----

Összefoglalva, a vérsejtek kulcsfontosságú szerepet játszanak a testünk normális működésében. A vörösvérsejtek az oxigén szállításában játszanak fontos szerepet, míg a fehérvérsejtek az immunrendszerünk fontos részét képezik és védik a testünket a fertőzésektől és betegségektől. A vérlemezkék a véralvadásban játszanak szerepet. A megfelelő mennyiségű és típusú vérsejtek megléte fontos a test egészségének fenntartásához. Az eltérő mennyiség vagy típusú vérsejtek számos betegség és állapot tünete lehet, például a vashiányos vérszegénység, leukémia vagy véralvadási rendellenességek.",
        ]);

        Content::factory()->create([
            'creator_user_id' => 1,
            'subject_id' => Subject::where('name', 'Irodalom')->first()->id,
            'topic_id' => Topic::where('name', 'Realizmus')->first()->id,
            'body' => '# Az Orosz realizmus

Az orosz realizmus a 19. századi orosz irodalom egyik legjelentősebb irányzata volt. Az orosz realizmus különösen fontos volt az orosz irodalom fejlődésében, és számos jelentős íróval rendelkezett, mint például Puskin, Gogol, Tolsztoj és Dosztojevszkij. Az orosz realizmus az orosz társadalom, kultúra és történelem ábrázolására összpontosított, és számos fontos témát érintett, mint például a paraszti élet, a korrupció, az élet értelme, az egyén szerepe a társadalomban és az orosz történelem fontos eseményei.
            
### Puskin
![Puskin](https://upload.wikimedia.org/wikipedia/commons/5/56/Kiprensky_Pushkin.jpg)
Az orosz realizmus kezdeteit Puskin határozta meg. Ő volt az első, aki az orosz irodalomban az orosz nép életét és hagyományait ábrázolta, és az első olyan író, aki az orosz nyelvet széles körben használta az irodalomban. Puskin az orosz realizmus egyik legfontosabb alakja, művei az orosz irodalom alapvető részét képezik.

### Gogol
![Gogol](https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/N.Gogol_by_A.Ivanov_%281841%2C_Russian_museum%29.jpg/800px-N.Gogol_by_A.Ivanov_%281841%2C_Russian_museum%29.jpg)
Nyikolaj Vasziljevics Gogol a realizmus egyik legfontosabb írója volt. Művei általában a paraszti életet és a korrupt tisztségviselőket ábrázolják, és általában kritikusan tekintenek a társadalomra. Gogol különösen fontos az orosz irodalom fejlődése szempontjából, mivel ő volt az első, aki az orosz nyelvet használta a szépirodalomban. Az orosz realizmusban Gogol alkotásai közül kiemelkedik a "Holt lelkek" című regénye, amely az orosz irodalom egyik legnagyobb műve.

### Tolsztoj
![Tolsztoj](https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/L.N.Tolstoy_Prokudin-Gorsky.jpg/1200px-L.N.Tolstoy_Prokudin-Gorsky.jpg)
Lev Nyikolajevics Tolsztoj a realizmus egyik legjelentősebb írója volt, és élete során számos fontos művet írt. Tolsztoj művei az egyén és a társadalom viszonyát, a szegénységet, a háborút és az élet értelmét vizsgálják. Az orosz realizmusban Tolsztoj kiemelkedő művei közé tartoznak a "Háború és béke" és az "Anna Karenina". Az orosz irodalom egyik legjelentősebb alakja volt, és munkássága az egész világon hatással volt az irodalomra.

### Dosztojevszkij
![Dosztojevszkij](https://upload.wikimedia.org/wikipedia/commons/3/3c/Dostoevsky_1872.jpg)
Fjodor Mihajlovics Dosztojevszkij az orosz realizmus egyik legnagyobb alakja volt, és munkássága az orosz irodalom történetének legjelentősebb alkotásai közé tartozik. Dosztojevszkij művei a lelki állapotokat, az erkölcsi dilemmákat, a bűntudatot és a megbocsátást járják körül. Munkássága erőteljesen befolyásolta az orosz irodalmat, és nagy hatással volt az egész világirodalomra.

Dosztojevszkij műveiben gyakran az ártatlanok szenvedése és a bűnösök megbánása áll a középpontban. Az egyik legismertebb műve a "Bűn és bűnhődés", amely az orosz irodalom egyik legnagyobb műve és az egész világirodalom egyik legfontosabb regénye. Dosztojevszkij másik nagy hatású műve a "Karamazov testvérek", amelyben az egyén és a társadalom viszonya áll a középpontban.

Dosztojevszkij munkássága az orosz irodalom történetében egyedülálló, és még ma is inspiráló hatással van az olvasókra és a követő írókra. Dosztojevszkij nagy jelentőséggel bír az orosz realizmusban, mivel művei általában az emberi szenvedélyeket és a lelki problémákat elemzik, és a társadalom problémáit is kritikusan vizsgálják.',
        ]);


        Content::factory()->create([
            'creator_user_id' => 2,
            'subject_id' => Subject::where('name', 'Angol')->first()->id,
            'topic_id' => Topic::where('name', 'Grammar')->first()->id,
            'body' => '# Present continuous
Az angol nyelv egyik alapvető időtartamú (tense) az úgynevezett "present continuous" idő, amely a jelen időt fejezi ki és folyamatban lévő cselekvésekre utal. Ezt az időtartamút általában jelen folyamatosnak vagy jelen folyamatban lévőnek is nevezik.
            
Az angol nyelvben a present continuous időt a "to be" segédigével és a főige -ing végződéssel történő együttállításával alakítjuk ki. Például: "I am writing" (írok), "She is reading a book" (olvas egy könyvet).
            
A present continuous idő a jelenben folyamatban lévő tevékenységeket fejezi ki, és általában olyan kifejezésekkel kezdődik, mint például: "I am currently...", "She is currently...", "They are currently..." stb.

Ezen időtartamú használható egyéni és többes szám harmadik személyben is, és az "am", "is" vagy "are" segédigékkel kell kifejezni. Az ige -ing végződése mindig a főige mögött áll.

A present continuous időt az alábbi esetekben használhatjuk:

* Folyamatban lévő cselekvések kifejezése:
    Példa: "I am currently studying for my exam."

* Jövő idő kifejezése előre megtervezett tevékenységekre:
    Példa: "We are leaving for vacation tomorrow."

* Ideiglenes tevékenységek kifejezése:
    Példa: "She is currently working at a coffee shop, but she plans to quit soon."

* Időszakos tevékenységek kifejezése:
    Példa: "We are usually having lunch together on Mondays."

Folyamatban lévő változások kifejezése:
    Példa: "The weather is getting colder and colder every day."

Fontos megjegyezni, hogy a present continuous időnek nincs jövőbeli használata, csak akkor használjuk, ha egy előre megtervezett tevékenységet kifejezünk.

A present continuous idő az angol nyelv egyik legfontosabb időtartamú, és gyakran használják az angol beszélők mindennapi beszédben. Ha szeretnénk jól kommunikálni angolul, akkor érdemes gyakorolni ezt az időtartamút, és megtanulni használni a megfelelő helyzetekben.',
        ]);



        $content1 = Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Fizika')->first()->id,
            'topic_id' => Topic::where('name', 'Atomfizika')->first()->id,
            'body' => '# Bevezető
Az atomfizika az anyag felépítésének és viselkedésének megértésével foglalkozik. Az atomok az anyag alapvető építőkövei, amelyeket a kémiai reakciók és az elektromos erők hatására kombinálnak. Az atomfizika tanulmányozza az atomok felépítését, tulajdonságait és viselkedését, valamint az atommagokat és a radioaktivitást.

### Az atomok felépítése
Az atomok felépítése egy kicsi, pozitív töltésű atommagból és az azt körülvevő negatív töltésű elektronfelhőből áll. Az atommagot pozitív töltésű protonok és semleges tömegű neutronok alkotják. Az elektronok körülveszik az atommagot és negatív töltésűek. Az elektronok számától függ, hogy milyen elemről van szó. Például az oxigénnek 8 elektronja van az atomjában, míg a hidrogénnek csak 1.

### Az atomok viselkedése
Az atomok viselkedése különböző tényezőktől függ, például a hőmérséklettől és a nyomástól. Az atomok összeütközhetnek, és ekkor kinetikus energia szabadul fel. Az atomok kémiai reakcióba léphetnek, amikor elektronokat cserélnek vagy kötést alkotnak más atomokkal. Az atommagok szintén kölcsönhatásba léphetnek, amikor az erős nukleáris erő hatására új atommagok keletkeznek.

### Az atommagok és a radioaktivitás
Az atommagokat protonok és neutronok alkotják, és a protonok száma határozza meg, hogy milyen elemről van szó. Az atommag instabil lehet, és ilyenkor a radioaktív bomlás során átalakul más elemmé vagy egy másik izotóppá. A radioaktív bomlás során radioaktív sugárzás szabadul fel, amely károsíthatja az élő szervezeteket. A radioaktív anyagokat azért használják, mert a sugárzásuk hasznos lehet az orvoslásban és az iparban.

Az atomok és az atommagok megértése segíthet a tudósoknak a környezet védelme, az orvoslás és az ipar fejlesztése, valamint az energiatermelés hatékonyabbá tétele területén.'
        ]);
        Comment::factory()->create([
            'creator_user_id' => 2,
            'commentable_id' => $content1->id,
            'commentable_type' => 'App\Models\Content',
            'message' => "Végre valamennyire átlátom, hogy miről van szó! Hasznos lecke, köszönöm szépen! :)",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 4,
            'commentable_id' => $content1->id,
            'commentable_type' => 'App\Models\Content',
            'message' => "Szépen össze van foglalva, ment az upvote!",
        ]);

        $content2 = Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Informatika')->first()->id,
            'topic_id' => Topic::where('name', 'Hálózatok')->first()->id,
            'body' => '# IPv6 Címzés
Az IPv6 (Internet Protocol version 6) az internetes protokoll új generációja, amely lehetővé teszi az internet címzési rendszerének bővítését és a hálózati eszközök számának növelését. Az IPv6-os címek 128 bitesek, szemben az IPv4-es címek 32 bites változatával, ami azt jelenti, hogy sokkal nagyobb számú egyedi címet lehet velük létrehozni. Az IPv6-os címek előnye, hogy több egyedi címet biztosítanak, és ezáltal a hálózati eszközök nagyobb száma csatlakozhat az internethez.

## Az IPv6-os címek szerkezete
Az IPv6-os címeket 8 blokkra osztják, és ezeket kettősponttal választják el egymástól. Például: 2001:0db8:85a3:0000:0000:8a2e:0370:7334. A blokkok 16 bitesek, és a blokkokat 4 számjegyre csoportosítják. Ha az egyik blokk értéke nulla, akkor azt rövidített alakban "::"-tel jelölik. Ez a jelölés egyszerűsíti az IPv6-os címek írását és olvasását.

## Az IPv6-os címek típusai
Az IPv6-os címek többféle típusba sorolhatók. Az egyik típus az ún. unicast cím, amelyet egyetlen eszköz használ az adatátvitelre. A másik típus a multicast cím, amelyet több eszköz használhat az adatátvitelre. A multicast címek lehetővé teszik az adatok hatékonyabb és gyorsabb továbbítását a hálózaton. A harmadik típus a broadcast cím, amelyet minden eszköz használ az adatátvitelre. Az IPv6-os címek további típusai közé tartoznak a loopback címek, az anycast címek és a link-local címek.

## Az IPv6-os címek használata
Az IPv6-os címeket a hálózati eszközök egyedi azonosítására használják az interneten. Az IPv6-os címet a hálózati eszközök operációs rendszere automatikusan generálja vagy az internetes szolgáltató biztosítja. Az IPv6-os címek használatának előnye, hogy lehetővé teszik a nagyobb eszközszámú hálózatok létrehozását és a hatékonyabb adatátvitelt. Az IPv6-os címek használata azonban nem teljesen elterjedt még az interneten, és az IPv4-es címeket továbbra is használják a legtöbb esetben'
        ]);
        Comment::factory()->create([
            'creator_user_id' => 4,
            'commentable_id' => $content2->id,
            'commentable_type' => 'App\Models\Content',
            'message' => "Miért nem inkább ezzel kezdték annó? Sokkal jobb lenne, hogy ha most nem kéne az átállással vacakolni...",
        ]);


        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Matematika')->first()->id,
            'topic_id' => Topic::where('name', 'Kombinatorika')->first()->id,
            'body' => '## Bevezető a valószínűség számításba
A valószínűség számítása egy matematikai terület, amely arra szolgál, hogy meghatározza az események bekövetkezésének valószínűségét. Ez a terület fontos szerepet játszik a matematikában, az informatikában, a pénzügyekben, a fizikában és sok más területen.

A valószínűség fogalmát gyakran használják a statisztikában, ahol az adatok elemzése során hasznos információkat nyújtanak. A valószínűség alapvetően azt jelenti, hogy mekkora eséllyel fordul elő egy esemény a lehetséges események közül. Ez azt jelenti, hogy ha van egy bizonyos számú lehetőségünk arra, hogy egy adott esemény bekövetkezzen, akkor a valószínűség az, hogy az esemény ténylegesen bekövetkezik.

A valószínűség számítása matematikailag összetett, és sok esetben számítási módszerek, például a kombinatorika és a valószínűségi számítások alkalmazása szükséges. A valószínűségszámítás során fontos megérteni a valószínűségi eloszlásokat és azok tulajdonságait, valamint a valószínűség számításának számos módszerét.

Az alapvető valószínűségi fogalmak és számítási módszerek megértése segíthet abban, hogy jobban megértsük a valószínűségi eseményeket és ezáltal javíthassuk a döntéshozatali folyamatainkat.'
        ]);

        $content3 = Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Történelem')->first()->id,
            'topic_id' => Topic::where('name', '2. világháború')->first()->id,
            'body' => '# Sztálingrádi csata

![](https://upload.wikimedia.org/wikipedia/commons/5/52/Bundesarchiv_Bild_183-P0613-308%2C_Russland%2C_Kesselschlacht_Stalingrad.jpg)

*Szovjet katonák Sztálingrádban (1943)*  

A Sztálingrádi csata a második világháború egyik legnagyobb és legvéresebb ütközete volt, amely a náci Németország és a Szovjetunió között zajlott. A csata során a két hadsereg több mint öt hónapig harcolt egymással, és a szovjetek végül győztek. A Sztálingrádi csata stratégiai fontosságú volt a háború kimenetele szempontjából, és jelentős hatást gyakorolt a további harcok menetére.
## A Sztálingrádi csata előzményei
A második világháborúban a németek 1941-ben indítottak támadást a Szovjetunió ellen, és a következő évben előrenyomultak a Don folyó völgyébe. A Sztálingrád városát átszelő Volga folyó keresztezése a németek számára stratégiai fontosságú volt, mert az ellenséges erők egy részét vissza tudták volna tartani a Volga túloldalán, és így könnyebben haladhattak volna az orosz területen.

## A Sztálingrádi csata menete
A Sztálingrádi csata 1942 nyarán kezdődött, amikor a németek támadást indítottak a város ellen. A csata azonban gyorsan elakadt, mert a szovjetek keményen ellenálltak és felkészültek a védelemre. A városban zajló harcoktól a lakosság súlyosan megszenvedett, és több ezer ember vesztette életét. A csata során mindkét oldal számára óriási veszteségek voltak, és a németek nem tudták elfoglalni a várost.

A csata során a szovjeteknek sikerült visszavonulniuk a Don folyó túloldalára, majd támadást indítaniuk a németek ellen. A szovjet erők fokozatosan visszavették a kezdeményezést, és lassan haladtak előre. A csata legvéresebb szakaszai november és december között zajlottak, amikor a szovjetek előrenyomultak a városban, és végül sikerült elfoglalniuk a teljes területet.

## A Sztálingrádi csata következményei
A Sztálingrádi csata stratégiai fontosságú volt a háború kimenetele szempontjából, mert megakadályozta a németek előrenyomulását a Szovjetunió területén. A csata után a szovjetek fokozatosan előnybe kerültek a háborúban, és a németek előretörésének megakadályozása miatt elvesztették a lehetőséget, hogy kiterjesszék területi uralmukat a szovjetek fölött. A Sztálingrádi csata után a szovjetek elkezdtek áttérni a támadó hadviselésre, és a kezdeményezés visszavételével fokozatosan visszaverték a német erőket. A csata szimbolikus jelentőséggel is bír, hiszen az egész világ számára világossá vált, hogy a Szovjetunió nem lesz könnyen legyőzhető, és hogy a háború végkimenetele még nem eldöntött. A Sztálingrádi csata a második világháború egyik legnagyobb tragédiája volt, és azóta is emlékezetes eseményként él a történelemkönyvekben.'
        ]);
        Comment::factory()->create([
            'creator_user_id' => 2,
            'commentable_id' => $content3->id,
            'commentable_type' => 'App\Models\Content',
            'message' => "Az biztos, hogy ha ez a csata máshogy alakul, akkor az egész háború kimenetele megváltozott volna...",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 1,
            'commentable_id' => $content3->id,
            'commentable_type' => 'App\Models\Content',
            'message' => "Abban biztos lehetsz!",
        ]);

        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Történelem')->first()->id,
            'topic_id' => Topic::where('name', '2. világháború')->first()->id,
            'body' => '# A Maginot-vonal
A Maginot-vonal egy híres, de sikertelen védelmi vonal, amelyet a francia hadsereg épített a német hadsereg ellen az első világháború során. A vonalat azért építették, hogy megakadályozzák a németek előretörését Franciaországban.

A vonal építése 1915-ben kezdődött, és az első vonal az Ardennes erdőkön átvezetett és kiterjedt a Vosges-hegységig. A második vonal a belső területeken helyezkedett el, és azzal a céllal építették, hogy megakadályozzák a német hadsereg további előretörését, ha sikerült áttörni az első vonalat.

Azonban a vonal építése hosszú és költséges volt, és a német hadseregnek sikerült áttörnie a vonalat a Verdun-nál 1916 februárjában. A Verdun-i csata a legnagyobb és legsúlyosabb csata volt az első világháborúban, és nagyon nagy veszteségeket okozott mindkét oldalon.

A Maginot-vonal építése nem bizonyult hatékonynak, mert a német hadsereg már ekkor fejlett technikával rendelkezett, amely lehetővé tette számukra, hogy áttörjék a vonalat. A vonal nem volt eléggé erős ahhoz, hogy megállítsa a modern katonai technológiák előretörését.

![Maginot-vonal](https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/CarteLigneMaginot.png/300px-CarteLigneMaginot.png)

Ennek ellenére a Maginot-vonal fontos tanulságot jelentett a hadviselés történetében. Az építése arra kényszerítette a német hadsereget, hogy több erőforrást és időt fordítson az áttörésre, ami csökkentette az előnyüket a háborúban. Ezenkívül a vonal építése és a Verdun-i csata azért is fontos volt, mert az első világháborúban a hadviselés jelentősen megváltozott, és egyre inkább a modern technológia felhasználására és az ipari erőforrásokra támaszkodott.

Összességében a Maginot-vonal bár sikertelen volt, fontos szerepet játszott az első világháborúban, és számos tanulságot nyújtott a hadviselésre vonatkozóan a jövő generációi számára.'
        ]);


        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Történelem')->first()->id,
            'topic_id' => Topic::where('name', '1. világháború')->first()->id,
            'body' => '# Trianon
![Trianon](https://dailynewshungary.com/wp-content/uploads/2016/06/trianon.jpg)
A trianoni békeszerződés az első világháború után létrejött békeszerződés, amelyet 1920-ban írtak alá a győztes szövetséges hatalmak és a legyőzött Magyarország között. A szerződés Magyarországot és az Osztrák-Magyar Monarchiát érintette, és a világháborút lezáró béketárgyalások keretében jött létre.

## A trianoni békeszerződés előzményei
Az első világháborút követően a győztes szövetséges hatalmak összegyűltek, hogy megvitassák a békeszerződés feltételeit. A béketárgyalások során Magyarország kénytelen volt elfogadni az ország területének jelentős csökkentését, a hadsereg korlátozását és az ország gazdasági önállóságának megszüntetését.
            
## A trianoni békeszerződés tartalma
A trianoni békeszerződés értelmében Magyarország elveszítette területének nagy részét, és csak az ország jelenlegi határai maradtak meg. Az ország területének mintegy 72%-a elcsatolásra került, és az ország kisebbségi területeire számos új állam jött létre, mint például Csehszlovákia, Románia és Jugoszlávia.

Az ország gazdasági önállóságának megszüntetése értelmében Magyarország elvesztette a korábbi gazdasági előnyeit is, és az ország gazdasági helyzete jelentősen romlott. A trianoni békeszerződés következtében Magyarország elveszítette a hadseregét, és csupán 35 000 főt tartottak fenn a hadseregben.

## A trianoni békeszerződés következményei
A trianoni békeszerződés jelentős hatást gyakorolt Magyarországra és az ország történelmére. Az ország elvesztette a korábbi területi és gazdasági előnyeit, és a gazdaság helyzete hosszú ideig nehéz helyzetben volt. Az országban élő kisebbségek számos problémával szembesültek, és az ország egész lakosságát érintette a trianoni békeszerződés következményeinek nehézsége.

A trianoni békeszerződés azonban nem csak Magyarországot érintette, hanem az egész régiót is. A békeszerződés következtében új államok jöttek létre,amelyek között az etnikai, gazdasági és politikai problémák folyamatosan jelen voltak. A trianoni békeszerződés jelentőségét nehéz túlbecsülni, hiszen az ország történelmének egyik legtragikusabb eseménye volt, és az ország sorsát hosszú időre meghatározta. A trianoni békeszerződés napjára azóta is emlékeznek, és az ország újrarendezésének nehéz korszaka egy olyan emlékezetes pillanatává vált, amely az ország történelmében mindig megmarad.'
        ]);

        $content4 = Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Angol')->first()->id,
            'topic_id' => Topic::where('name', 'Grammar')->first()->id,
            'body' => '# Present Simple
A Present Simple időt az angol nyelvben használjuk olyan esetekben, amikor rendszerességet vagy állandó állapotot fejezünk ki. Ez az időforma meglehetősen egyszerű, és alapvetően három fő részből áll: az állító, a tagadó és a kérdő mondatokból.

1. Állító mondatok:
    Az állító mondatokban a Present Simple időt a következőképpen alkalmazzuk:
-   Általános igazságok vagy állandó tények kifejezésére:
    Példa: Az eső esik. - The rain falls.

-   Rendszeres tevékenységek leírására:
    Példa: Minden reggel futok. - I run every morning.

-   Időbeosztási rend szerinti események kifejezésére:
    Példa: Az előadás délután 3-kor kezdődik. - The lecture starts at 3 p.m.

-   Szokások, preferenciák vagy vélemények kifejezésére:
    Példa: Szeretem az almát. - I like apples.

A Present Simple idő az alany személyének és számának megfelelően igazodik. Az állító mondatokban az alany után következik az ige alakja. A harmadik személyben (egyes szám harmadik személyben) az ige végéhez -s vagy -es ragot kap. Példa: He watches TV every evening.

2. Tagadó mondatok:
    A tagadó mondatokat a következőképpen alkalmazzuk a Present Simple időben:

-   Állítás tagadása: egyszerűen hozzáadunk egy "do not" (rövidítve "dont") segédigét az állító mondatokhoz.
    Példa: Nem szeretem a hagymát. - I don t like onions.

-   Harmadik személy tagadása: az does not (rövidítve doesn t) segédige használata.
    Példa: Ő nem dolgozik itt. - He doesn t work here.

A segédigéket az alany elé helyezzük, majd az ige alakja marad változatlan.

3. Kérdő mondatok:
    A kérdő mondatokban a Present Simple időt a következőképpen alkalmazzuk:

-   Általános kérdések: a "do" segédigét helyezzük az alany elé.
    Példa: Szereted a zenét? - Do you like music?

-   Harmadik személy kérdése: az "does" segédigét használjuk.
    Példa: Dolgozik ő itt? - Does he work here?

Az ige alakja változatlan

Az állító, tagadó és kérdő mondatok mellett érdemes megemlíteni néhány fontos részletet a Present Simple idő használatával kapcsolatban:

- Állandóan ismétlődő események kifejezése: A Present Simple idővel rendszeresen ismétlődő tevékenységeket vagy rutinszerű eseményeket is kifejezhetünk. Példa: Mindig megreggelizem. - I always have breakfast.

- Időhatározók használata: Az időhatározók segítségével pontosíthatjuk, hogy milyen gyakorisággal történik egy adott cselekvés. Példa: Néha olvasok könyvet. - I sometimes read books.

- Általános igazságok: A Present Simple időt használhatjuk általános igazságok kifejezésére. Példa: A Nap keleten kel. - The sun rises in the east.

- Állandó jellegű tulajdonságok: A Present Simple idővel kifejezhetjük az állandó jellegű tulajdonságokat, melyek az adott személyre vagy dologra jellemzőek. Példa: Ő egy tehetséges festő. - He is a talented painter.

- Időbeosztási rendszerű események: A Present Simple idővel kifejezhetjük olyan eseményeket, amelyek meghatározott időpontban vagy rendszeresen következnek be. Példa: A vonat mindig 8-kor érkezik. - The train always arrives at 8 o clock.

- Állítások valóságtartalma: Fontos megjegyezni, hogy a Present Simple idő a jelenre vonatkozik, és általában olyan állításokat fejez ki, amelyeknek hosszú távon is igaznak kell lenniük. Példa: A Föld a Nap körül forog. - The Earth revolves around the sun.

Fontos gyakorolni a Present Simple idő használatát különböző kontextusokban és példamondatokban, hogy megerősítsük és elmélyítsük az időforma helyes alkalmazását.'
        ]);
        Comment::factory()->create([
            'creator_user_id' => 4,
            'commentable_id' => $content4->id,
            'commentable_type' => 'App\Models\Content',
            'message' => "Sokkal jobban elmagyaráztad mint az angol tanárom, ezek után lehet megmerek majd szólalni az angol órákon.",
        ]);

        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Fizika')->first()->id,
            'topic_id' => Topic::where('name', 'Hőtan')->first()->id,
            'body' => '# Hőtan alapjai

## Bevezetés

A hőtan a fizikai tudományág, amely az anyagok hőmozgásával és hőenergiával foglalkozik. A hőtan segít megérteni, hogyan terjed a hő és hogyan változik az anyag hőmérséklete különböző körülmények között.

## Hő és hőenergia

- A **hő** az energia átadásának folyamata az anyagok között, amely a részecskék mozgásának eredményeként történik. 

- A **hőenergia** az anyagokban tárolódó energia, amely az anyag részecskéinek mozgásával és rendezetlenségével kapcsolatos.

## Hőmérséklet

- A **hőmérséklet** az anyag részecskéinek átlagos mozgási energiájának mértéke. A hőmérsékletet általában Celsius vagy Kelvin skálán mérjük.

- A hőmérséklet két test közötti különbség határozza meg, hogy melyik testből melyik felé áramlik a hőenergia.

## Hőterjedési módok

A hőterjedésnek három fő módja van:

1. **Kondukció**: A kondukció során a hő a részecskék közvetlen ütközése révén terjed az anyagban.

2. **Konvekció**: A konvekció során a hőmozgás áramlással történik, általában gázok vagy folyadékok között.

3. **Sugárzás**: A sugárzás során a hőenergia elektromágneses hullámok formájában terjed.

## Hőkapacitás és hőmennyiség

- A **hőkapacitás** egy anyag tulajdonsága, amely jellemzi, hogy mekkora hőmennyiség szükséges ahhoz, hogy az anyag hőmérséklete adott értékkell emelkedjen.

- A **hőmennyiség** pedig a hőenergia mennyiségét jelenti, amely átadódik vagy elnyelődik egy anyagban.

## Összefoglalás

A hőtan alapjainak megértése kulcsfontosságú ahhoz, hogy jobban megismerjük az anyagok hőmozgását és a hőenergia terjedését. A hő, hőmérséklet, hőterjedési módok, hőkapacitás és hőmennyiség alapvető fogalmait megismerve felkészültebben állhatunk szemben a hőtan további részleteivel és alkalmazásaival.'
        ]);

        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Történelem')->first()->id,
            'topic_id' => Topic::where('name', 'Római Birodalom')->first()->id,
            'body' => '# A Római Birodalom

## Bevezetés

A Római Birodalom az ókori Róma által létrehozott hatalmas birodalom volt. Ez a birodalom egész Európára, részben Ázsiára és Észak-Afrikára is kiterjedt. A Római Birodalom meghatározó szerepet játszott a történelem során politikailag, gazdaságilag, kulturálisan és katonailag.

## Kialakulás és Terjeszkedés

![Romulust és Remust szoptató farkas](https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/Capitoline_she-wolf_Musei_Capitolini_MC1181.jpg/300px-Capitoline_she-wolf_Musei_Capitolini_MC1181.jpg)

- A Római Birodalom alapjait a legendák szerint Romulus és Remus, Róma alapítói fektették le i. e. 753-ban. A birodalom az idők során terjeszkedett és hatalmas területeket foglalt el.

- A Római Birodalom terjeszkedése során olyan területeket vontak ellenőrzésük alá, mint Gallia (Franciaország), Britannia (Egyesült Királyság), Hispania (Spanyolország) és Egyiptom, valamint jelentős részeket Délkelet-Ázsiából.

## Politikai Szervezet és Kormányzás

- A Római Birodalom politikai szervezete összetett volt. Kezdetben a Római Királyság formájában működött, majd i. e. 509-től köztársasági rendszer alakult ki. Később Augustus császárságával i. e. 27-ben kezdődött a császárság kora, és a Római Birodalom a hatalmi központot egészen Konstantinápolyig áthelyezte.

- A birodalom területén a császár volt a legfelsőbb hatalom, és egy összetett adminisztrációs rendszerrel kormányozta a birodalmat. A birodalom katonai ereje, jogrendszere és infrastruktúrája nagyban hozzájárult a birodalom stabilitásához és hatalmához.

## Gazdaság és Élet Róma Városában

- A Római Birodalom gazdasága rendkívül fejlett volt. Az agrártermelés, az ipar és a kereskedelem mind kulcsfontosságú szerepet játszottak a birodalom gazdasági sikereiben.

- Róma városa központi szerepet játszott az életben. Hatalmas épületek, fórumok, fürdők és amfiteátrumok voltak jelen. A birodalom különböző részeiből származó emberek hoztak létre egy sokszínű és gazdag kulturális életet Rómában.

## Hódítás és Kulturális Hatás

- A Római Birodalom terjeszkedése jelentős kulturális hatást gyakorolt az elfoglalt területekre. A római kultúra, nyelv és jogrendszer elterjedt az egész birodalomban.

- A birodalom építészete, irodalma és művészete kiemelkedő volt, és a korabeli civilizáció egyik legjelentősebb kulturális központja volt.

## Válság és Bukás

- A Római Birodalom a 3. századtól kezdve belső válságokkal, gazdasági problémákkal és barbár inváziókkal szembesült. A birodalom kezdett gyengülni, és végül 476-ban a nyugati Római Birodalom hivatalosan is megszűnt.

- Azonban az elsőszámú birodalom keleti része, azaz a Keleti Római (Bizánci) Birodalom még évszázadokig fennmaradt.

## Összegzés

A Római Birodalom rendkívül fontos és befolyásos civilizáció volt az ókorban. Gazdag történelemmel, kulturális örökséggel és politikai rendszerrel rendelkezett. A birodalom katonai ereje és hatalma sokáig meghatározta Európa és a középkori világ eseményeit. A Római Birodalom hagyatéka továbbra is jelen van a modern kultúrában és jogrendszerben.'
        ]);

        $content5 = Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Matematika')->first()->id,
            'topic_id' => Topic::where('name', 'Analízis')->first()->id,
            'body' => '# Az Analízis Alapjai

## Bevezetés

Az analízis a matematika egy ága, amely a folytonos változókat és azok tulajdonságait tanulmányozza. Az analízis alapvetően két területre osztható: differenciálszámításra és integrálszámításra. Ezen túlmenően foglalkozik a határértékekkel, sorozatokkal, függvényekkel és sok más alapvető fogalommal.

## Differenciálszámítás

A differenciálszámítás az analízis egyik fő része, amely a függvények változását tanulmányozza. Ennek a területnek az alapját a határértékek képezik. A határérték lehetővé teszi, hogy meghatározzuk, hogyan változik egy függvény értéke, amikor a bemenet közelít egy adott pontban. A derivált segítségével kiszámíthatjuk a függvények meredekségét és változását egy adott pontban.

## Integrálszámítás

Az integrálszámítás a másik fő része az analízisnek. Az integrál segítségével meghatározhatjuk egy függvény területét vagy összegzhetjük annak értékeit egy adott tartományon belül. Az integrál alapvetően az antiderivált fogalmán alapul. Az integrálszámítás lehetővé teszi számunkra, hogy meghatározzuk a függvények területét, a görbék alatti területeket, a tömegközéppontokat és számos más fontos matematikai mennyiséget.

## Alkalmazások

Az analízis számos területen hasznos és alkalmazható. Például a fizikában az analízis segít megérteni az anyagok mozgását és változásait. Az ökonómiában és a pénzügyekben az analízis segít az optimalizálásban és a döntéshozatalban. Az építészetben és a mérnöki tervezésben az analízis segít a szerkezetek stabilitásának és terhelhetőségének elemzésében.

## Összegzés

Az analízis az egyik legfontosabb ága a matematikának, amely mélyrehatóan tanulmányozza a függvények tulajdonságait, változásait és területeit. A differenciálszámítás és az integrálszámítás kulcsfontosságú eszközöket nyújtanak a függvények meredekségének, változásának, területének és összegzésének megértéséhez. Az analízis széles körben alkalmazható a természettudományoktól az alkalmazott tudományokig, és kulcsfontosságú szerepet játszik a tudományos kutatásban és az ipari alkalmazásokban.'
        ]);
        Comment::factory()->create([
            'creator_user_id' => 4,
            'commentable_id' => $content5->id,
            'commentable_type' => 'App\Models\Content',
            'message' => "Hát az igazat megvallva még mindig nem teljesen értem, de határozottan messzebbre jutottam ezzel, mint a matek órákkal :D",
        ]);

    }
}