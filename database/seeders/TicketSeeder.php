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
            'creator_user_id'=> 1,
            'body' => 'I have this bug, where the bug bugs'
        ]);
        Ticket::factory()->count(10)->create();
    }
}
