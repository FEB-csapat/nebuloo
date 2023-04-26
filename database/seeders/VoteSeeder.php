<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vote::factory()->create([
            'owner_user_id' => 1,
            'reciever_user_id' => 2,
            'votable_id' => 1,
            'votable_type' => Content::class,
            'direction' => 'up',
        ]);


        $contents = Content::take(10)->get();

        foreach ($contents as $content) {
            $votesCount = rand(0, 20);
            Vote::factory()->count($votesCount)->create([
                'owner_user_id' => User::inRandomOrder()->first(),
                'reciever_user_id' => $content->creator_user_id,
                'votable_id' => $content->id,
                'votable_type' => Content::class,
                'direction' => 'up'
            ]);
        }
    }
}
