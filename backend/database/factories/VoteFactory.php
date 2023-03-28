<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;
use App\Models\Content;
use App\Models\Comment;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $votableType = $this->faker->randomElement(['App\Models\Content', 'App\Models\Question', 'App\Models\Comment']);
        
        if ($votableType === 'App\Models\Content') {
            $votable = Content::inRandomOrder()->first();
        } elseif ($votableType === 'App\Models\Question') {
            $votable = Question::inRandomOrder()->first();
        } else {
            $votable = Comment::inRandomOrder()->first();
        }

        $randomizedUsers = User::inRandomOrder()->get();
        return [
            'owner_user_id' => $randomizedUsers->first()->id,
            'reciever_user_id' => $randomizedUsers->last()->id,
            'votable_id' => $votable->id,
            'votable_type' => $votableType,
            'direction' => $this->faker->randomElement(['up', 'down'])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {

    }
}
