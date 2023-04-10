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
