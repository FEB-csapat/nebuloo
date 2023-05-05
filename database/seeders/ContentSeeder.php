<?php

namespace Database\Seeders;

use App\Models\Content;
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
            'body' => "# Onus illa victore ocior
## De quodque et 
Lorem markdownum easdem a [Procnen](http://www.moriorque.io/precesque) namque
abruptaque [alto](http://www.patettandem.org/tenebris-thymo.html): erat huius
disparibus properabat demens cupido orbae, est primo quicquam. Priamusque omnis
mea litora auras tangentiaque siste; Siphnon sed Phlegon vocet Phrygia cvrrvs
dubitor. Hoc corpora! Induta furiosaque et Stygia temptanti ulli multaque,
feroces condicione spicea inattenuata intravit coniuge auget me Pelasgos raptam
possit. Regina et fugias lubrica poterat.

![cica](https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pepita.hu%2Fimages%2Fproduct%2F340212%2Fpamut-torolkozo-cica-feher_30833634_1200x630.jpg&f=1&nofb=1&ipt=43d51356b1d145d31e7a464085e3b61ea34b586ffdd4a50eae23a3b0a58dd15d&ipo=images)

## Nec infelix est

Liceat iussisque quaeritur factum, aurum emicat arma aquarum esse: comas hic
nubibus si Achivos. Et dubiae placet. Nigrantis petuntur de diluvio novis
cuncta, fuit!

- Utentem domos in
- Dumque erit ubi agitatis natam
- Canum Xanthos patetis et sacroque alipedum in
- Frustra dies sit rarus
- Vera invecta triumphis coeunt

## Lactantia tui Phoce profatur victima
            
**Movit** dolos vultus? Illam *dedit* missae di soporem inque poscebat? Rursus
sena memoro manibus sedebat: contineat *reor crura*; Ismario ad quaerit currum
consequar aequora, sed fratri.

- Latratibus rapit labore mihi adhuc culpae arborea
- Cillan es habebat tu quod postquam
- Gaudet pretiosior suoque alas lympha cannae murum
- Inmeritae desinere caeleste ignibus oscula carentia armigerae
- Euntis nisi numeroque lumine area inobservatus reverentia

Levis circa? His de saevis, aliter perspicit scylla gerunt. Latos tunc simplex
coepere inplebat victus nocte et ante mors Aquilone phaethon, Pergama festa
undas Lucifero tumebat, cognita. Perque inertes vana, habe undis haec denique
dantem me conamina, ad.",
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
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Fizika')->first()->id,
            'topic_id' => Topic::where('name', 'Atomfizika')->first()->id,
            'body' => '#Bevezető
Az atomfizika az anyag felépítésének és viselkedésének megértésével foglalkozik. Az atomok az anyag alapvető építőkövei, amelyeket a kémiai reakciók és az elektromos erők hatására kombinálnak. Az atomfizika tanulmányozza az atomok felépítését, tulajdonságait és viselkedését, valamint az atommagokat és a radioaktivitást.

### Az atomok felépítése
Az atomok felépítése egy kicsi, pozitív töltésű atommagból és az azt körülvevő negatív töltésű elektronfelhőből áll. Az atommagot pozitív töltésű protonok és semleges tömegű neutronok alkotják. Az elektronok körülveszik az atommagot és negatív töltésűek. Az elektronok számától függ, hogy milyen elemről van szó. Például az oxigénnek 8 elektronja van az atomjában, míg a hidrogénnek csak 1.

### Az atomok viselkedése
Az atomok viselkedése különböző tényezőktől függ, például a hőmérséklettől és a nyomástól. Az atomok összeütközhetnek, és ekkor kinetikus energia szabadul fel. Az atomok kémiai reakcióba léphetnek, amikor elektronokat cserélnek vagy kötést alkotnak más atomokkal. Az atommagok szintén kölcsönhatásba léphetnek, amikor az erős nukleáris erő hatására új atommagok keletkeznek.

### Az atommagok és a radioaktivitás
Az atommagokat protonok és neutronok alkotják, és a protonok száma határozza meg, hogy milyen elemről van szó. Az atommag instabil lehet, és ilyenkor a radioaktív bomlás során átalakul más elemmé vagy egy másik izotóppá. A radioaktív bomlás során radioaktív sugárzás szabadul fel, amely károsíthatja az élő szervezeteket. A radioaktív anyagokat azért használják, mert a sugárzásuk hasznos lehet az orvoslásban és az iparban.

Az atomok és az atommagok megértése segíthet a tudósoknak a környezet védelme, az orvoslás és az ipar fejlesztése, valamint az energiatermelés hatékonyabbá tétele területén.'
]);
        Content::factory()->create([
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
        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Kémia')->first()->id,
            'topic_id' => Topic::where('name', 'Szerves kémia')->first()->id,
            'body' => '# Bevezető a szerves kémiába
A szerver kémiája az a tudomány, amely a számítógépes módszerek és az alkalmazott matematikai modellek alkalmazásával a kémiai reakciók és a molekulák tulajdonságainak vizsgálatával foglalkozik. Az elmúlt évtizedekben a számítógépes kémiában számos új módszer és szoftver fejlődött ki, amelyek lehetővé teszik a molekuláris rendszerek modellezését, azok szerkezetének előrejelzését, valamint a kémiai reakciók mechanizmusainak vizsgálatát.

Az elsődleges célja a számítógépes kémiai modellezésnek, hogy megértsük a kémiai rendszerek működését és azok összetett viselkedését. A modellezés során a molekuláris szerkezeteket és reakciókat matematikai egyenletekkel írják le, amelyek számítógépes szimulációk segítségével jelennek meg.

A számítógépes kémiai modellezés alapjait az anyagok kvantummechanikai leírása adja. Ez a módszer lehetővé teszi az elektronok mozgásának leírását és a molekuláris kötések tulajdonságainak meghatározását. Az elektron szerkezetének meghatározása egy adott molekulában lehetővé teszi a molekula számos tulajdonságának előrejelzését, például a dipólusmomentumot, az ionizációs energiát, a reakció sebességét és az abszorpciós spektrumot.

Azonban a kvantummechanikai módszerek nagyon költségesek, és korlátozottak az alkalmazható molekulák számára. Emiatt a számítógépes kémiai modellezés során gyakran alkalmaznak klasszikus módszereket is, mint például a molekuláris dinamikát, amely lehetővé teszi a molekulák dinamikus viselkedésének szimulálását.

A szerver kémia egy másik fontos alkalmazási területe az adatbányászat a kémiai adatokból. Ez a módszer lehetővé teszi a nagy mennyiségű adatok elemzését, és azonosítását, mint például a kémiai szerkezetek, tulajdonságok, aktivitás és reakciók eredményei.

A szerver kémiában alkalmazott számítógépes módszerek és programok széles körben alkalmazhatók a gyógyszertervezés, az anyagfejlesztés és az ipari folyamatok optimalizálása'
]);
        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Történelem')->first()->id,
            'topic_id' => Topic::where('name', '2. világháború')->first()->id,
            'body' => '# Sztálingrádi csata
A Sztálingrádi csata a második világháború egyik legnagyobb és legvéresebb ütközete volt, amely a náci Németország és a Szovjetunió között zajlott. A csata során a két hadsereg több mint öt hónapig harcolt egymással, és a szovjetek végül győztek. A Sztálingrádi csata stratégiai fontosságú volt a háború kimenetele szempontjából, és jelentős hatást gyakorolt a további harcok menetére.
## A Sztálingrádi csata előzményei
A második világháborúban a németek 1941-ben indítottak támadást a Szovjetunió ellen, és a következő évben előrenyomultak a Don folyó völgyébe. A Sztálingrád városát átszelő Volga folyó keresztezése a németek számára stratégiai fontosságú volt, mert az ellenséges erők egy részét vissza tudták volna tartani a Volga túloldalán, és így könnyebben haladhattak volna az orosz területen.

## A Sztálingrádi csata menete
A Sztálingrádi csata 1942 nyarán kezdődött, amikor a németek támadást indítottak a város ellen. A csata azonban gyorsan elakadt, mert a szovjetek keményen ellenálltak és felkészültek a védelemre. A városban zajló harcoktól a lakosság súlyosan megszenvedett, és több ezer ember vesztette életét. A csata során mindkét oldal számára óriási veszteségek voltak, és a németek nem tudták elfoglalni a várost.

A csata során a szovjeteknek sikerült visszavonulniuk a Don folyó túloldalára, majd támadást indítaniuk a németek ellen. A szovjet erők fokozatosan visszavették a kezdeményezést, és lassan haladtak előre. A csata legvéresebb szakaszai november és december között zajlottak, amikor a szovjetek előrenyomultak a városban, és végül sikerült elfoglalniuk a teljes területet.

## A Sztálingrádi csata következményei
A Sztálingrádi csata stratégiai fontosságú volt a háború kimenetele szempontjából, mert megakadályozta a németek előrenyomulását a Szovjetunió területén. A csata után a szovjetek fokozatosan előnybe kerültek a háborúban, és a németek előretörésének megakadályozása miatt elvesztették a lehetőséget, hogy kiterjesszék területi uralmukat a szovjetek fölött. A Sztálingrádi csata után a szovjetek elkezdtek áttérni a támadó hadviselésre, és a kezdeményezés visszavételével fokozatosan visszaverték a német erőket. A csata szimbolikus jelentőséggel is bír, hiszen az egész világ számára világossá vált, hogy a Szovjetunió nem lesz könnyen legyőzhető, és hogy a háború végkimenetele még nem eldöntött. A Sztálingrádi csata a második világháború egyik legnagyobb tragédiája volt, és azóta is emlékezetes eseményként él a történelemkönyvekben.'
        ]);
        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Történelem')->first()->id,
            'topic_id' => Topic::where('name', '2. világháború')->first()->id,
            'body' => '# A Marinot vonal
A Marinot vonal egy híres, de sikertelen védelmi vonal, amelyet a francia hadsereg épített a német hadsereg ellen az első világháború során. A vonalat azért építették, hogy megakadályozzák a németek előretörését Franciaországban.

A vonal építése 1915-ben kezdődött, és az első vonal az Ardennes erdőkön átvezetett és kiterjedt a Vosges-hegységig. A második vonal a belső területeken helyezkedett el, és azzal a céllal építették, hogy megakadályozzák a német hadsereg további előretörését, ha sikerült áttörni az első vonalat.

Azonban a vonal építése hosszú és költséges volt, és a német hadseregnek sikerült áttörnie a vonalat a Verdun-nál 1916 februárjában. A Verdun-i csata a legnagyobb és legsúlyosabb csata volt az első világháborúban, és nagyon nagy veszteségeket okozott mindkét oldalon.

A Marinot vonal építése nem bizonyult hatékonynak, mert a német hadsereg már ekkor fejlett technikával rendelkezett, amely lehetővé tette számukra, hogy áttörjék a vonalat. A vonal nem volt eléggé erős ahhoz, hogy megállítsa a modern katonai technológiák előretörését.

Ennek ellenére a Marinot vonal fontos tanulságot jelentett a hadviselés történetében. Az építése arra kényszerítette a német hadsereget, hogy több erőforrást és időt fordítson az áttörésre, ami csökkentette az előnyüket a háborúban. Ezenkívül a vonal építése és a Verdun-i csata azért is fontos volt, mert az első világháborúban a hadviselés jelentősen megváltozott, és egyre inkább a modern technológia felhasználására és az ipari erőforrásokra támaszkodott.

Összességében a Marinot vonal bár sikertelen volt, fontos szerepet játszott az első világháborúban, és számos tanulságot nyújtott a hadviselésre vonatkozóan a jövő generációi számára.'
]);
        Content::factory()->create([
            'creator_user_id' => 3,
            'subject_id' => Subject::where('name', 'Történelem')->first()->id,
            'topic_id' => Topic::where('name', '1. világháború')->first()->id,
            'body' => '# Trianon
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
        Content::factory()->count(20)->create();
    }
}
