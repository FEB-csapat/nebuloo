<?php

namespace Database\Seeders;

use App\Models\Question;

use Illuminate\Database\Seeder;

use Spatie\Tags\Tag;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = Question::factory()->create([
            'creator_user_id' => 1,
            'title' => "First Question",
            'body' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        ]);
        
        Question::factory()->create([
            'creator_user_id' => 2,
            'title' => "Second Question",
            'body' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        ]);

        Question::factory()->count(20)->create()
        ->each(function ($question) {
            $col = Tag::inRandomOrder();
            for($i = 0; $i < 3; $i++ ){
                $question->attachTag($col->first());
            }
        });
    }
}
