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
        




        Content::factory()->count(20)->create();
    }
}
