<?php

namespace Database\Seeders;

use App\Models\Content;

use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

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
            'body' => "Example content",
        ])->attachTag("history", 'offical-subject');

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
            'body' => '# Az Orosz Realizmus

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
            'body' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        ])->attachTag("history", 'offical-subject');

        
        Content::factory()->count(20)->create()
            ->each(function ($content) {
                $col = Tag::inRandomOrder();
                for($i = 0; $i < 3; $i++ ){
                    $content->attachTag($col->first());
                }
            });
    }
}
