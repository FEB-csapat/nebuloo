<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeederTesting extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RankSeeder::class,
            UserSeeder::class,
            ContentSeeder::class,
            QuestionSeeder::class,
            CommentSeeder::class,
            VoteSeeder::class,
            TicketSeeder::class,
        ]);
    }
}
