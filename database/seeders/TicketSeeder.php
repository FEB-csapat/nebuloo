<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::factory()->create([
            'creator_user_id'=> 4,
            'body' => 'Amikor megpróbáltam betölteni az oldalt ahol a tananyagok vannak, az rendkívül lassan töltött be. Ez így használhatatlan.'
        ]);
        
        Ticket::factory()->create([
            'creator_user_id'=> 3,
            'body' => 'Tananyag letöltés nem működik, hiába nyomom meg a gombot, nem történik semmi.'
        ]);
        
        Ticket::factory()->create([
            'creator_user_id'=> 2,
            'body' => 'Nem tudok tantárgyat választani, mert nem jelennek meg a tantárgyak a listában.'
        ]);
    }
}
