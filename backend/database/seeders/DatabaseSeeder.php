<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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
            ProviderSeeder::class,
        ]);
    }
}
