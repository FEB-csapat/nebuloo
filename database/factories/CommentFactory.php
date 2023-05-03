<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;
use App\Models\Content;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the comment's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $commentableType = $this->faker->randomElement(['App\Models\Content', 'App\Models\Question']);
        $commentable = $commentableType === 'App\Models\Content'
            ? (Content::inRandomOrder()?->first() ?? Content::factory()->create())
            : (Question::inRandomOrder()?->first() ?? Question::factory()->create());

        return [
            'creator_user_id' => (User::inRandomOrder()?->first() ?? User::factory()->create())->id,
            'commentable_id' => $commentable->id,
            'commentable_type' => $commentableType,
            'message' => $this->faker->paragraph
        ];
    }
}
