<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Question;
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
        $contents = Content::take(10)->get();
        

        foreach ($contents as $content) {
            $votesCount = rand(0, 15);
            Vote::factory()->count($votesCount)->create([
                'creator_user_id' => User::inRandomOrder()->first(),
                'reciever_user_id' => $content->creator_user_id,
                'votable_id' => $content->id,
                'votable_type' => get_class($content),
                'direction' => rand(0, 1) == 0 ? 'up' : 'down'
            ]);
        }

        $questions = Question::take(10)->get();
        foreach ($questions as $question) {
            $votesCount = rand(0, 15);
            Vote::factory()->count($votesCount)->create([
                'creator_user_id' => User::inRandomOrder()->first(),
                'reciever_user_id' => $question->creator_user_id,
                'votable_id' => $question->id,
                'votable_type' => get_class($question),
                'direction' => rand(0, 1) == 0 ? 'up' : 'down'
            ]);
        }
    }
}
